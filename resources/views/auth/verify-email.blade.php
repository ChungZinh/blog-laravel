<x-layout>
    <h1 class="my-4">Please verify your email through the email we've sent you.</h1>

    <p>Didn't get the email?</p>
    <form action="{{route('verification.send')}}" method="POST">
        @csrf
        @method('POST')
        <button class="bg-slate-600 w-full my-4">Send again</button>
    </form>
</x-layout>
