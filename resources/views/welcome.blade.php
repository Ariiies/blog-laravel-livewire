<x-layouts.app>
    
<div class="min-h-screen bg-black-500 flex justify-center items-center py-12">
    <div class="w-full max-w-4xl mx-4 bg-gray-200 rounded-2xl shadow-sm border border-gray-200 p-8 md:p-10">
        <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-6 tracking-tight">Blog Posts</h1>
        <h4 class="text-lg font-medium text-center text-gray-600 mb-8">Total Posts: <span class="text-gray-800">{{ $posts->total() }}</span></h4>
        
        <ul class="space-y-6">
            @foreach ($posts as $post)
                @if ($post->is_published && $post->published_at)
                    <li class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md hover:bg-gray-100 transition-all duration-200">
                        <a href="{{ route('post.show', ['post' => $post->slug]) }}" class="block">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex items-start gap-4">
                                    @if ($post->image_path)
                                        <img src="{{ Storage::url($post->image_path) }}" alt="Post image" class="w-20 h-20 object-cover rounded-md border border-gray-300">
                                    @endif
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <strong class="text-xl md:text-2xl font-semibold text-gray-900">{{ $post->title }}</strong>
                                            <span class="text-gray-500 text-sm">by {{ $post->user->name }}</span>
                                        </div>
                                        <p class="text-gray-700 mt-2 text-base leading-relaxed">
                                            {{ Str::limit(strip_tags($post->body), 150, '...') }}
                                        </p>
                                        <span class="inline-block bg-gray-100 text-gray-700 text-xs font-medium px-3 py-1 rounded-full mt-3">
                                            Category: {{ $post->category->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-sm text-gray-500 mt-4 md:mt-0">
                                    <span>{{ $post->published_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

        @if ($posts->isEmpty())
            <p class="text-center text-gray-600 mt-8">No published posts found.</p>
        @endif

        <div class="mt-10 flex justify-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>

<!-- Custom Pagination Styles -->
<style>
    .pagination {
        @apply flex gap-2 items-center justify-center mt-6;
    }

    .pagination a,
    .pagination span {
        @apply px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200;
    }

    .pagination a {
        @apply bg-gray-100 text-gray-700 hover:bg-gray-300 hover:text-gray-900 border border-gray-200;
    }

    .pagination .current {
        @apply bg-gray-300 text-gray-900 border-gray-300;
    }

    .pagination .disabled {
        @apply bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed;
    }
</style>
</x-layouts.app>