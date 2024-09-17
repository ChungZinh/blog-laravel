<x-layout>
    <h1 class="text-center my-10 text-4xl">Login</h1>
    <div class="mx-auto max-w-screen-sm p-4 border rounded-lg bg-white shadow-md">
        <form action="{{ route('login') }}" method="POST">
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
            {{-- REMEMBER --}}
            <div class="mb-4 flex items-center ">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember">Remember me</label>
            </div>

            @error('failed')
                    <p class="text-red-500 text-sm">*{{ $message }}</p>
                @enderror

            {{-- LOGIN BUTTON --}}
            <button
                class="btn bg-slate-800 w-full py-2 rounded-md text-white hover:bg-slate-600 duration-300">Login</button>
        </form>
    </div>
</x-layout>
