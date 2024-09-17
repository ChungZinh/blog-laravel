<x-layout>
    <h1 class="text-2xl font-semibold text-center my-8">Welcome {{ auth()->user()->username }}, you have
        {{ $posts->count() }}
        posts</h1>

    {{-- CREATE POST --}}
    <div class="mx-auto max-w-screen-sm bg-white p-6 rounded-md shadow-md">
        <h2 class="font-semibold mb-4 text-center">Create a new post</h2>


        {{-- SESSION MESSAGES --}}
        <div class="">
            @if (session('success'))
                <x-flashMsg msg="{{ session('success') }}" />
            @elseif (session('delete'))
                <x-flashMsg msg="{{ session('delete') }}" />
            @endif
        </div>


        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            @method('POST')

            <div class="">
                <label for="title" class="block">Post title</label>
                <input type="text" name="title" id="title"
                    class="w-full border  p-2 rounded-md
                    @error('title') border-red-500 @enderror"
                    value="{{ old('title') }}">

                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

            </div>

            <div class="mt-4">
                <label for="body" class="block">Post content</label>
                <textarea name="body" id="body"
                    class="w-full border p-2 rounded-md
                    @error('body') border-red-500 @enderror" rows="5">{{ old('body') }}
                    </textarea>

                @error('body')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 w-full text-white px-4 py-2 rounded-md">Create</button>
            </div>

        </form>
    </div>


    {{-- USER POSTS --}}
    <h2 class="font-semibold mb-4 text-center mt-8">Your Latest Posts</h2>
    <div class="grid grid-cols-2 gap-x-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post">
                {{-- UPDATE POST --}}
                <a href="{{ route('posts.edit', $post) }}"
                    class="text-sm px-1 py-1 bg-green-500 text-white rounded-md">Update</a>


                {{-- DELETE POST --}}
                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm px-1 py-1 bg-red-500 text-white rounded-md">Remove</button>
                </form>
            </x-postCard>
        @endforeach
    </div>

    <div class="">
        {{ $posts->links() }}
    </div>


</x-layout>
