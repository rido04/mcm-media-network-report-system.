<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error - Siaran Terganggu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background: url('{{ asset('images/tv-static-modern.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            position: relative;
        }
        .error-container {
            background: rgba(0, 0, 0, 0.85);
            padding: 50px;
            border-radius: 15px;
            text-align: center;
            max-width: 600px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.5);
        }
        .glitch {
            font-size: 60px;
            font-weight: bold;
            position: relative;
            color: #fff;
            animation: glitch 1s linear infinite;
        }
        .glitch::before, .glitch::after {
            content: "Broadcast Interrupted!";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .glitch::before {
            color: #f0f;
            animation: glitch-top 1s linear infinite;
            clip-path: polygon(0 0, 100% 0, 100% 33%, 0 33%);
        }
        .glitch::after {
            color: #0ff;
            animation: glitch-bottom 1.5s linear infinite;
            clip-path: polygon(0 67%, 100% 67%, 100% 100%, 0 100%);
        }
        p {
            font-size: 20px;
            margin: 20px 0 30px;
            line-height: 1.5;
        }
        .btn-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .login-btn, .whatsapp-btn {
            display: inline-block;
            padding: 15px 40px;
            color: #fff;
            text-decoration: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .login-btn {
            background: linear-gradient(90deg, #e50914, #f5c518);
        }
        .login-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(229, 9, 20, 0.7);
        }
        .whatsapp-btn {
            background: linear-gradient(90deg, #25D366, #128C7E);
        }
        .whatsapp-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(37, 211, 102, 0.7);
        }
        .news-ticker {
            position: absolute;
            bottom: 20px;
            width: 100%;
            background: rgba(255, 0, 0, 0.9);
            padding: 10px;
            font-size: 16px;
            color: #fff;
            overflow: hidden;
        }
        .news-ticker span {
            display: inline-block;
            white-space: nowrap;
            animation: ticker 10s linear infinite;
        }
        @keyframes glitch {
            2%, 64% { transform: translate(2px, 0) skew(0deg); }
            4%, 60% { transform: translate(-2px, 0) skew(0deg); }
            62% { transform: translate(0, 0) skew(5deg); }
        }
        @keyframes glitch-top {
            2%, 64% { transform: translate(2px, -2px); }
            4%, 60% { transform: translate(-2px, 2px); }
            62% { transform: translate(13px, -1px) skew(-13deg); }
        }
        @keyframes glitch-bottom {
            2%, 64% { transform: translate(-2px, 0); }
            4%, 60% { transform: translate(-2px, 0); }
            62% { transform: translate(-22px, 5px) skew(21deg); }
        }
        @keyframes ticker {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="glitch">Broadcast Interrupted!</h1>
        <p>Sorry, our servers are experiencing technical difficulties. Please return to the login studio or contact us for assistance.</p>
        <div class="btn-container">
            <a href="{{ route('login') }}" class="login-btn" aria-label="Kembali ke halaman login">Back to login</a>
            <a href="https://wa.me/6289643119513?text=Halo,%20saya%20mengalami%20error%20500%20di%20situs%20Anda" class="whatsapp-btn" aria-label="Hubungi kami via WhatsApp" target="_blank">Contact Developer</a>
        </div>
    </div>
    <div class="news-ticker">
        <span>Breaking News: The server is under maintenance. Please return to the login page or contact us via WhatsApp. - </span>
    </div>
    <script>
        // Optional: Tambahkan suara statis TV (dengan toggle untuk aksesibilitas)
        const audio = new Audio('{{ asset('sounds/tv-static.mp3') }}');
        audio.loop = true;
        audio.volume = 0.3;
        let isPlaying = false;
        document.addEventListener('click', () => {
            if (!isPlaying) {
                audio.play();
                isPlaying = true;
            }
        });
    </script>
</body>
</html>
