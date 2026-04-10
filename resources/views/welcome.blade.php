<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharma Fest Certificate Generator</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f3f4f6;
            --card-bg: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
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
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-2px);
        }

        h1 {
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        p {
            color: var(--text-muted);
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.875rem;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        button {
            width: 100%;
            padding: 0.875rem;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
            position: relative;
        }

        button:hover {
            background-color: var(--primary-hover);
        }

        button:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .loader {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        .btn-text.loading {
            visibility: hidden;
        }

        .loader.loading {
            display: block;
        }

        .error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .alert {
            padding: 1rem;
            background-color: #dbeafe;
            color: #1e40af;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: none;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Pharma Fest 2026</h1>
    <p>Generate your official Certificate of Participation instantly.</p>

    <div class="alert" id="successAlert">
        Your certificate has been generated successfully!
    </div>

    <form id="cert-form" method="POST" action="{{ route('generate') }}">
        @csrf
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required placeholder="Dr. John Doe">
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required placeholder="john@example.com">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="mobile">Mobile Number</label>
            <input type="tel" id="mobile" name="mobile" required placeholder="9876543210" pattern="[0-9]{10}">
            @error('mobile')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" id="submitBtn">
            <span class="btn-text" id="btnText">Generate Certificate</span>
            <div class="loader" id="btnLoader"></div>
        </button>
    </form>
</div>

<script>
    document.getElementById('cert-form').addEventListener('submit', function(e) {
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoader = document.getElementById('btnLoader');
        
        btn.disabled = true;
        btnText.classList.add('loading');
        btnLoader.classList.add('loading');

        // Allow form to submit normally, then re-enable after 3 seconds (simulating download delay)
        setTimeout(() => {
            btn.disabled = false;
            btnText.classList.remove('loading');
            btnLoader.classList.remove('loading');
            document.getElementById('successAlert').style.display = 'block';
        }, 3000);
    });
</script>

</body>
</html>
