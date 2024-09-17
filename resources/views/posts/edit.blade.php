<x-layout>
    <a href="{{ route('dashboard') }}" class="block mb-8 text-xs text-blue-500">
        &larr; Go back to dashboard</a>

    <div class="mx-auto max-w-screen-sm bg-white p-6 rounded-md shadow-md">
        <h2 class="font-semibold mb-4 text-center">Update a new post</h2>


        {{-- SESSION MESSAGES --}}
        <div class="">
            @if (session('success'))
                <x-flashMsg msg="{{ session('success') }}" />
            @elseif (session('delete'))
                <x-flashMsg msg="{{ session('delete') }}" />
            @endif
        </div>


        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="">
                <label for="title" class="block">Post title</label>
                <input type="text" name="title" id="title"
                    class="w-full border  p-2 rounded-md
                    @error('title') border-red-500 @enderror"
                    value="{{ $post->title }}">

                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

            </div>

            <div class="mt-4">
                <label for="body" class="block">Post content</label>
                <textarea name="body" id="body"
                    class="w-full border p-2 rounded-md
                    @error('body') border-red-500 @enderror" rows="5">{{ $post->body }}
                    </textarea>

                @error('body')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- ADD IMAGE INPUT --}}
            <div class="mt-4">
                <label for="image" class="block">Current image</label>
                <div class="w-full h-48 my-2">
                    <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-48 object-cover rounded-md"
                        alt="Post cover image">
                </div>
                <label for="image" class="block my-2">Post image</label>
                <input type="file" name="image" id="image"
                    class="w-full border p-2 rounded-md
                    @error('image') border-red-500 @enderror">

                @error('image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 w-full text-white px-4 py-2 rounded-md">Update</button>
            </div>

        </form>
    </div>
</x-layout>
