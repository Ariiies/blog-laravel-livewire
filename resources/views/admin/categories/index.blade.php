<x-layouts.admin>
	{{-- Add your page content here --}}
        <flux:breadcrumbs  class="mb-4">
            <flux:breadcrumbs.item href="{{route('admin.dashboard')}}" icon="table-cells"/>
            <flux:breadcrumbs.item>Categories</flux:breadcrumbs.item> 
        </flux:breadcrumbs>

    {{-- Add your table's here --}}
   

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Edit
                        </th>
                       <th scope="col" class="px-6 py-3">
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $categories as $category )
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $category->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $category->name }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                        </td>
                        <td class="px-6 py-4">
                            <form class="delete-form" action="{{ route('categories.destroy', $category->id) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 hover:cursor-pointer">Delete</button>
                            </form>
                        </td>
                        </tr>
                        
                    @endforeach
                    
                    </tbody>
                    </table>
                    </div>

                    <div class="mt-4">
                        {{ $categories->links('pagination::tailwind') }}
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('categories.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            + Add Category
                        </a>
                    </div>

                </tbody>
            </table>
        </div>
 
        @push('js')
            <script>
                    const deleteForms = document.querySelectorAll('.delete-form');
                    console.log("here");
                    deleteForms.forEach(form => {
                        form.addEventListener('submit',(e) =>{
                            e.preventDefault();
                            //if (confirm('Are you sure you want to delete this category?')) {
                            //    form.submit();
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
                ;
            </script>
        @endpush
</x-layouts.admin>