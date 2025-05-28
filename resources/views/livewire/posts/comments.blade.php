<div>
    
        {{-- Mostrar comentarios existentes con paginación --}}
        @if(isset($comments) && $comments->count() > 0)
            <ul class="space-y-4 mb-6">
                @foreach($comments as $comment)
                    <li class="p-4 border border-gray-200 rounded-lg">
                        <div class="flex items-center justify-between mb-1">
                            <strong class="text-gray-800">{{ $comment->user->name ?? 'Anónimo' }}</strong>
                            <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700">{{ $comment->body }}</p>
                    </li>
                @endforeach
            </ul>
            <div class="mb-6 cursor-pointer" wire:navigate >
                {{$comments->links() }}
            </div>
        @else
            <p class="text-gray-500 mb-6">No comments yet. be the first in comment!!</p>
        @endif

</div>