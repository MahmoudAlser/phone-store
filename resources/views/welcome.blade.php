<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhoneStore - أحدث الهواتف الذكية</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Store CSS -->
    <link rel="stylesheet" href="{{ asset('css/store-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg store-navbar fixed-top">
    <a class="navbar-brand" href="/">
        <i class="fas fa-mobile-alt"></i>Phone<span>Store</span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain"
            aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMain">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/"><i class="fas fa-home ml-1"></i>الرئيسية</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/posts') }}"><i class="fas fa-tags ml-1"></i>عروض الهواتف</a>
            </li>
            <li class="nav-item">
                @auth
                    @if(Auth::user()->name === 'admin')
                        <a class="nav-link" href="{{ url('/addpost') }}"><i class="fas fa-plus-circle ml-1"></i>رفع بوست</a>
                    @endif
                @endauth
            </li>
        </ul>

        <div class="d-flex align-items-center">
            @auth
                <span class="user-greeting">
                    <i class="fas fa-user-circle"></i>{{ Auth::user()->name }}
                </span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-login nav-link" style="background:none;cursor:pointer;">
                        <i class="fas fa-sign-out-alt ml-1"></i>خروج
                    </button>
                </form>
            @else
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn-login nav-link">
                        <i class="fas fa-sign-in-alt ml-1"></i>دخول
                    </a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-register nav-link">
                        <i class="fas fa-user-plus ml-1"></i>تسجيل
                    </a>
                @endif
            @endauth
        </div>
    </div>
</nav>

<!-- ===== HERO CAROUSEL ===== -->
<div id="phoneCarousel" class="carousel slide hero-carousel" data-ride="carousel" data-interval="4000">

    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#phoneCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#phoneCarousel" data-slide-to="1"></li>
        <li data-target="#phoneCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Slides -->
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active carousel-slide-1">
            <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&q=80"
                 alt="iPhone" class="carousel-phone-img">
            <div class="carousel-text-content">
                <span class="carousel-badge">✨ وصل حديثاً</span>
                <h1>أحدث الهواتف<br>الذكية 2025</h1>
                <p>اكتشف مجموعتنا المميزة من أفضل الهواتف<br>بأسعار لا تُقاوم وضمان سنة كاملة</p>
                <a href="{{ url('/posts') }}" class="btn-shop-now">
                    <i class="fas fa-shopping-bag ml-2"></i>تسوق الآن
                </a>
                <a href="#features" class="btn-shop-outline">اعرف أكثر</a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item carousel-slide-2">
            <img src="https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?w=400&q=80"
                 alt="Samsung" class="carousel-phone-img">
            <div class="carousel-text-content">
                <span class="carousel-badge">🔥 عروض حصرية</span>
                <h1>خصومات تصل<br>إلى 40%</h1>
                <p>عروض لا تفوتك على أحدث هواتف Samsung<br>وiPhone وXiaomi وغيرها</p>
                <a href="{{ url('/posts') }}" class="btn-shop-now">
                    <i class="fas fa-fire ml-2"></i>شاهد العروض
                </a>
                <a href="#features" class="btn-shop-outline">تفاصيل أكثر</a>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item carousel-slide-3">
            <img src="https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=400&q=80"
                 alt="Phone" class="carousel-phone-img">
            <div class="carousel-text-content">
                <span class="carousel-badge">🚚 شحن مجاني</span>
                <h1>توصيل سريع<br>لباب بيتك</h1>
                <p>اطلب الآن واستلم خلال 24 ساعة<br>مع ضمان استرجاع 7 أيام</p>
                <a href="{{ url('/posts') }}" class="btn-shop-now">
                    <i class="fas fa-truck ml-2"></i>اطلب الآن
                </a>
                @guest
                    <a href="{{ route('register') }}" class="btn-shop-outline">سجّل مجاناً</a>
                @endguest
            </div>
        </div>

    </div>

    <!-- Controls -->
    <a class="carousel-control-prev" href="#phoneCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" href="#phoneCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
</div>

<!-- ===== FEATURES SECTION ===== -->
<section class="features-section" id="features">
    <div class="container">
        <div class="text-center">
            <h2 class="section-title">لماذا تختار PhoneStore؟</h2>
            <p class="section-subtitle">نقدم لك أفضل تجربة تسوق للهواتف الذكية</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="icon-wrap">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h5>شحن مجاني وسريع</h5>
                    <p>توصيل مجاني لجميع الطلبات فوق 500 ريال، واستلم طلبك خلال 24 ساعة</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="icon-wrap">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h5>ضمان سنة كاملة</h5>
                    <p>جميع الهواتف مضمونة لمدة سنة كاملة مع خدمة صيانة مجانية</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card">
                    <div class="icon-wrap">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h5>دفع آمن 100%</h5>
                    <p>جميع معاملاتك محمية بأحدث تقنيات التشفير والأمان الإلكتروني</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA SECTION ===== -->
<section class="cta-section">
    <div class="container">
        <h2>مستعد للتسوق؟</h2>
        <p>تصفح أحدث عروض الهواتف الذكية واحصل على أفضل الأسعار</p>
        <a href="{{ url('/posts') }}" class="btn-shop-now" style="font-size:1.1rem; padding:14px 44px;">
            <i class="fas fa-mobile-alt ml-2"></i>تصفح العروض
        </a>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="store-footer">
    <div class="container">
        <p class="mb-1">
            <i class="fas fa-mobile-alt" style="color:#e94560;"></i>
            <strong style="color:#fff;">PhoneStore</strong> &mdash; متجرك الأول للهواتف الذكية
        </p>
        <p class="mb-0">جميع الحقوق محفوظة &copy; {{ date('Y') }}</p>
    </div>
</footer>

<!-- Bootstrap 4 JS -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
