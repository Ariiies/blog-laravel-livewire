<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-xl shadow-md">
            <h1 class="text-3xl font-bold text-center text-blue-700 mb-6">Edit Post</h1>
            
            <form wire:submit.prevent="updatePost" class="space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-gray-800 font-semibold mb-2">Title</label>
                    <input type="text" id="title" wire:model="title" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Body -->
                <div>
                    <label for="body" class="block text-gray-800 font-semibold mb-2">Body</label>
                    <textarea id="body" wire:model="body" rows="10" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                    @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Excerpt -->
                <div>
                    <label for="excerpt" class="block text-gray-800 font-semibold mb-2">Excerpt</label>
                    <textarea id="excerpt" wire:model="excerpt" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                    @error('excerpt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Slug -->
                <div>
                    <label for="slug" class="block text-gray-800 font-semibold mb-2">Slug</label>
                    <input type="text" id="slug" wire:model="slug" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Image -->
                <div>
                        <label for="image_path" class="block text-gray-800 font-semibold mb-2">Image URL</label>
                        <input type="text" id="image_path" wire:model="image_path" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="https://example.com/image.jpg">
                        @error('image_path') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                
                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select id="category_id" wire:model="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <!-- Tags -->
                <div>
                        <label for="tags" class="block text-gray-800 font-semibold mb-2">Tags (comma separated)</label>
                        <input type="text" id="tags" wire:model="tags" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('tags') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                
                <!-- Published -->
                <div class="flex items-center">
                    <input type="checkbox" id="is_published" wire:model="is_published" class="mr-2 accent-blue-500">
                    <label for="is_published" class="text-gray-800 font-semibold">Published</label>
                    @error('is_published') <span class="text-red-500 text-sm ml-2">{{ $message }}</span> @enderror
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
                    Update Post
                </button>
            </form>
        </div>
    </div>
</div>