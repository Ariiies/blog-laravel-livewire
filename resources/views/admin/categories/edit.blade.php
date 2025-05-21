<x-layouts.admin>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}" icon="table-cells" libewire:navigate>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('categories.index') }}" libewire:navigate>Categories</flux:breadcrumbs.item> 
        <flux:breadcrumbs.item>Edit</flux:breadcrumbs.item> 
    </flux:breadcrumbs>

    <h1 class="text-2xl font-bold mb-6">Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block font-medium">Name</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="border rounded w-full p-2" 
                value="{{ old('name', $category->name) }}" 
                required
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>
        <a href="{{ route('categories.index') }}" class="ml-2 bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
            Cancel
        </a>
    </form>
</x-layouts.admin>