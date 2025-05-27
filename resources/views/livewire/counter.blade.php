<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div style="text-align: center">
    <x-button wire:click="increment(2)">+</x-button>
    <x-button wire:click="decrement">-</x-button>
    <x-button wire:click="resetCount">Reset</x-button>
    <h1>{{ $count }}</h1>
</div>

</div>
