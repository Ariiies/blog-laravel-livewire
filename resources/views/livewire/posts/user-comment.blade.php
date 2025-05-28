<div>
    @if (is_null($user))
        <div class="text-center space-y-4">
            <p class="text-gray-700">Please log in and leave a comment.</p>
            <a href="{{ route('login') }}"
               class="inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
            Log in
            </a>
            <p class="text-gray-700">Don't have an account yet? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>.</p>
        </div>
    @else
        <form action="/" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">
                    <strong>{{ $userFirstName }}</strong> leave a comment
                </label>
                <textarea id="content" name="content" rows="3" required wire:model="body"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800"></textarea>
                @error('content')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>
            <x-button wire:click="addComment"
                class="cursor-pointer ">
                Comment
            </x-button>
        </form>
    @endif
</div>
