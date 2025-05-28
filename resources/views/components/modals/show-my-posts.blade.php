<!-- Show Posts Modal -->
<flux:modal name="show-posts" class="md:w-[52rem]">
    <div class="relative bg-black-500 rounded-lg shadow-inner p-6">
       
            
        </button>
        <div class="max-h-[40rem] overflow-y-auto pr-2">
            <h3 class="text-lg font-semibold text-gray-100 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h6a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                </svg>
                All My Posts
            </h3>
            <ul class="divide-y divide-gray-700">
                @forelse(auth()->user()->posts()->latest()->get() as $post)
                    <li class="py-3 flex justify-between items-center hover:bg-gray-700 px-2 rounded transition" livewire:key="modal-user-post-{{ $post->id }}">
                        <div class="flex items-center gap-2 min-w-0 flex-1">
                            <a href="{{ route('post.show', $post) }}" class="text-blue-300 hover:underline font-medium truncate max-w-xs" target="_blank">
                                {{ $post->title }}
                            </a>
                            <span class="text-xs text-gray-400 ml-4 whitespace-nowrap">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex gap-2 ml-4">
                            <a href="{{ route('post.edit', $post) }}" class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-900 bg-yellow-400 hover:bg-yellow-500 rounded">
                                Edit
                            </a>
                            <form action="{{ route('user.delete.post', $post) }}" method="POST" class="delete-form" >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-2 py-1 text-xs font-medium text-white bg-red-500 hover:bg-red-600 rounded" title="Delete">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="py-4 text-center text-gray-500">No posts found.</li>
                @endforelse
            </ul>
            <!-- Second close button at the bottom -->
            
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
</flux:modal>

