<x-layouts.admin>
    <flux:breadcrumbs  class="mb-4">
            <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}" icon="table-cells" libewire:navigate>Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{route('roles.index')}}" libewire:navigate>Users</flux:breadcrumbs.item> 
            <flux:breadcrumbs.item>Create</flux:breadcrumbs.item> 
        </flux:breadcrumbs>
        <h1 class="text-2xl font-bold mb-6">Create User</h1>
        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <flux:input 
                    type="text" 
                    name="name" 
                    id="name" 
                    label="User"
                    class="border rounded w-full p-2" 
                    value="{{ old('name') }}" 
                    required 
                />
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <flux:input 
                    type="text" 
                    name="email" 
                    id="email" 
                    label="Email"
                    class="border rounded w-full p-2" 
                    value="{{ old('email') }}" 
                    required 
                />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <flux:input 
                    type="password" 
                    name="password" 
                    id="password" 
                    label="Password"
                    class="border rounded w-full p-2" 
                    required 
                />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <flux:input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    label="Confirm Password"
                    class="border rounded w-full p-2" 
                    required 
                />
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
                                {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}
                            >
                            <span class="text-gray-800">{{ $role->name }}</span>
                        </label>
                    @endforeach
                </div>
                @error('roles')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create</button>
            <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 ml-2">Cancelar</a>
        </form>
</x-layouts.admin>