<div>
    {{-- Stop trying to control. --}}
    {{--@livewire('test.hijo')--}}
    <x-button 
        class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition font-semibold mb-4"
        type="button"
        {{--wire:click="$set('count', 0)"--}}
        wire:click="$toggle('show')"
        
    >
        Show / Hide
    </x-button>
    <h1 class="text-2xl font-bold text-center mb-4">Countries</h1>

    <form class="mb-4" wire:submit.prevent="add">
        <x-input 
            wire:model="pais"
            placeholder="input a country name"
            wire:keydown.space="incrementCount"
        />
        <x-button type="submit" class="mt-2">
            Add Country
        </x-button>
    </form>
    
   <ul class="flex flex-col items-center space-y-2 list-disc">
    @if($show)
        @foreach($countries as $country)
            <li wire:key="pais-{{$country}}" class="text-lg space-y-2 flex items-center gap-2">
                <span wire:mouseenter="changeActive('{{$country}}')">
                    {{ $country }}
                </span>
                
                <button 
                    wire:click="remove('{{ $country }}')"
                    class="px-1.5 py-0.5 bg-red-500 text-white rounded-full text-xs hover:bg-red-600 transition"
                    title="Remove"
                >
                    ✕
                </button>
            </li>
        @endforeach
    @endif
    Active: {{$active}}
    <br>
    counter: {{$count}}
</ul>
</div>
