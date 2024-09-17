@props(['msg', 'bg' => 'bg-green-500'])

<p class="text-sm font-medium text-white {{$bg}} px-3 mb-4 py-2 rounded-md">
    {{ $msg }}
</p>
