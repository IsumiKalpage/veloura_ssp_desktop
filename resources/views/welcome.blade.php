<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veloura | Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #fff0f5, #fde2e4, #fdf2f8, #ffffff);
            background-size: 400% 400%;
            animation: gradientShift 12s ease infinite;
            font-family: 'Poppins', sans-serif;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass {
            background: rgba(255, 255, 255, -0.10); 
            backdrop-filter: blur(90px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(280%);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 2.5rem 3rem;
            text-align: center;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .glass img.logo {
            height: 70px;
            margin: 0 auto 1.5rem auto;
            display: block;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-weight: 300; 
            font-size: 2.4rem;
            letter-spacing: 0.5px;
            margin-bottom: 0.8rem;
            color: #3a0a0a;
        }

        p {
            font-family: 'Poppins', sans-serif;
            font-weight: 300;
            font-size: 1rem;
            margin-bottom: 2rem;
            color: #4a4a4a;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 0.9rem;
            margin-bottom: 1rem;
            border-radius: 999px;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #d6336c, #f783ac);
            color: white;
            border: none;
        }
        .btn-primary:hover {
            box-shadow: 0 0 15px rgba(214, 51, 108, 0.4);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: transparent;
            border: 2px solid #d6336c;
            color: #d6336c;
        }
        .btn-secondary:hover {
            background: rgba(214, 51, 108, 0.08);
        }

        .divider {
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            text-align: center;
            color: #777;
            font-size: 0.9rem;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(0,0,0,0.15);
        }
        .divider:not(:empty)::before { margin-right: .75em; }
        .divider:not(:empty)::after { margin-left: .75em; }


        .btn-google {
            background: #ffffff;
            border: 1px solid #ddd;
            color: #333;
        }
        .btn-google i { color: #DB4437; margin-right: 8px; }

        .btn-apple {
            background: #000;
            color: #fff;
            border: none;
        }
        .btn-apple i { margin-right: 8px; }

        footer {
            font-size: 0.8rem;
            color: #6b7280;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <main class="glass">
        <img src="{{ asset('images/logo.png') }}" alt="Veloura Logo" class="logo">
        <h1>Welcome to Veloura</h1>
        <p>Luxury Skincare & Beauty Essentials</p>

        <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
        <a href="{{ route('login') }}" class="btn btn-secondary">Sign In</a>

        <div class="divider">or</div>

        <button class="btn btn-google"><i class="fab fa-google"></i> Continue with Google</button>
        <button class="btn btn-apple"><i class="fab fa-apple"></i> Continue with Apple</button>

        <footer>
            © 2025 Veloura. All rights reserved.
        </footer>
    </main>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
