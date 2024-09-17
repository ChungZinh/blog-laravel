<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-100 text-slate-900">
    <header>
        <nav>
            <a href="{{ route('posts.index') }}" class="nav-link">Home</a>

            @auth
                <div class="relative grid place-items-center" x-data="{ open: false }">
                    {{-- DROPDOWN MENU BUTTON --}}
                    <button @click="open = !open" type="button" class="round-btn">
                        {{-- <img src="{{ auth()->user()->avatar }}" alt="avatar" class="w-8 h-8 rounded-full"> --}}
                        <img src="https://picsum.photos/200" alt="avatar" class="w-8 h-8 rounded-full">
                    </button>

                    {{-- DROPDOWN MENU --}}
                    <div x-show="open" @click.outside="open = false"
                        class="bg-white shadow-md absolute px-6 top-10 right-0 text-center rounded-lg p-2 overflow-hidden font-light">
                        <p class="username border-b">{{ auth()->user()->username }}</p>
                        <a href="{{ route('dashboard') }}" class="block hover:bg-slate-100 py-2 ">Dashboard</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full hover:bg-slate-100 py-2">Logout</button>
                        </form>
                    </div>

                </div>
            @endauth

            @guest
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </div>
            @endguest


        </nav>
    </header>

    <main class="py-8 px-4 mx-auto max-w-screen-lg">
        {{ $slot }}
    </main>
</body>

</html>
