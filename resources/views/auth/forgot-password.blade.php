<x-layout>
    <h1 class="text-center my-10 text-4xl">Request a password reset email</h1>

    {{-- SESSION MESSAGES --}}
    <div class="">
        @if (session('status'))
            <x-flashMsg msg="{{ session('status') }}" />
        @elseif (session('email'))
            <x-flashMsg msg="{{ session('email') }}" bg='bg-red-500' />
        @endif
    </div>


    <div class="mx-auto max-w-screen-sm p-4 border rounded-lg bg-white shadow-md">
        <form action="{{ route('password.email') }}" method="POST" x-data="formSubmit" @submit.prevent="submit">
            @csrf
            @method('POST')
            {{-- EMAIL --}}
            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="input  @error('email')
                         ring-red-500
                    @enderror">
                @error('email')
                    <p class="text-red-500 text-sm">*{{ $message }}</p>
                @enderror
            </div>

            {{-- SUBMIT BUTTON --}}
            <button x-ref="btn"
                class="btn bg-slate-800 w-full py-2 rounded-md text-white hover:bg-slate-600 duration-300">Submit</button>
        </form>
    </div>
</x-layout>
