<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <style>
        /* Simplified Tailwind-like styles with dashboard theme */
        :root {
            --color-blue-600: #2563eb;
            --color-blue-700: #1d4ed8;
            --color-gray-100: #f3f4f6;
            --color-gray-200: #e5e7eb;
            --color-gray-800: #1f2937;
            --color-white: #ffffff;
            --color-black: #000000;
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: var(--color-gray-100);
            color: var(--color-gray-800);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem;
        }
        
        .container {
            width: 100%;
            max-width: 56rem;
        }
        
        .header {
            width: 100%;
            margin-bottom: 1.5rem;
        }
        
        .nav {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }
        
        .btn {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s;
        }
        
        .btn-outline {
            border: 1px solid var(--color-gray-200);
            color: var(--color-gray-800);
            background: transparent;
        }
        
        .btn-outline:hover {
            border-color: var(--color-gray-800);
        }
        
        .btn-primary {
            background-color: var(--color-blue-600);
            color: var(--color-white);
            border: 1px solid var(--color-blue-600);
        }
        
        .btn-primary:hover {
            background-color: var(--color-blue-700);
            border-color: var(--color-blue-700);
        }
        
        .main-content {
            display: flex;
            flex-direction: column;
            background-color: var(--color-white);
            border-radius: var(--radius-xl);
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            overflow: hidden;
            width: 100%;
        }
        
        @media (min-width: 1024px) {
            .main-content {
                flex-direction: row;
            }
        }
        
        .info-panel {
            flex: 1;
            padding: 1.5rem;
            background-color: var(--color-white);
        }
        
        @media (min-width: 1024px) {
            .info-panel {
                padding: 2.5rem;
            }
        }
        
        .graphic-panel {
            flex-shrink: 0;
            background-color: #f0f9ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }
        
        @media (min-width: 1024px) {
            .graphic-panel {
                width: 18rem;
            }
        }
        
        h1 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        p {
            color: #6b7280;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }
        
        .feature-list {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 0;
            position: relative;
        }
        
        .feature-bullet {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 50%;
            background-color: var(--color-white);
            box-shadow: 0 0 0 1px #e5e7eb;
            flex-shrink: 0;
        }
        
        .feature-bullet-inner {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background-color: #d1d5db;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }
        
        .deploy-btn {
            background-color: var(--color-gray-800);
            color: var(--color-white);
        }
        
        .deploy-btn:hover {
            background-color: var(--color-black);
        }
        
        .logo {
            width: 100%;
            max-width: 12rem;
            color: var(--color-blue-600);
        }
        
        .logo-circle {
            fill: currentColor;
        }
        
        .logo-text {
            fill: var(--color-gray-800);
        }
        
        .dark-mode-switch {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 2.5rem;
            height: 1.25rem;
            border-radius: 9999px;
            background-color: #d1d5db;
            display: flex;
            align-items: center;
            padding: 0.125rem;
            cursor: pointer;
        }
        
        .dark-mode-switch::before {
            content: '';
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background-color: var(--color-white);
            transition: transform 0.3s;
        }
        
        .dark-mode-switch:hover::before {
            transform: translateX(1.25rem);
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            @if (Route::has('login'))
                <nav class="nav">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <div class="main-content">
            <div class="info-panel">
                <h1>Let's get started</h1>
                <p>Laravel has an incredibly rich ecosystem. We suggest starting with the following resources.</p>
                
                <ul class="feature-list">
                    <li class="feature-item">
                        <span class="feature-bullet">
                            <span class="feature-bullet-inner"></span>
                        </span>
                        <span>
                            Read the
                            <a href="https://laravel.com/docs" target="_blank" class="text-blue-600 font-medium underline">
                                Documentation
                            </a>
                        </span>
                    </li>
                    <li class="feature-item">
                        <span class="feature-bullet">
                            <span class="feature-bullet-inner"></span>
                        </span>
                        <span>
                            Watch video tutorials at
                            <a href="https://laracasts.com" target="_blank" class="text-blue-600 font-medium underline">
                                Laracasts
                            </a>
                        </span>
                    </li>
                </ul>
                
                <div class="action-buttons">
                    <a href="https://cloud.laravel.com" target="_blank" class="btn deploy-btn">
                        Deploy now
                    </a>
                </div>
            </div>
            
            <div class="graphic-panel">
                <!-- Simplified Laravel logo that matches dashboard style -->
                <svg class="logo" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="40" class="logo-circle" opacity="0.2"/>
                    <path d="M50 15 L75 50 L50 85 L25 50 Z" class="logo-text" fill="currentColor"/>
                </svg>
                
                <div class="dark-mode-switch" title="Toggle dark mode"></div>
            </div>
        </div>
    </div>

    <script>
        // Simple dark mode toggle
        document.querySelector('.dark-mode-switch').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            
            if (document.body.classList.contains('dark-mode')) {
                document.body.style.backgroundColor = '#1f2937';
                document.body.style.color = '#f3f4f6';
                document.querySelector('.main-content').style.backgroundColor = '#374151';
                document.querySelector('.info-panel').style.backgroundColor = '#374151';
                document.querySelector('.graphic-panel').style.backgroundColor = '#1e40af';
                document.querySelector('.logo-circle').style.fill = '#3b82f6';
                document.querySelector('.logo-text').style.fill = '#f3f4f6';
            } else {
                document.body.style.backgroundColor = '#f3f4f6';
                document.body.style.color = '#1f2937';
                document.querySelector('.main-content').style.backgroundColor = '#ffffff';
                document.querySelector('.info-panel').style.backgroundColor = '#ffffff';
                document.querySelector('.graphic-panel').style.backgroundColor = '#f0f9ff';
                document.querySelector('.logo-circle').style.fill = '#2563eb';
                document.querySelector('.logo-text').style.fill = '#1f2937';
            }
        });
    </script>
</body>
</html>