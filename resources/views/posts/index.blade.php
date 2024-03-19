<x-layouts.main>
    <x-page-header>
        Blog
    </x-page-header>

    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container">
            @switch(session('status'))
                @case('success')
                    <div class="alert alert-success" role="alert">
                        {{ __('Post created successfully!') }}
                    </div>
                @break

                @case('error')
                    <div class="alert alert-danger" role="alert">
                        {{ __(session('error')) }}
                    </div>
                @break

                @case('warning')
                    <div class="alert alert-warning" role="alert">
                        {{ __(session('warning')) }}
                    </div>
                @break

                @default
            @endswitch
            <div class="row align-items-end mb-4">

                <div class="col-lg-6">
                    <h6 class="text-secondary font-weight-semi-bold text-uppercase mb-3">Latest Blog</h6>
                    <h1 class="section-title mb-3">Oxirgi postlar</h1>
                </div>
            </div>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6 mb-5">
                        <div class="position-relative mb-4">
                            <img class="img-fluid rounded w-100" src="{{ asset('storage/' . $post->photo) }}"
                                alt="rasm">
                            <div class="blog-date">
                                <h4 class="font-weight-bold mb-n1">01</h4>
                                <small class="text-white text-uppercase">Jan</small>
                            </div>
                        </div>
                        <div class="d-flex mb-2">
                            @foreach ($post->tags as $tag)
                                <a class="text-secondary text-uppercase font-weight-medium"
                                    href="">{{ $tag->name }}</a>
                                <span class="text-primary px-2">|</span>
                            @endforeach
                            <a class="text-danger text-uppercase font-weight-medium">{{ $post->category->name }}</a>
                        </div>
                        <h5 class="font-weight-medium mb-2">{{ $post->title }}</h5>
                        <p class="mb-4">{{ $post->short_content }}</p>
                        <a class="btn btn-sm btn-primary py-2"
                            href="{{ route('posts.show', ['post' => $post->id]) }}">O'qish</a>
                    </div>
                @endforeach

            </div>
            {{ $posts->links() }}
        </div>
    </div>
    <!-- Blog End -->


</x-layouts.main>
