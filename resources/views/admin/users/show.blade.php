<x-layouts.admin>
	{{-- Add your page content here --}}
        <flux:breadcrumbs  class="mb-4">
            <flux:breadcrumbs.item href="{{route('admin.dashboard')}}" icon="table-cells"/>
            <flux:breadcrumbs.item>User x.x</flux:breadcrumbs.item> 
        </flux:breadcrumbs>

<div class="mb-6">
    <label class="block text-base font-semibold text-gray-200">Nombre</label>
    <div class="mt-1 p-3 border border-gray-300 rounded-lg bg-white text-gray-800 shadow-sm">{{ $user->name }}</div>
</div>
<div class="mb-6">
    <label class="block text-base font-semibold text-gray-200">Correo electrónico</label>
    <div class="mt-1 p-3 border border-gray-300 rounded-lg bg-white text-gray-800 shadow-sm">{{ $user->email }}</div>
</div>
<div class="mb-6">
    <label class="block text-base font-semibold text-gray-200">Total de posts</label>
    <div class="mt-1 p-3 border border-gray-300 rounded-lg bg-white text-gray-800 shadow-sm">{{ $user->posts->count() }}</div>
</div>
<div class="mb-6">
    <label class="block text-base font-semibold text-gray-200">Roles</label>
    <div class="mt-1 p-3 border border-gray-300 rounded-lg bg-white text-gray-800 shadow-sm">
        @if($user->roles && $user->roles->count())
            {{ $user->roles->pluck('name')->join(', ') }}
        @else
            <span class="text-gray-500">No role(s) asigned.</span>
        @endif
    </div>
</div>

@can('admin')
    <div class="flex gap-4 mt-8">
        <a href="{{ route('admin.users.edit', $user) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Editar usuario</a>
        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Eliminar usuario</button>
        </form>
    </div>
@endcan
</x-layouts.admin>