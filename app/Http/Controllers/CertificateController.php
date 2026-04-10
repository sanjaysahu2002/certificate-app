<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Participant;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class CertificateController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|numeric|digits:10',
        ]);

        // 1. Concurrency Limit (Max 4 at a time)
        $slotFound = false;
        $activeSlot = null;

        for ($i = 1; $i <= 4; $i++) {
            $lock = \Illuminate\Support\Facades\Cache::lock("cert_slot_$i", 60);
            if ($lock->get()) {
                $slotFound = true;
                $activeSlot = $lock;
                break;
            }
        }

        if (!$slotFound) {
            return back()->withErrors(['mobile' => 'Server is busy. Please try again in a few seconds.'])->withInput();
        }

        try {
            // 2. Uniqueness Check
            $participant = Participant::where('mobile', $request->mobile)
                                     ->orWhere('email', $request->email)
                                     ->first();

            if (!$participant) {
                $participant = Participant::create([
                    'certificate_id' => strtoupper(Str::random(10)),
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                ]);
            } else {
                $participant->update(['name' => $request->name]);
            }

            // Generate QR code
            $verifyUrl = route('verify', ['id' => $participant->certificate_id]);
            $qrcode = new QRCode();
            $qrImage = $qrcode->render($verifyUrl);

            $data = [
                'name' => $participant->name,
                'date' => $participant->created_at->format('F d, Y'),
                'certificate_id' => $participant->certificate_id,
                'qrImage' => $qrImage
            ];

            $pdf = Pdf::loadView('certificate.template', $data)
                      ->setPaper('a4', 'landscape');

            $filename = 'Certificate_' . Str::slug($participant->name) . '.pdf';
            return $pdf->download($filename);

        } finally {
            if ($activeSlot) {
                $activeSlot->release();
            }
        }
    }

    public function verify($id)
    {
        $participant = Participant::where('certificate_id', $id)->first();
        return view('certificate.verify', compact('participant', 'id'));
    }
}
