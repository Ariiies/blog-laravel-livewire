<div class="min-h-screen bg-black-500 flex justify-center items-center py-12">
    <div class="w-full max-w-4xl mx-4 bg-gray-200 rounded-2xl shadow-sm border border-gray-200 p-8 md:p-10">
        <h1 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-6 tracking-tight">Blog Posts</h1>
        <h4 class="text-lg font-medium text-center text-gray-600 mb-8">Total Posts: <span class="text-gray-800">{{ $posts->total() }}</span></h4>
        
        <ul class="space-y-6">
            @foreach ($posts as $post)
                @if ($post->is_published && $post->published_at)
                    <li class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hover:shadow-md hover:bg-gray-100 transition-all duration-200"
                    wire:key="post-{{ $post->id }}">
                        <a href="{{ route('post.show', $post->slug) }}" class="block" wire:navigate>
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
                                            {!! Str::limit(strip_tags($post->excerpt ), 150, '...') !!}
                                        </p>
                                        <div class="flex items-center gap-2 mt-3 flex-wrap">
                                            <span class="inline-block bg-gray-100 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">
                                                Category: {{ $post->category->name }}
                                            </span>
                                            @if ($post->tags && $post->tags->count())
                                                @foreach ($post->tags as $tag)
                                                    <span class="inline-block bg-blue-100 text-blue-700 text-xs font-medium px-3 py-1 rounded-full">
                                                        #{{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
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

            <div class="mt-10 flex justify-center cursor-pointer">
                {{ $posts->links() }}
            </div>
        
    </div>
</div>