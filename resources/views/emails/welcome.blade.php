<h1>Hello {{ $user->username }}</h1>

<div class="">
    <h1>You created {{ $post->title }}</h1>
    <p>{{ $post->body }}</p>

    <img width="300" src="{{ $message->embed('storage/' . $post->image) }}" alt="img">
</div>
