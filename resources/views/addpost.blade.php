<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhoneStore - رفع بوست</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Store CSS -->
    <link rel="stylesheet" href="{{ asset('css/store-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/addpost.css') }}">
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
            <li class="nav-item">
                <a class="nav-link" href="/"><i class="fas fa-home ml-1"></i>الرئيسية</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/posts') }}"><i class="fas fa-tags ml-1"></i>عروض الهواتف</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/addpost') }}"><i class="fas fa-plus-circle ml-1"></i>رفع بوست</a>
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

<!-- ===== PAGE HEADER ===== -->
<div class="page-header">
    <div class="container">
        <span class="badge-label"><i class="fas fa-upload ml-1"></i>نشر جديد</span>
        <h1>رفع بوست جديد</h1>
        <p>شارك عرض هاتفك مع الجميع</p>
    </div>
</div>

<!-- ===== FORM ===== -->
<section class="form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-card">
                    <div class="form-card-header">
                        <i class="fas fa-pen-to-square"></i>
                        <h4>تفاصيل البوست</h4>
                    </div>
                    <div class="form-card-body">
                        <form method="POST" action="{{ url('/ainsertpost') }}" enctype="multipart/form-data" id="addPostForm">
                            @csrf

                            {{-- عنوان البوست --}}
                            <div class="form-group">
                                <label for="title">
                                    <i class="fas fa-heading"></i>عنوان البوست
                                </label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="مثال: iPhone 15 Pro بسعر مميز" required>
                            </div>

                            {{-- المحتوى --}}
                            <div class="form-group">
                                <label for="content">
                                    <i class="fas fa-align-right"></i>تفاصيل العرض
                                </label>
                                <textarea class="form-control" id="content" name="content"
                                          placeholder="اكتب تفاصيل العرض، المواصفات، السعر..." required></textarea>
                            </div>

                            {{-- التصنيف --}}
                            <div class="form-group">
                                <label for="category">
                                    <i class="fas fa-list"></i>التصنيف
                                </label>
                                <select class="form-control" id="category" name="category" required>
                                    <option value="">-- اختر التصنيف --</option>
                                    @foreach($addpost as $category)
                                        <option value="{{ $category->cat_id }}">{{ $category->cat_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- رفع صورة --}}
                            <div class="form-group">
                                <label for="image">
                                    <i class="fas fa-image"></i>صورة الهاتف (اختياري)
                                </label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/*">
                            </div>

                            {{-- أزرار --}}
                            <div class="mt-4">
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane ml-2"></i>نشر البوست
                                </button>
                                <a href="{{ url('/posts') }}" class="btn-cancel">إلغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
