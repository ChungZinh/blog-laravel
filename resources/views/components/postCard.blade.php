@props(['post', 'full' => false])

{{-- POST CARD COMPONENT --}}

<div class="shadow-md my-4 bg-white p-4 rounded-md space-y-2">
    {{-- COVER IMAGE --}}
    @if ($post->image)
        <div class="w-full h-48">
            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-48 object-cover rounded-md"
                alt="Post cover image">
        </div>
    @endif

    {{-- TITLE --}}
    <h1 class="text-xl font-semibold">{{ $post->title }}</h1>
    {{-- AUTHOR AND DATE --}}
    <div class="">
        <span>Posted {{ $post->created_at->diffForHumans() }} by </span>
        <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500">{{ $post->user->username }}</a>
    </div>
    {{-- BODY --}}
    <div class="mt-2">
        <p class="font-light text-sm"> {{ $full ? $post->body : Str::limit($post->body, 200) }} </p>
        @if (!$full)
            <a href="{{ route('posts.show', $post) }}" class="text-blue-500 text-sm">Read more &rarr;</a>
        @endif
    </div>

    <div class="mt-4 flex items-center justify-end gap-4">
        {{ $slot }}
    </div>
</div>
