<div>
    <div class="relative overflow-x-auto rounded-lg shadow border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-blue-100 mx-auto" style="width: 80%;">
        <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-6 tracking-tight">All my posts</h1>
        <div class="flex justify-between items-center mb-4 px-2">
            <a href="{{ route('user.profile', ['id' => auth()->id()]) }}" class="inline-block px-4 py-1.5 bg-gradient-to-r from-blue-200 to-blue-400 text-blue-900 rounded-lg hover:from-blue-300 hover:to-blue-500 font-semibold shadow transition text-sm">
                Ir a mi perfil
            </a>
            <a href="{{ route('post.create') }}" class="inline-block px-4 py-1.5 bg-gradient-to-r from-blue-400 to-blue-600 text-white rounded-lg hover:from-blue-500 hover:to-blue-700 font-semibold shadow transition text-sm">
                + Add Post
            </a>
        </div>
        <table class="w-full text-xs text-left text-gray-800 bg-transparent">
            <thead class="text-xs uppercase bg-blue-50 text-blue-900">
                <tr>
                    <th class="px-3 py-2 font-bold tracking-wide">ID</th>
                    <th class="px-3 py-2 font-bold tracking-wide">Title</th>
                    <th class="px-3 py-2 font-bold tracking-wide">Author</th>
                    <th class="px-3 py-2 font-bold tracking-wide">Edit</th>
                    <th class="px-3 py-2 font-bold tracking-wide">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr class="{{ $loop->even ? 'bg-blue-50' : 'bg-white' }} border-b border-blue-100 hover:bg-blue-100/60 transition">
                        <th class="px-3 py-2 font-medium whitespace-nowrap">{{ $post->id }}</th>
                        <td class="px-3 py-2">
                            <a href="{{ route('posts.show', $post) }}" class="text-blue-700 font-semibold hover:underline hover:text-blue-900 transition">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td class="px-3 py-2">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-3 h-3 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 10a4 4 0 100-8 4 4 0 000 8zm0 2c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z"/></svg>
                                {{ $post->user->name ?? $post->user_id }}
                            </span>
                        </td>
                        <td class="px-3 py-2">
                            @can('author', $post)    
                                <a href="{{ route('post.edit', $post) }}" class="inline-block px-2 py-1 bg-blue-400 text-white rounded hover:bg-blue-600 font-semibold shadow transition text-xs">Edit</a>
                            @else
                                <span class="text-gray-400 italic text-xs">Not Authorized</span>
                            @endcan
                        </td>
                        <td class="px-3 py-2">
                            @can('author', $post) 
                                <form class="delete-form inline" action="{{ route('user.delete.post', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block px-2 py-1 bg-red-400 text-white rounded hover:bg-red-600 font-semibold shadow transition text-xs">Delete</button>
                                </form>
                            @else
                                <span class="text-gray-400 italic text-xs">Not Authorized</span>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex justify-between items-center" style="width: 80%; margin-left: auto; margin-right: auto;">
        <div>
            {{ $posts->links('pagination::tailwind') }}
        </div>
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
</div>
