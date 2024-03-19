<x-layouts.main>

    <x-page-header>
        Yangi Post yaratish
    </x-page-header>
    <div class="contact-form container px-36">
        <div id="success"></div>
        <form action=" {{ route('posts.store') }} " method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="col-sm-6 control-group">
                    <input type="text" class="form-control p-4" placeholder="Sarlavha" name="title"
                        value="{{ old('title') }}" />
                    @error('title')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-sm-6 control-group">
                    <select name="category_id" class=" border rounded-5 p-3" style="border-radius:15px; outline: none; border:none">
                        @foreach ($categories as $category)
                            <option value={{ $category->id }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 control-group">
                    <select multiple name="tags[]" class="kt-selectpicker border rounded-5 p-3" style="border-radius:15px; outline: none; border:none">
                        @foreach ($tags as $tag)
                            <option value={{ $tag->id }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6 control-group">
                    <input type="text" class="form-control p-4" name="phone_number" placeholder="Telefon raqam"
                        value="{{ old('phone_number') }}" />
                    @error('phone_number')
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
                    <input type="text" class="form-control p-4" name="short_content" placeholder="Qisqacha malumot"
                        value="{{ old('short_content') }}" />
                    @error('short_content')
                        <p class="help-block text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="control-group">
                <textarea class="form-control p-4" rows="6" name="content" placeholder="To'liq malumot">{{ old('content') }}</textarea>
                @error('title')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button class="btn btn-primary btn-block py-3 px-5" type="submit">Save</button>
            </div>
        </form>
    </div>
</x-layouts.main>
