<div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 max-w-4xl mx-auto mt-8">
        <!-- Go Back Button -->
        <div class="flex justify-end">
            <a href="/" class="inline-flex items-center px-4 py-2 mb-6 text-sm font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Go Back
            </a>
        </div>

        <!-- Post Title and Meta -->
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

        <!-- Post Image -->
        @if($post->image_path)
            <div class="mb-6">
                <img 
                    src="{{ Storage::url($post->image_path) }}" 
                    alt="Post Image" 
                    class="rounded-lg w-full max-h-80 object-cover shadow"
                />
            </div>
        @endif
        
        <!-- Post Body -->
        <div class="prose prose-lg max-w-none text-gray-700 mb-8">
            {!! $post->body !!}
        </div>
        @if($post->tags && $post->tags->count())
            <div id="tags" class="mb-6">
            <h4 class="text-sm font-semibold text-gray-700 mb-2">Tags:</h4>
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                <span class="inline-block bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                    {{ $tag->name }}
                </span>
                @endforeach
            </div>
            </div>
        @endif
        <!-- Authenticated User Post Actions -->
        @can('author', $post)
        <div class="flex items-center justify-end pt-6 border-t border-gray-100">
            <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="p-2 rounded-full hover:bg-gray-100 transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="12" cy="6" r="1.5"/>
                <circle cx="12" cy="12" r="1.5"/>
                <circle cx="12" cy="18" r="1.5"/>
                </svg>
            </button>
            <div 
                x-show="open" 
                @click.away="open = false" 
                x-transition 
                class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-10"
            >
                <a 
                    href="{{ route('post.edit', $post) }}" 
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-t-lg transition-colors"
                >
                    Edit: {{$post->slug}}
                </a>
                <form class="delete-form" method="POST" >
                @csrf
                @method('DELETE')
                <button type="submit" wire:click.prevent="deletePost({{ $post->id }})" {{-- tal vez seria recomendable usar un controlador tradicional --}}
                    class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded-b-lg transition-colors">
                    Delete
                </button>
                </form>
            </div>
            </div>
        </div>
        @endcan
    </div>
    <!-- related post section -->
    <div id="related-posts" name="related-posts" class="max-w-4xl mx-auto mt-10 mb-10">
        <h3 class="text-lg font-semibold text-gray-200 mb-4">Related Posts</h3>
        @if(isset($relatedposts) && count($relatedposts) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-{{ min(4, count($relatedposts)) }} gap-6">
                @foreach($relatedposts as $related)
                    <a href="{{ route('post.show', $related) }}" class="block bg-white border border-gray-200 rounded-lg shadow hover:shadow-md transition overflow-hidden">
                        @if($related->image_path)
                            <img src="{{ Storage::url($related->image_path) }}" alt="{{ $related->title }}" class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400 text-4xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a4 4 0 004 4h10a4 4 0 004-4V7a4 4 0 00-4-4H7a4 4 0 00-4 4z" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-4">
                            <h4 class="font-semibold text-gray-900 text-base mb-1 truncate">{{ $related->title }}</h4>
                            <p class="text-gray-600 text-sm mb-2 truncate">{{ Str::limit(strip_tags($related->body), 60) }}</p>
                            <div class="flex items-center text-xs text-gray-500">
                                <span>{{ $related->user->name ?? 'Unknown' }}</span>
                                <span class="mx-2">·</span>
                                <span>{{ $related->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center text-gray-500">
                No similar posts found.<br>
                <a href="{{ url('/') }}" class="inline-block mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Keep exploring
                </a>
            </div>
        @endif
    </div>
    <!-- COMMENTS SECTION -->
    <div class="max-w-4xl mx-auto mt-12 mb-16 bg-white rounded-xl shadow-sm border border-gray-100 p-6 pb-12">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Comments</h3>
        
        {{-- Mostrar comentarios existentes --}}
        @livewire('posts.comments', ['post' => $post])

        {{-- Formulario para nuevo comentario --}}
        @livewire('posts.user-comment', ['post' => $post, 'user' => auth()->user()])

        
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