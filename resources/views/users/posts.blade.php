<x-layout>
    <h1 class="title text-slate-600">{{$user}}'s Posts <span class="text-slate-800"> {{$posts->count()}}</span></h1>
    <div class="grid grid-cols-2 gap-x-6">
        @foreach ($posts as $post)
            <x-postCard :post="$post" />
        @endforeach
    </div>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>
</x-layout>
