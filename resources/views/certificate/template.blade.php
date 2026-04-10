<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate - The Pharma Fest</title>
    <style>
        @page {
            margin: 0px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #ffffff;
            font-family: 'Helvetica', 'Arial', sans-serif;
            width: 100%;
            height: 100%;
        }
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .content {
            position: relative;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        /* Positioning the name exactly on the placeholder line of your PNG */
        .name-container {
            position: absolute;
            top: 44%; /* Moved up from 48% */
            left: 50%;
            transform: translateX(-50%);
            width: 80%;
            text-align: center;
        }
        .name {
            font-size: 44px;
            font-weight: bold;
            font-family: 'Times-Roman', serif;
            color: #1a1a1a;
            /* Added a slight shadow/glow if needed, but keeping it clean for now */
        }
        /* QR Code positioning */
        .qr-code {
            position: absolute;
            bottom: 40px;
            right: 40px;
            width: 80px;
            height: 80px;
        }
        .qr-code img {
            width: 100%;
            height: 100%;
        }
        /* Certificate ID and Date */
        .cert-info {
            position: absolute;
            bottom: 25px;
            left: 40px;
            font-size: 11px;
            color: #555;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    @php
        $bgImage = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/final_cert_bg.png')));
    @endphp
    
    <img src="{{ $bgImage }}" class="background" alt="background">

    <div class="content">
        <!-- Dynamic Name Placement -->
        <div class="name-container">
            <span class="name">{{ $name }}</span>
        </div>

        <!-- QR Code Overlay -->
        <div class="qr-code">
            <img src="{{ $qrImage }}" alt="QR Code">
        </div>

        <!-- Verification ID & Date Overlay -->
        <div class="cert-info">
            Verification ID: {{ $certificate_id }} | Date: {{ $date }}
        </div>
    </div>
</body>
</html>
