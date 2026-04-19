@php use Illuminate\Support\Facades\Storage; @endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhoneStore - عروض الهواتف</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Store CSS -->
    <link rel="stylesheet" href="{{ asset('css/store-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
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
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/"><i class="fas fa-home ml-1"></i>الرئيسية</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/posts') }}"><i class="fas fa-tags ml-1"></i>عروض الهواتف</a>
            </li>
            @auth
                @if(Auth::user()->name === 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/addpost') }}"><i class="fas fa-plus-circle ml-1"></i>رفع بوست</a>
                    </li>
                @endif
            @endauth
        </ul>

        <div class="d-flex align-items-center mr-auto">
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

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <div class="container">
        <span class="badge-count"><i class="fas fa-tags ml-1"></i>أحدث العروض</span>
        <h1>عروض الهواتف الذكية</h1>
        <p>تصفح أفضل العروض والأسعار على الهواتف الذكية</p>
    </div>
</div>

<!-- ===== POSTS GRID ===== -->
<section class="posts-section">
    <div class="container">
        @if(isset($posts) && count($posts) > 0)
            @auth
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="phone-card">
                            <div class="card-img-wrap">
                                <img src="{{ $post->img ? Storage::url($post->img) : 'https://picsum.photos/seed/' . $post->post_id . '/600/300' }}"
                                     alt="{{ $post->p_title }}">
                                <span class="card-badge">🔥 عرض</span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->p_title }}</h5>
                                <p class="card-text">{{ $post->p_content }}</p>
                                <div class="card-footer-custom">
                                    <span class="card-time">
                                        <i class="fas fa-clock"></i>منذ قليل
                                    </span>
                                    <a href="{{ url('/post/' . $post->post_id) }}" class="btn-card-details">
                                        <i class="fas fa-eye ml-1"></i>التفاصيل
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($posts->lastPage() > 1)
            <div class="pagination-wrap">
                <ul class="pagination">
                    {{-- Previous --}}
                    <li class="page-item {{ $posts->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $posts->previousPageUrl() }}">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>

                    {{-- Pages --}}
                    @for($i = 1; $i <= $posts->lastPage(); $i++)
                        <li class="page-item {{ $posts->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Next --}}
                    <li class="page-item {{ $posts->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $posts->nextPageUrl() }}">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                </ul>
            </div>
            @endif
            @else
            {{-- زائر غير مسجل --}}
            <div class="guest-wall text-center py-5">
                <div class="guest-icon-wrap mx-auto mb-4">
                    <i class="fas fa-lock"></i>
                </div>
                <h3>المحتوى متاح للأعضاء فقط</h3>
                <p>سجّل في الموقع للاطلاع على جميع عروض الهواتف الذكية</p>
                <div class="mt-4">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-card-details" style="padding:12px 36px; font-size:1rem; border-radius:30px;">
                            <i class="fas fa-user-plus ml-2"></i>إنشاء حساب مجاناً
                        </a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn-login-guest">
                            <i class="fas fa-sign-in-alt ml-1"></i>تسجيل الدخول
                        </a>
                    @endif
                </div>
            </div>
            @endauth
        @else
            @auth
            <div class="empty-state">
                <i class="fas fa-mobile-alt"></i>
                <h4>لا توجد عروض حالياً</h4>
                <p>تابعنا قريباً لأحدث عروض الهواتف الذكية</p>
                <a href="/" class="btn-card-details" style="padding:10px 28px; font-size:0.95rem;">
                    <i class="fas fa-home ml-1"></i>العودة للرئيسية
                </a>
            </div>
            @else
            <div class="guest-wall text-center py-5">
                <div class="guest-icon-wrap mx-auto mb-4">
                    <i class="fas fa-lock"></i>
                </div>
                <h3>المحتوى متاح للأعضاء فقط</h3>
                <p>سجّل في الموقع للاطلاع على جميع عروض الهواتف الذكية</p>
                <div class="mt-4">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-card-details" style="padding:12px 36px; font-size:1rem; border-radius:30px;">
                            <i class="fas fa-user-plus ml-2"></i>إنشاء حساب مجاناً
                        </a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn-login-guest">
                            <i class="fas fa-sign-in-alt ml-1"></i>تسجيل الدخول
                        </a>
                    @endif
                </div>
            </div>
            @endauth
        @endif
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
