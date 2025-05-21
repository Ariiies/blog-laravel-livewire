<x-layouts.admin>
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md border border-gray-200">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Post</h1>
    
    <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400" 
                   placeholder="Enter post title" required
                   value="{{ old('title', $post->title) }}">
        </div>
        
        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" id="slug" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400" 
                   placeholder="post-url-slug" required
                   value="{{ old('slug', $post->slug) }}">
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category_id" id="category_id" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700">
                <?php
                    $categories = \App\Models\Category::all();
                ?>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
            <textarea name="excerpt" id="excerpt" rows="3" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400" 
                      placeholder="Brief description..." required>{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>
        
        <div>
            <label for="body" class="block text-sm font-medium text-gray-700 mb-1">Body</label>
            <textarea name="body" id="content" rows="6" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400" 
                      placeholder="Write your content here..." required>{{ old('body', $post->body) }}</textarea>
        </div>
        
        <div>
            <label for="image_path" class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
            <input type="text" name="image_path" id="image_path" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400" 
                   placeholder="https://example.com/image.jpg"
                   value="{{ old('image', $post->image_path) }}">
        </div>

        <div>
            <label for="is_published" class="block text-sm font-medium text-gray-700 mb-1">Visibility</label>
            <select name="is_published" id="is_published"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700">
                <option value="1" {{ old('is_published', $post->is_published) == 1 ? 'selected' : '' }}>Publish</option>
                <option value="0" {{ old('is_published', $post->is_published) == 0 ? 'selected' : '' }}>Private</option>
            </select>
        </div>

        <div class="my-4">
            <br>
        </div>
        <div class="pt-2">
            <div class="flex justify-end space-x-3">
                <a href="{{ route('posts.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
                    Cancelar
                </a>
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition focus:ring-2 focus:ring-blue-300 focus:ring-offset-2">
                    Update Post
                </button>
            </div>
        </div>
    </form>
</div>

</x-layouts.admin>