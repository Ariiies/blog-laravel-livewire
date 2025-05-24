<x-layouts.admin>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}" icon="table-cells" libewire:navigate>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('roles.index') }}" libewire:navigate>Role</flux:breadcrumbs.item> 
        <flux:breadcrumbs.item>Edit</flux:breadcrumbs.item> 
    </flux:breadcrumbs>

    <h1 class="text-2xl font-bold mb-6">Edit Role</h1>

    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block font-medium">Role</label>
            <input 
            type="text" 
            name="name" 
            id="name" 
            class="border rounded w-full p-2" 
            value="{{ old('name', $role->name) }}" 
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
            value="{{ old('guard_name', $role->guard_name) }}" 
            required
            >
            @error('guard_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label class="block font-medium mb-2">Permisos</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @foreach($permissions as $permission)
                <label class="flex items-center bg-gray-50 border rounded px-3 py-2 hover:bg-blue-50 transition cursor-pointer">
                <input 
                    type="checkbox" 
                    name="permissions[]" 
                    value="{{ $permission->id }}"
                    class="form-checkbox text-blue-600 focus:ring-blue-500 mr-3"
                    @checked(in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray()) ))
                >
                <span class="text-gray-800">{{ $permission->name }}</span>
                </label>
            @endforeach
            </div>
            @error('permissions')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>
        <a href="{{ route('roles.index') }}" class="ml-2 bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
            Cancel
        </a>
    </form>
</x-layouts.admin>