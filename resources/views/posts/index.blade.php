<x-layout>
    <h1 class="title">Posts</h1>
    <div class="grid grid-cols-2 gap-x-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post" />
        @endforeach
    </div>

    <div class="">
        {{ $posts->links() }}
    </div>

</x-layout>
