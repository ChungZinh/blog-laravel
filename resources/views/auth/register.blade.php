<x-layout>
    <h1 class="text-center my-10 text-4xl">Register</h1>
    <div class="mx-auto max-w-screen-sm p-4 border rounded-lg bg-white shadow-md">
        <form action="{{ route('register') }}" method="POST" x-data="formSubmit" @submit.prevent="submit">
            @csrf
            @method('POST')
            {{-- USERNAME --}}
            <div class="mb-4">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}"
                    class="input 
                    @error('username')
                         ring-red-500
                    @enderror
                ">
                @error('username')
                    <p class="text-red-500 text-sm">*{{ $message }}</p>
                @enderror
            </div>
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
            {{-- PASSWORD --}}
            <div class="mb-4">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                    class="input  @error('password')
                         ring-red-500
                    @enderror">
                @error('password')
                    <p class="text-red-500 text-sm">*{{ $message }}</p>
                @enderror
            </div>
            {{-- PASSWORD CONFIRMATION --}}
            <div class="mb-8">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="input @error('password')
                         ring-red-500
                    @enderror">
            </div>

            <div class="mb-4 flex  items-center gap-2">
                <input type="checkbox" name="subcribe" id="subcribe">
                <label for="subcribe">Subcribe to our newsletter</label>
            </div>

            {{-- REGISTER BUTTON --}}
            <button x-ref="btn"
                class="btn bg-slate-800 w-full py-2 rounded-md text-white hover:bg-slate-600 duration-300">Register</button>
        </form>
    </div>
</x-layout>
