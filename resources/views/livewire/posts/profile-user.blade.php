<div>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8 mt-10">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center text-2xl font-bold text-gray-500">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">User: {{ auth()->user()->name }}</h1>
                <p class="text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>
        <div class="mb-4">
            <p class="text-gray-700"><strong>Register Date:</strong> {{ auth()->user()->created_at->format('d/m/Y') }}</p>
            <p class="text-gray-700"><strong>Number of Post's:</strong> {{ auth()->user()->posts()->count() }}</p>
        </div>
        <div class="flex space-x-2 mb-6">
            <!-- Edit Profile Modal Trigger -->
            <flux:modal.trigger name="edit-profile">
                    <flux:button class="cursor-pointer mr-2">Edit profile</flux:button>
            </flux:modal.trigger>
        
            <flux:button  href="{{ route('post.create') }}" livewire:navigate>
                 + Add Post
            </flux:button>

            <flux:button href="{{ route('user.posts', ['user_id' => auth()->user()->id]) }}" class="bg-gray-200 text-gray-800 hover:bg-gray-300 transition" livewire:navigate>
                See All My Posts
            </flux:button>
      
            <flux:modal.trigger name="show-posts">
                <flux:button class="cursor-pointer" >See + Posts</flux:button>
            </flux:modal.trigger>

        </div>
        <h2 class="text-xl font-semibold text-gray-700 mt-6 mb-2">Latest Posts</h2>
        <ul class="divide-y divide-gray-200">
            @foreach(auth()->user()->posts()->latest()->take(5)->get() as $post)
                <li class="py-3 flex justify-between items-center" livewire:key="user-post-{{ $post->id }}">
                    <a href="{{ route('post.show', $post) }}" class="text-blue-600 hover:underline font-medium">{{ $post->title }}</a>
                    <span class="text-sm text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Incluir los modales -->
    @include('components.modals.edit-profile-modal')
    @include('components.modals.show-my-posts')
</div>
