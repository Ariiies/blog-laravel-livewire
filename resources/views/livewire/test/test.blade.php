<div>
    <h1></h1>Test</h1>
    <x-input type="text" wire:model="name"/>
    <x-input type="email" wire:model="email"/>
    <x-button wire:click="check">check</x-button>
        {{$name}}
        {{$email}}
</div>
