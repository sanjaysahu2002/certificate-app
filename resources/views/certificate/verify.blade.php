<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Verification - Pharma Fest</title>
    <style>
        :root {
            --primary: #4f46e5;
            --bg: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --success: #10b981;
            --error: #ef4444;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            background: var(--card-bg);
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .icon.valid {
            background-color: #d1fae5;
            color: var(--success);
        }

        .icon.invalid {
            background-color: #fee2e2;
            color: var(--error);
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .details {
            margin-top: 2rem;
            padding: 1.5rem;
            background: var(--bg);
            border-radius: 8px;
            text-align: left;
        }

        .details p {
            margin: 0.5rem 0;
            color: var(--text-muted);
        }

        .details span {
            color: var(--text-main);
            font-weight: 600;
        }

        a.btn {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.75rem 1.5rem;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container">
    @if($participant)
        <div class="icon valid">✓</div>
        <h1>Certificate is Valid</h1>
        <p>This is a verified certificate issued by Pharma Fest 2026.</p>
        
        <div class="details">
            <p>Participant Name: <span>{{ $participant->name }}</span></p>
            <p>Certificate ID: <span>{{ $participant->certificate_id }}</span></p>
            <p>Issued On: <span>{{ $participant->created_at->format('F d, Y') }}</span></p>
        </div>
    @else
        <div class="icon invalid">✗</div>
        <h1>Invalid Certificate</h1>
        <p>We could not find a valid certificate with ID: <strong>{{ $id }}</strong>.</p>
        <p style="color: var(--text-muted); font-size: 0.9em;">Please check the ID and try again, or contact support.</p>
    @endif

    <a href="{{ route('home') }}" class="btn">Generate New Certificate</a>
</div>

</body>
</html>
