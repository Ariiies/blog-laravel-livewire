<x-layouts.admin>
    <!-- breadcrumbs -->
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}" icon="table-cells"/>
        <flux:breadcrumbs.item href="{{ route('posts.index') }}">Posts</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-4xl mx-auto">
        <!-- Header with title and meta -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-3">{{ $post->title }}</h1>
            
            <div class="flex items-center">
                <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}" 
                     alt="Author Avatar" 
                     class="w-10 h-10 rounded-full object-cover ring-2 ring-white shadow-sm">
                <div class="ml-3">
                    <p class="text-gray-800 font-medium">{{ $post->user->name }}</p>
                    <p class="text-gray-500 text-sm">{{ $post->created_at->format('d M Y \a\t H:i') }}</p>
                    <p class="text-gray-500 text-sm">{{ $post->category->name}}</p>
                </div>
            </div>
        </div>
        
        <!-- Content -->
        <div class="prose prose-lg max-w-none text-gray-700 mb-8">
            {!! nl2br(e($post->body)) !!}
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-100">
            <a href="{{ route('posts.edit', $post) }}" 
               class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors font-medium">
                Edit
            </a>
            <form class="delete-form" action="{{ route('posts.destroy', $post) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-5 py-2.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors font-medium">
                    Delete
                </button>
            </form>
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
</x-layouts.admin>