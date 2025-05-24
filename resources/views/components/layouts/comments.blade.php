<div class="comments-section mt-5">
    <h3 class="mb-4">Coments</h3>

    {{-- Mostrar comentarios existentes --}}
    @if(isset($comments) && count($comments) > 0)
        <ul class="list-group mb-4">
            @foreach($comments as $comment)
                <li class="list-group-item">
                    <strong>{{ $comment->user->name ?? 'Anónimo' }}</strong>
                    <span class="text-muted small"> - {{ $comment->created_at->diffForHumans() }}</span>
                    <p class="mb-0">{{ $comment->content }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No comments yet. Be the first to comment!</p>
    @endif

    {{-- Formulario para nuevo comentario --}}
    <form action="/" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Your comment</label>
            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
            @error('content')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Comentar</button>
    </form>
</div>