<x-layouts.admin>

    @push('css')
        <!-- Include stylesheet -->
        <!-- quilljs -->
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
        <!-- selec2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush

    <!-- breadcrumbs -->
    <flux:breadcrumbs class="mb-6">
        <flux:breadcrumbs.item href="{{ route('admin.dashboard') }}" icon="table-cells"/>
        <flux:breadcrumbs.item href="{{ route('posts.index') }}">Posts</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>New</flux:breadcrumbs.item>
    </flux:breadcrumbs>

<div class="max-w-4xl mx-auto mt-10 bg-white p-10 rounded-lg shadow-md border border-gray-200 w-full">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Create New Post</h1>
    
    <form action="{{ route('posts.store') }}" method="POST" class="space-y-5">
        @csrf

        <div class="relative mb-2">
            <img id="prev_image" class="w-full aspect-video object-cover object-center" src="https://dicesamexico.com.mx/wp-content/uploads/2021/06/no-image.jpeg" alt="image">
            <div class="absolute top-3 right-3 text-gray-800">
            <label for="image" class="bg-gray-400 hover:bg-gray-300 cursor-pointer text-white text-xs font-medium py-1.5 px-3 rounded transition focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 block">
                Change
                <input onchange="preview_image(event, '#prev_image')" type="file" name="image" id="image" accept="image/*" class="hidden">
            </label>

            <div class="mt-2">
                <label for="" onclick="remove_preview(event, '#prev_image')" id="btn-quit" class="hidden  bg-red-400 hover:bg-gray-300 cursor-pointer text-white text-xs font-medium py-1.5 px-3 rounded transition focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 block">
                    Quitar
                </label>
            </div>
            
            </div>
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" oninput="string_to_slug(this.value, '#slug')"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400" 
                   placeholder="Enter post title" required>
        </div>
        
        <div>
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
            <input type="text" name="slug" id="slug" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400" 
                   placeholder="post-url-slug" required>
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
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
            <textarea name="excerpt" id="excerpt" rows="3" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400" 
                      placeholder="Brief description..." required></textarea>
        </div>
        
        <div>
                <p class="text-black font-medium text-sm mb-1">Body</p>
                <div id="editor" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400"
                    style="min-height: 350px; height: 350px;">
                    
                </div>
            </div>

            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                <select
                    id="tags"
                    name="tags[]"
                    multiple="multiple"
                    class="w-full" >
                    <option value="1">Tag 1</option>
                    <option value="2">Tag 2</option>
                    <option value="3">Tag 3</option>
                    <option value="4">Tag 4</option>
                    <option value="5">Tag 5</option>
                    <option value="6">Tag 6</option>
                </select>
            </div>

        <div>
                <textarea id="body" name="body" id="content" rows="6" 
                        class="hidden" 
                        required></textarea>
        </div> 
        
        <div>
            <label for="image_path" class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
            <input type="text" name="image_path" id="image_path" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700 placeholder-gray-400" 
                   placeholder="https://example.com/image.jpg">
        </div>

        <div>
            <label for="is_published" class="block text-sm font-medium text-gray-700 mb-1">Visibility</label>
            <select name="is_published" id="is_published"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700">
                <option value="1">Publish</option>
                <option value="0">Private</option>
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
                    Create Post
                </button>
            </div>
        </div>
    </form>
</div>
    @push('js')
        <!-- Include the Quill library -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <!-- jquery para selec2 -->
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

        <!-- selec2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            document.addEventListener('livewire:navigated', function () {
                    $('#tags').select2({
                        tags: true,
                        tokenSeparators: [','],
                        placeholder: "Selecciona tags",
                        allowClear: true,
                        width: '100%',
                        
                    });
                });
                        
        
        </script>


        <!-- Initialize Quill editor -->
        <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
            });

            quill.on('text-change', function() {
                document.querySelector('#body').value = quill.root.innerHTML;
            });
        </script>
    @endpush
</x-layouts.admin>
