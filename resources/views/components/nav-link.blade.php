@props(['href' => '#', 'active' => false])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'text-sm font-medium transition-colors duration-200 hover:text-primary ' . ($active ? 'text-gray-900' : 'text-gray-500')]) }}>
    {{ $slot }}
    @isset($icon)
        {{ $icon }}
    @endisset
</a>
