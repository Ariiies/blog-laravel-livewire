<x-layouts.admin>
    <flux:breadcrumbs  class="mb-4">
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}" icon="table-cells" libewire:navigate>Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{route('categories.index')}}" libewire:navigate>Categories</flux:breadcrumbs.item> 
            <flux:breadcrumbs.item>Create</flux:breadcrumbs.item> 
        </flux:breadcrumbs>
        <h1 class="text-2xl font-bold mb-6">Create Category</h1>
        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block font-medium">Name</label>
                <input type="text" name="name" id="name" class="border rounded w-full p-2" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
            <a href="{{ route('categories.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 ml-2">Cancelar</a>
        </form>
</x-layouts.admin>