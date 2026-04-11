<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhoneStore - إنشاء حساب</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/store-base.css') }}">

    <style>
        .auth-page {
            margin-top: 66px;
            min-height: calc(100vh - 66px);
            background: linear-gradient(135deg, #0f0f23 0%, #16213e 60%, #0f3460 100%);
            display: flex;
            align-items: center;
            padding: 40px 0;
        }

        .auth-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .auth-card-left {
            background: linear-gradient(135deg, #e94560, #c73652);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .auth-card-left i { font-size: 4rem; color: #fff; margin-bottom: 20px; }
        .auth-card-left h2 { color: #fff; font-weight: 900; font-size: 1.8rem; margin-bottom: 10px; }
        .auth-card-left p { color: rgba(255,255,255,0.85); font-size: 0.95rem; line-height: 1.7; }

        .auth-card-right { padding: 40px 36px; }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 900;
            color: #0f0f23;
            margin-bottom: 6px;
        }

        .auth-subtitle { color: #888; font-size: 0.9rem; margin-bottom: 28px; }

        .auth-label {
            font-weight: 700;
            color: #0f0f23;
            font-size: 0.88rem;
            margin-bottom: 5px;
            display: block;
        }

        .auth-input {
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            padding: 10px 14px;
            font-family: 'Cairo', sans-serif;
            font-size: 0.92rem;
            width: 100%;
            transition: border-color 0.3s, box-shadow 0.3s;
            margin-bottom: 16px;
        }

        .auth-input:focus {
            border-color: #e94560;
            box-shadow: 0 0 0 3px rgba(233,69,96,0.12);
            outline: none;
        }

        .btn-auth {
            background: #e94560;
            color: #fff;
            border: none;
            border-radius: 30px;
            padding: 12px 0;
            width: 100%;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Cairo', sans-serif;
            transition: all 0.3s;
            box-shadow: 0 6px 20px rgba(233,69,96,0.35);
            cursor: pointer;
        }

        .btn-auth:hover {
            background: #c73652;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(233,69,96,0.45);
        }

        .auth-link {
            color: #e94560;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.88rem;
        }

        .auth-link:hover { color: #c73652; text-decoration: underline; }

        .error-msg {
            background: #fff5f5;
            border: 1px solid #fecaca;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 16px;
            color: #e94560;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg store-navbar fixed-top">
    <a class="navbar-brand" href="/">
        <i class="fas fa-mobile-alt"></i>Phone<span>Store</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain">
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
        </ul>
        <div class="d-flex align-items-center">
            <a href="{{ route('login') }}" class="btn-login nav-link">
                <i class="fas fa-sign-in-alt ml-1"></i>دخول
            </a>
            <a href="{{ route('register') }}" class="btn-register nav-link">
                <i class="fas fa-user-plus ml-1"></i>تسجيل
            </a>
        </div>
    </div>
</nav>

<!-- AUTH PAGE -->
<div class="auth-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">
                <div class="auth-card">
                    <div class="row no-gutters">

                        <!-- Left Side -->
                        <div class="col-lg-5 auth-card-left d-none d-lg-flex">
                            <i class="fas fa-user-plus"></i>
                            <h2>انضم إلينا!</h2>
                            <p>سجّل حساباً مجانياً واستمتع بتصفح أحدث عروض الهواتف الذكية</p>
                        </div>

                        <!-- Right Side - Form -->
                        <div class="col-lg-7 auth-card-right">
                            <h3 class="auth-title">إنشاء حساب جديد</h3>
                            <p class="auth-subtitle">أدخل بياناتك للتسجيل في PhoneStore</p>

                            @if ($errors->any())
                                <div class="error-msg">
                                    <i class="fas fa-exclamation-circle ml-1"></i>
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div>
                                    <label class="auth-label" for="name">
                                        <i class="fas fa-user" style="color:#e94560; margin-left:5px;"></i>الاسم
                                    </label>
                                    <input class="auth-input" id="name" type="text" name="name"
                                           value="{{ old('name') }}" required autofocus
                                           placeholder="أدخل اسمك الكامل">
                                </div>

                                <div>
                                    <label class="auth-label" for="email">
                                        <i class="fas fa-envelope" style="color:#e94560; margin-left:5px;"></i>البريد الإلكتروني
                                    </label>
                                    <input class="auth-input" id="email" type="email" name="email"
                                           value="{{ old('email') }}" required
                                           placeholder="example@email.com">
                                </div>

                                <div>
                                    <label class="auth-label" for="password">
                                        <i class="fas fa-lock" style="color:#e94560; margin-left:5px;"></i>كلمة المرور
                                    </label>
                                    <input class="auth-input" id="password" type="password" name="password"
                                           required autocomplete="new-password"
                                           placeholder="أدخل كلمة مرور قوية">
                                </div>

                                <div>
                                    <label class="auth-label" for="password_confirmation">
                                        <i class="fas fa-key" style="color:#e94560; margin-left:5px;"></i>تأكيد كلمة المرور
                                    </label>
                                    <input class="auth-input" id="password_confirmation" type="password"
                                           name="password_confirmation" required
                                           placeholder="أعد إدخال كلمة المرور">
                                </div>

                                <button type="submit" class="btn-auth">
                                    <i class="fas fa-user-plus ml-2"></i>إنشاء الحساب
                                </button>

                                <div class="text-center mt-3">
                                    <span style="color:#888; font-size:0.88rem;">لديك حساب بالفعل؟</span>
                                    <a href="{{ route('login') }}" class="auth-link mr-1">تسجيل الدخول</a>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
