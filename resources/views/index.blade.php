<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $header }}
        </h2>
    </x-slot>

    <div class="w-full">
        @if ($datatable)
            @livewire($datatable)
        @endif
    </div>
</x-app-layout>
