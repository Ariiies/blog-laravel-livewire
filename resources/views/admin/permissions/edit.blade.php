<x-layouts.admin>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}" icon="table-cells" libewire:navigate>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('permissions.index') }}" libewire:navigate>Permission</flux:breadcrumbs.item> 
        <flux:breadcrumbs.item>Edit</flux:breadcrumbs.item> 
    </flux:breadcrumbs>

    <h1 class="text-2xl font-bold mb-6">Edit Permission</h1>

    <form action="{{ route('permissions.update', $permission->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block font-medium">Permission</label>
            <input 
            type="text" 
            name="name" 
            id="name" 
            class="border rounded w-full p-2" 
            value="{{ old('name', $permission->name) }}" 
            required
            >
            @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="guard_name" class="block font-medium">Guard Name</label>
            <input 
            type="text" 
            name="guard_name" 
            id="guard_name" 
            class="border rounded w-full p-2" 
            value="{{ old('guard_name', $permission->guard_name) }}" 
            required
            >
            @error('guard_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>
        <a href="{{ route('permissions.index') }}" class="ml-2 bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
            Cancel
        </a>
    </form>
</x-layouts.admin>