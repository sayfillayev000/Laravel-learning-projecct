<nav class="navbar navbar-expand-lg bg-white navbar-light p-0">
    <a href="" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 display-4 text-primary">Klean</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav mr-auto py-0">
            <a href="/" class="nav-item nav-link active">{{ __('Main') }}</a>
            <a href="{{ route('about') }}" class="nav-item nav-link">{{ __('About Us') }}</a>
            <a href="{{ route('services') }}" class="nav-item nav-link">Xizmatlar</a>
            <a href="{{ route('projects') }}" class="nav-item nav-link">Loyihalar</a>
            <a href="{{ route('posts.index') }}" class="nav-item nav-link">Blog</a>
            <a href="{{ route('contact') }}" class="nav-item nav-link">A'loqa</a>
        </div>
        @foreach ($all_locales as $locale)
            <a href={{ route('locale.change', ['locale' => $locale]) }} class="btn btn-primary mr-3 d-none d-lg-block">
                {{ $locale }}
            </a>
        @endforeach
        @auth
            @if (auth()->user()->unreadNotifications()->count() > 0)
                <a class="w-10" style="color:" href={{ route('notifications.index') }}>
                    <svg style="width: 50px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                    <span style="bottom: 60px; left:35px"
                        class="position-relative text-danger ">{{ auth()->user()->unreadNotifications()->count() }}</span>
                </a>
            @endif
            <h4 class=" mr-4">
                {{ auth()->user()->name }}
            </h4>
            <a href="{{ route('posts.create') }} " class="btn btn-primary mr-3 d-none d-lg-block">Post yaratish</a>
            <form action={{ route('logout') }} method="POST">
                @csrf
                <button type="submit" class="btn btn-dark mr-3 d-none d-lg-block">Chiqish</button>
            </form>
        @else
            <a href="{{ route('login') }} " class="btn btn-primary mr-3 d-none d-lg-block">Kirish</a>
        @endauth
    </div>
</nav>
