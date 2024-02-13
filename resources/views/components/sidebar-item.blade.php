@props(['title' => '', 'icon' => '', 'route' => '', 'active' => false, 'onclick' => ''])

<li>
    <a href="{{ $route }}" onclick="{{ $onclick }}"
        class="flex items-center px-3 py-4 text-xs {{ $active ? 'bg-primary text-white' : 'text-gray-900' }}">
        <i class="w-3 h-3 {{ $active ? 'text-white' : 'text-gray-500' }} transition duration-75 {{ $icon }}"></i>
        <span class="ml-2">
            {{ $title }}
        </span>
    </a>
</li>
