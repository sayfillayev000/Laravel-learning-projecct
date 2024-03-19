<x-layouts.main>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="row align-items-end mb-4 d-flex justify-content-sm-around">
                <h1 class="col-lg-6 section-title mb-3">Xabarnomalar</h1>
                <h1>
                    <a href={{ route('notifications.allRead') }} class="">Barchasi O'qish</a>
                </h1>
            </div>
            <div class="">
                {{-- @dd($notifications) --}}
                @foreach ($notifications as $notification)
                    <div class="border raunded mb-3 p-4">
                        <div class="position-relative mb-4">
                            @if ($notification->read_at === null)
                                <div class="blog-date">
                                    <h4 class="font-weight-bold mb-n1">New</h4>
                                </div>
                            @endif
                        </div>
                        <div class="d-flex mb-2">
                            <a
                                class="text-danger text-uppercase font-weight-medium">{{ $notification->data['created_at'] }}</a>
                        </div>
                        <h5 class="font-weight-medium mb-2">{{ $notification->data['title'] }}</h5>
                        <p class="mb-4">Yangi post yaratildi id: {{ $notification->data['id'] }}</p>
                        @if ($notification->read_at === null)
                            <a class="btn btn-sm btn-primary py-2"
                                href={{ route('notifications.read', ['notification' => $notification->id]) }}>O'qildi</a>
                        @endif
                    </div>
                @endforeach

            </div>
            {{ $notifications->links() }}
        </div>
    </div>

</x-layouts.main>
