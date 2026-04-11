@php use Illuminate\Support\Facades\Storage; @endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhoneStore - {{ $post->p_title }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Store CSS -->
    <link rel="stylesheet" href="{{ asset('css/store-base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
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
        <ul class="navbar-nav mr-auto">
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
        <div class="d-flex align-items-center">
            @auth
                <span class="user-greeting"><i class="fas fa-user-circle"></i>{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-login nav-link" style="background:none;cursor:pointer;">
                        <i class="fas fa-sign-out-alt ml-1"></i>خروج
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-login nav-link"><i class="fas fa-sign-in-alt ml-1"></i>دخول</a>
                <a href="{{ route('register') }}" class="btn-register nav-link"><i class="fas fa-user-plus ml-1"></i>تسجيل</a>
            @endauth
        </div>
    </div>
</nav>

<!-- POST PAGE -->
<div class="post-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Post Card -->
                <div class="post-main-card">
                    @if($post->img)
                        <img src="{{ Storage::url($post->img) }}" alt="{{ $post->p_title }}" class="post-main-img">
                    @else
                        <img src="https://picsum.photos/seed/{{ $post->post_id }}/900/400"
                             alt="{{ $post->p_title }}" class="post-main-img">
                    @endif

                    <div class="post-main-body">
                        @if($post->categorys)
                            <span class="post-category-badge">
                                <i class="fas fa-tag ml-1"></i>{{ $post->categorys->cat_name }}
                            </span>
                        @endif

                        <h1 class="post-main-title">{{ $post->p_title }}</h1>

                        <div class="post-meta">
                            <span>
                                <i class="fas fa-user"></i>
                                {{ $post->users ? $post->users->name : 'مجهول' }}
                            </span>
                            <span>
                                <i class="fas fa-calendar"></i>
                                {{ $post->created_at ? $post->created_at->format('Y/m/d') : '' }}
                            </span>
                            <span>
                                <i class="fas fa-comments"></i>
                                {{ $post->comments->count() }} تعليق
                            </span>
                        </div>

                        <div class="post-main-content">
                            {{ $post->p_content }}
                        </div>

                        <a href="{{ url('/posts') }}" class="back-btn">
                            <i class="fas fa-arrow-right ml-1"></i>العودة للعروض
                        </a>
                    </div>
                </div>

                <!-- Comments -->
                <div class="comments-card">
                    <div class="comments-header">
                        <i class="fas fa-comments"></i>
                        <h5>التعليقات</h5>
                        <span class="count-badge">{{ $post->comments->count() }}</span>
                    </div>

                    <div class="comments-list">
                        @forelse($post->comments as $comment)
                            <div class="comment-item">
                                <div class="comment-avatar">
                                    {{ mb_substr($comment->user ? $comment->user->name : '؟', 0, 1) }}
                                </div>
                                <div class="comment-body">
                                    <div class="comment-username">
                                        {{ $comment->user ? $comment->user->name : 'مجهول' }}
                                        <span class="comment-time">
                                            {{ $comment->created_at ? $comment->created_at->diffForHumans() : '' }}
                                        </span>
                                    </div>
                                    <p class="comment-text">{{ $comment->com_content }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="no-comments">
                                <i class="fas fa-comment-slash"></i>
                                لا توجد تعليقات بعد، كن أول من يعلّق!
                            </div>
                        @endforelse
                    </div>

                    <!-- Comment Form -->
                    @auth
                    <div class="comment-form-wrap">
                        <form method="POST" action="{{ url('/post/' . $post->post_id . '/comment') }}">
                            @csrf
                            <label for="comment">
                                <i class="fas fa-pen"></i>أضف تعليقك
                            </label>
                            <textarea class="comment-input" id="comment" name="comment"
                                      rows="3" placeholder="اكتب تعليقك هنا..." required></textarea>
                            <button type="submit" class="btn-comment-submit">
                                <i class="fas fa-paper-plane ml-1"></i>إرسال التعليق
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="comment-form-wrap text-center">
                        <p style="color:#888; margin-bottom:10px;">
                            <i class="fas fa-lock" style="color:#e94560;"></i>
                            سجّل دخولك لإضافة تعليق
                        </p>
                        <a href="{{ route('login') }}" class="btn-comment-submit" style="text-decoration:none; display:inline-block;">
                            <i class="fas fa-sign-in-alt ml-1"></i>تسجيل الدخول
                        </a>
                    </div>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="store-footer mt-5">
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
