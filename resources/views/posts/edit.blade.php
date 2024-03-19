<x-layouts.main>


    {{-- <x-slot:title>

        Bosh sahifa
    
    </x-slot:title> --}}

    <x-page-header>
        Postni o'zgartirish #{{ $post->id }}
    </x-page-header>
    <div class="contact-form container px-36">
        <div id="success"></div>
        <form action=" {{ route('posts.update',['post' => $post->id]) }} " method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")
            <div class="form-row">
                <div class="col-sm-6 control-group">
                    <input type="text" class="form-control p-4" name="phone_number" placeholder="Phone number"
                        value="{{ $post->content }}" 
                        />
                    @error('phone_number')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-6 control-group">
                    <input type="text" class="form-control p-4" placeholder="Title" name="title"
                        value="{{ $post->title }}" />
                    @error('title')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="col-sm-6 control-group">
                    <input type="file" class="form-control p-4" name="photo" />
                    @error('photo')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-6 control-group">
                    <input type="text" class="form-control p-4" name="short_content" placeholder="Short_content"
                        value="{{$post->short_content }}" />
                    @error('short_content')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="control-group">
                <textarea class="form-control p-4" rows="6" name="content" placeholder="Content">{{ $post->content }}</textarea>
                @error('title')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class=" d-flex gap-4">
                <button class="btn btn-success btn-block py-3 px-5" type="submit">Save</button>
                <a href="{{ route('posts.show',['post' => $post->id])}}" class="btn btn-danger btn-block py-3 px-5" >Bekor qilish</a>
            </div>
        </form>
    </div>
</x-layouts.main>
