<x-layouts.admin>
	{{-- Add your page content here --}}
        <flux:breadcrumbs  class="mb-4">
            <flux:breadcrumbs.item href="{{route('admin.dashboard')}}" icon="table-cells"/>
            <flux:breadcrumbs.item>users</flux:breadcrumbs.item> 
        </flux:breadcrumbs>
        <div class="relative overflow-x-auto rounded-lg shadow">
            <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800">
                <thead class="text-xs uppercase bg-blue-50 dark:bg-gray-700 text-blue-900 dark:text-gray-200">
                    <tr>
                        <!-- table heads -->
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">user</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Edit</th>
                        <th class="px-6 py-3">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- table elements  -->
                    @foreach ($users as $user)
                        <tr class="{{ $loop->even ? 'bg-blue-100 dark:bg-gray-700' : 'bg-white dark:bg-gray-800' }} border-b border-gray-200 dark:border-gray-700">
                            <th class="px-6 py-4 font-medium whitespace-nowrap">{{ $user->id }}</th>
                            <td class="px-6 py-4">
                                <a href="{{ route('users.show', $user) }}" class="text-blue-700 dark:text-blue-300 font-semibold hover:underline">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if($user->roles && $user->roles->count())
                                    {{ $user->roles->pluck('name')->join(', ') }}
                                @else
                                    s/n
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Edit</a>
                            </td>
                            <td class="px-6 py-4">
                                <form class="delete-form" action="{{ route('users.destroy', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold cursor-pointer">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links('pagination::tailwind') }}
        </div>
        <div class="mt-6">
            <a href="{{ route('users.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold shadow">
                + Add users
            </a>
        </div>

        @push('js')
            <script>
                const deleteForms = document.querySelectorAll('.delete-form');
                deleteForms.forEach(form => {
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            </script>
        @endpush

</x-layouts.admin>