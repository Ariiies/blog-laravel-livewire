<x-layouts.admin>
    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}" icon="table-cells" libewire:navigate>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('users.index') }}" libewire:navigate>User</flux:breadcrumbs.item> 
        <flux:breadcrumbs.item>Edit</flux:breadcrumbs.item> 
    </flux:breadcrumbs>
    <h1 class="text-2xl font-bold mb-6">Edit User</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name" class="block font-medium">User</label>
            <input 
                type="text" 
                name="name" 
                id="name" 
                class="border rounded w-full p-2" 
                value="{{ old('name', $user->name) }}" 
                required
            >
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block font-medium">Email</label>
            <input 
                type="text" 
                name="email" 
                id="email" 
                class="border rounded w-full p-2" 
                value="{{ old('email', $user->email) }}" 
                required
            >
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block font-medium">Password</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="border rounded w-full p-2"
            >
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label class="block font-medium mb-2">Roles</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($roles as $role)
                    <label class="flex items-center bg-gray-50 border rounded px-3 py-2 hover:bg-blue-50 transition cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="roles[]" 
                            value="{{ $role->id }}"
                            class="form-checkbox text-blue-600 focus:ring-blue-500 mr-3"
                            @checked(in_array($role->id, old('roles', $user->roles->pluck('id')->toArray()) ))
                        >
                        <span class="text-gray-800">{{ $role->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('roles')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>
        <a href="{{ route('users.index') }}" class="ml-2 bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
            Cancel
        </a>
    </form>
</x-layouts.admin>