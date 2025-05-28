<div>     
    
                <form wire:submit.prevent="addPost" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md space-y-6">
                    <label class="text-2xl font-bold text-gray-800 mb-4 block">Image</label>
                    <div class="relative mb-2"
                        x-data="{ uploading: false, progress: 0 }"
                        x-on:livewire-upload-start="uploading = true"
                        x-on:livewire-upload-finish="uploading = false"
                        x-on:livewire-upload-cancel="uploading = false"
                        x-on:livewire-upload-error="uploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"
                        >

                        @if ($image)
                            <img id="prev_image" class="w-full aspect-video object-cover object-center" src="{{ $image->temporaryUrl() }}" alt="image">
                        @else
                            <img id="prev_image" class="w-full aspect-video object-cover object-center" src="https://dicesamexico.com.mx/wp-content/uploads/2021/06/no-image.jpeg" alt="image">
                        @endif
                        <div class="absolute top-3 right-3 text-gray-800">
                            <label for="image" class="bg-gray-400 hover:bg-gray-300 cursor-pointer text-white text-xs font-medium py-1.5 px-3 rounded transition focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 block">
                                Change
                                <input wire:model="image" type="file" name="image" id="image" accept="image/*" class="hidden">
                            </label>
                            @if ($image)
                                <button type="button"
                                    wire:click="$set('image', null)"
                                    class="mt-2 bg-red-400 hover:bg-gray-300 cursor-pointer text-white text-xs font-medium py-1.5 px-3 rounded transition focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
                                    Remove
                                </button>
                            @endif
                        </div>
                        <div x-show="uploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    {{--<input 
                        type="file"
                        class=" hidden w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 p-2 mb-4"
                        wire:model="image"/>  --}}
                    <div>
                        <label for="title" class="block text-gray-800 font-semibold mb-2">Title</label>
                        <input type="text" id="title" wire:model="title" oninput="string_to_slug(this.value, '#slug')" class="w-full border  border-gray-300 rounded px-3 py-2 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="body" class="block text-gray-800 font-semibold mb-2">Body</label>
                        <textarea id="body" wire:model="body" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                        @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="excerpt" class="block text-gray-800 font-semibold mb-2">Excerpt</label>
                        <textarea id="excerpt" wire:model="excerpt" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                        @error('excerpt') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="slug" class="block text-gray-800 font-semibold mb-2">Slug</label>
                        <input type="text" id="slug" wire:model="slug" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class = "hidden">
                        <label for="image_path" class="block text-gray-800 font-semibold mb-2">Image URL</label>
                        <input type="text" id="image_path" wire:model="image_path" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="https://example.com/image.jpg">
                        @error('image_path') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" id="category_id" wire:model="category_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-400 transition text-gray-700">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="tags" class="block text-gray-800 font-semibold mb-2">Tags (comma separated)</label>
                        <input type="text" id="tags" wire:model="tags" class="w-full border border-gray-300 rounded px-3 py-2 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('tags') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="is_published" wire:model="is_published" class="mr-2 accent-blue-500">
                        <label for="is_published" class="text-gray-800 font-semibold">Publish</label>
                        @error('is_published') <span class="text-red-500 text-sm ml-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition cursor-pointer">Add Post</button>
                        <a href="{{ route('home') }}" class="w-full bg-gray-400 text-white font-bold py-2 px-4 rounded hover:bg-gray-500 transition text-center">Cancelar</a>
                    </div>
                </form>
                @include('components.layouts.loading')
</div>


  