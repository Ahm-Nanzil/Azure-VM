@php
    $settings = Utility::settings();
      $logo=asset(Storage::url('uploads/logo/'));
      $company_logo=Utility::getValByName('company_logo_dark');
      $company_logos=Utility::getValByName('company_logo_light');

      $setting = \App\Models\Utility::colorset();
      $color = (!empty($setting['color'])) ? $setting['color'] : 'theme-3';
      $mode_setting = \App\Models\Utility::mode_layout();
      $SITE_RTL = Utility::getValByName('SITE_RTL');

    $getseo= App\Models\Utility::getSeoSetting();
    $metatitle =  isset($getseo['meta_title']) ? $getseo['meta_title'] :'';
    $metsdesc= isset($getseo['meta_desc'])?$getseo['meta_desc']:'';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $meta_logo = isset($getseo['meta_image'])?$getseo['meta_image']:'';
    $get_cookie = \App\Models\Utility::getCookieSetting();

@endphp
<!DOCTYPE html>
<html lang="en" dir="{{$setting['SITE_RTL'] == 'on'?'rtl':''}}">
<head>
    <title>{{__('Business Management Suite')}}</title>

    <meta name="title" content="{{$metatitle}}">
    <meta name="description" content="{{$metsdesc}}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:title" content="{{$metatitle}}">
    <meta property="og:description" content="{{$metsdesc}}">
    <meta property="og:image" content="{{$meta_image.$meta_logo}}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{$metatitle}}">
    <meta property="twitter:description" content="{{$metsdesc}}">
    <meta property="twitter:image" content="{{$meta_image.$meta_logo}}">

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Complete Business Management Solution" />
    <meta name="keywords" content="Business Management, CRM, ERP, Project Management" />
    <meta name="author" content="Business Suite" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon" />

    <!-- Stylesheets -->
    @if ($SITE_RTL == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}">
    @endif
    @if ($setting['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    @endif

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: #334155;
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
            transition: all 0.3s ease;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 1rem 0;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .navbar-brand img {
            max-height: 40px;
            transition: all 0.3s ease;
        }

        .nav-link {
            color: #475569 !important;
            font-weight: 500;
            margin: 0 0.5rem;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: #6366f1 !important;
            background: rgba(99, 102, 241, 0.1);
        }

        .btn-login {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border: none;
            color: white !important;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            margin-left: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 80px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="rgba(255,255,255,0.1)"/><stop offset="100%" stop-color="rgba(255,255,255,0)"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="300" cy="700" r="120" fill="url(%23a)"/></svg>');
            opacity: 0.6;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero h2 {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            font-weight: 400;
        }

        .hero p {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 2.5rem;
        }

        .btn-hero {
            background: white;
            color: #6366f1;
            border: none;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            margin-right: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-hero:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            color: #6366f1;
        }

        .btn-outline-hero {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-hero:hover {
            background: white;
            color: #6366f1;
            transform: translateY(-2px);
        }

        .hero-image {
            position: relative;
            z-index: 2;
        }

        .hero-mockup {
            max-width: 100%;
            height: auto;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.2));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Dashboard Section */
        .dashboard-section {
            padding: 120px 0;
            background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
        }

        .client-logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 3rem;
            margin-bottom: 4rem;
            flex-wrap: wrap;
        }

        .client-logo {
            width: 120px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            opacity: 0.7;
        }

        .client-logo:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            opacity: 1;
        }

        .client-logo img {
            max-width: 80px;
            max-height: 40px;
            filter: grayscale(1);
            transition: all 0.3s ease;
        }

        .client-logo:hover img {
            filter: grayscale(0);
        }

        .dashboard-preview {
            text-align: center;
            margin-top: 4rem;
        }

        .dashboard-preview img {
            max-width: 100%;
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .dashboard-preview img:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
        }

        /* Feature Sections */
        .feature-section {
            padding: 120px 0;
        }

        .feature-section:nth-child(even) {
            background: #f8fafc;
        }

        .feature-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1.5rem;
        }

        .feature-content h2 {
            font-size: 1.5rem;
            color: #6366f1;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .feature-content p {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .btn-feature {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-feature:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
            color: white;
        }

        .feature-image img {
            max-width: 100%;
            border-radius: 1rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        /* Features Grid */
        .features-grid {
            padding: 120px 0;
            background: #f8fafc;
        }

        .feature-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem;
            text-align: center;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 2rem;
            border-radius: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .feature-icon.bg-gradient-1 {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .feature-icon.bg-gradient-2 {
            background: linear-gradient(135deg, #f093fb, #f5576c);
        }

        .feature-icon.bg-gradient-3 {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
        }

        .feature-icon.bg-gradient-4 {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
        }

        .feature-card h6 {
            color: #6366f1;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .feature-card h4 {
            color: #1e293b;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: #64748b;
            line-height: 1.6;
        }

        /* Gallery Section */
        .gallery-section {
            padding: 120px 0;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .gallery-item {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .gallery-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .gallery-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        /* FAQ Section */
        .faq-section {
            padding: 120px 0;
            background: #f8fafc;
        }

        .accordion-item {
            border: none !important;
            margin-bottom: 1rem;
            border-radius: 1rem !important;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .accordion-button {
            background: white !important;
            border: none !important;
            padding: 1.5rem 2rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            background: #6366f1 !important;
            color: white !important;
        }

        .accordion-body {
            padding: 1.5rem 2rem !important;
            background: white;
            color: #64748b;
            line-height: 1.7;
        }

        /* Footer */
        .footer {
            padding: 4rem 0 2rem;
            background: #1e293b;
            color: white;
        }

        .footer img {
            filter: brightness(0) invert(1);
        }

        .footer p {
            color: #94a3b8;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero h2 {
                font-size: 1.25rem;
            }

            .feature-content h1 {
                font-size: 2rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .btn-hero,
            .btn-outline-hero {
                padding: 0.75rem 1.5rem;
                margin-bottom: 1rem;
                display: block;
                text-align: center;
            }

            .client-logos {
                gap: 1.5rem;
            }

            .client-logo {
                width: 100px;
                height: 50px;
            }
        }

        /* Animation classes */
        .animate__fadeInLeft,
        .animate__fadeInRight,
        .animate__fadeInUp {
            animation-duration: 1s;
            animation-fill-mode: both;
        }

        .animate__fadeInLeft {
            animation-name: fadeInLeft;
        }

        .animate__fadeInRight {
            animation-name: fadeInRight;
        }

        .animate__fadeInUp {
            animation-name: fadeInUp;
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translate3d(-100%, 0, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translate3d(100%, 0, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 100%, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
    </style>
</head>

<body class="{{$color}}">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                @if($mode_setting['cust_darklayout'] && $mode_setting['cust_darklayout'] == 'on')
                    <img src="{{ $logo . '/' . (isset($company_logos) && !empty($company_logos) ? $company_logos : 'logo-dark.png') }}" alt="logo"/>
                @else
                    <img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}" alt="logo"/>
                @endif
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-login" href="{{ route('login') }}">{{__('Login')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 hero-content">
                    <h1 class="wow animate__fadeInLeft" data-wow-delay="0.2s">
                        Business Management Suite
                    </h1>
                    <h2 class="wow animate__fadeInLeft" data-wow-delay="0.4s">
                        {{__('Complete Business Solution with Project Management, CRM & Analytics')}}
                    </h2>
                    <p class="wow animate__fadeInLeft" data-wow-delay="0.6s">
                        Streamline your business operations with our comprehensive management platform. Manage projects, track customers, and grow your business with powerful analytics and insights.
                    </p>
                    <div class="wow animate__fadeInLeft" data-wow-delay="0.8s">
                        <a href="{{ route('login') }}" class="btn btn-hero">
                            <i class="fas fa-rocket me-2"></i>Get Started
                        </a>
                        <a href="#features" class="btn btn-outline-hero">
                            <i class="fas fa-play me-2"></i>Learn More
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 hero-image">
                    <div class="wow animate__fadeInRight" data-wow-delay="0.2s">
                        <svg class="hero-mockup" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="300" rx="20" fill="url(#heroGradient)"/>
                            <rect x="20" y="20" width="360" height="40" rx="10" fill="rgba(255,255,255,0.2)"/>
                            <rect x="20" y="80" width="170" height="100" rx="10" fill="rgba(255,255,255,0.15)"/>
                            <rect x="210" y="80" width="170" height="100" rx="10" fill="rgba(255,255,255,0.15)"/>
                            <rect x="20" y="200" width="360" height="60" rx="10" fill="rgba(255,255,255,0.1)"/>
                            <defs>
                                <linearGradient id="heroGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#667eea"/>
                                    <stop offset="100%" style="stop-color:#764ba2"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dashboard Section -->
    <section class="dashboard-section">
        <div class="container">
            <div class="section-title">
                <h2>Trusted by Leading Companies</h2>
                <p>Join thousands of businesses that rely on our platform for their daily operations</p>
            </div>

            <div class="client-logos">
                @for($i = 0; $i < 5; $i++)
                    <div class="client-logo wow animate__fadeInUp" data-wow-delay="{{0.2 + ($i * 0.2)}}s">
                        @if($mode_setting['cust_darklayout'] && $mode_setting['cust_darklayout'] == 'on')
                            <img src="{{ $logo . '/' . (isset($company_logos) && !empty($company_logos) ? $company_logos : 'logo-dark.png') }}" alt="Client Logo"/>
                        @else
                            <img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}" alt="Client Logo"/>
                        @endif
                    </div>
                @endfor
            </div>

            <div class="dashboard-preview">
                <svg class="wow animate__fadeInUp" data-wow-delay="0.2s" viewBox="0 0 800 500" xmlns="http://www.w3.org/2000/svg" style="max-width: 100%; border-radius: 1.5rem; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);">
                    <rect width="800" height="500" rx="20" fill="#f8fafc"/>
                    <rect x="0" y="0" width="800" height="60" rx="20" fill="#6366f1"/>
                    <rect x="40" y="100" width="300" height="150" rx="10" fill="white"/>
                    <rect x="360" y="100" width="300" height="150" rx="10" fill="white"/>
                    <rect x="40" y="270" width="720" height="80" rx="10" fill="white"/>
                    <rect x="40" y="370" width="200" height="100" rx="10" fill="white"/>
                    <rect x="260" y="370" width="200" height="100" rx="10" fill="white"/>
                    <rect x="480" y="370" width="280" height="100" rx="10" fill="white"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- Feature Sections -->
    <section class="feature-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2">
                    <div class="feature-content wow animate__fadeInRight" data-wow-delay="0.2s">
                        <h1>Project Management</h1>
                        <h2>Streamline Your Workflow</h2>
                        <p>Organize tasks, track progress, and collaborate with your team efficiently. Our intuitive project management tools help you deliver projects on time and within budget.</p>
                        <a href="#" class="btn btn-feature">
                            <i class="fas fa-arrow-right me-2"></i>Explore Features
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="feature-image wow animate__fadeInLeft" data-wow-delay="0.2s">
                        <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                            <rect width="500" height="400" rx="15" fill="#f8fafc"/>
                            <rect x="30" y="30" width="440" height="50" rx="10" fill="#6366f1"/>
                            <rect x="30" y="100" width="200" height="120" rx="10" fill="white"/>
                            <rect x="250" y="100" width="220" height="120" rx="10" fill="white"/>
                            <rect x="30" y="240" width="440" height="60" rx="10" fill="white"/>
                            <rect x="30" y="320" width="440" height="50" rx="10" fill="#e2e8f0"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="feature-image wow animate__fadeInLeft" data-wow-delay="0.2s">
                        <svg viewBox="0 0 500 400" xmlns="http://www.w3.org/2000/svg">
                            <rect width="500" height="400" rx="15" fill="#f8fafc"/>
                            <circle cx="150" cy="150" r="80" fill="#6366f1"/>
                            <rect x="280" y="100" width="180" height="30" rx="5" fill="#8b5cf6"/>
                            <rect x="280" y="150" width="150" height="20" rx="5" fill="#06b6d4"/>
                            <rect x="280" y="190" width="120" height="20" rx="5" fill="#10b981"/>
                            <rect x="50" y="280" width="400" height="80" rx="10" fill="white"/>
                        </svg>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-content wow animate__fadeInRight" data-wow-delay="0.2s">
                        <h1>Customer Relationship</h1>
                        <h2>Build Stronger Connections</h2>
                        <p>Manage your customer relationships with powerful CRM tools. Track interactions, manage sales pipelines, and provide exceptional customer service.</p>
