
<div class="comment">
    <a class="avatar"><img src="{{$comment->user->avatar?$comment->user->avatar:'http://lorempixel.com/600/600/cats'}}" /></a>
    <div class="content">
        <a href="{{ URL::route('user.profile', [$comment->user->id]) }}" class="author">{{$comment->user->name}}</a>
        <div class="metadata">
            <span class="date">{{ $comment->created_at->format('d/m/y à H:i') }}</span>
        </div>
        <div class="text">    
            {{ $comment->content }}
        </div>
        <div class="actions">
            {{ $comment->likes->sum('val') }}
            @if($comment->voted)
                <form class="inlineForm" action="{{ URL::route('comment.vote.del', [$comment->id]) }}" method="POST">
                    {!! csrf_field() !!}
                    @if($comment->voted == 1)
                        <button class="ui basic mini compact green button"><i class="checkmark icon"></i></button>
                    @else
                        <button class="ui basic mini compact red button"><i class="remove icon"></i></button>
                    @endif
                </form>
            @else
                <form class="inlineForm" action="{{ URL::route('comment.vote.up', [$comment->id]) }}" method="POST">
                    {!! csrf_field() !!}
                    <button class="ui basic mini compact button">+</button>
                </form>
                <form class="inlineForm" action="{{ URL::route('comment.vote.down', [$comment->id]) }}" method="POST">
                    {!! csrf_field() !!}
                    <button class="ui basic mini compact button">-</button>
                </form>
            @endif
            @if(Auth::check())
                <a class="commentAction reply active" act=".replyAct">Répondre</a>
                @if (Auth::user()->id == $comment->user_id || Auth::user()->hasRole('admin'))
                    <a class="commentAction reply active" act=".editAct">Editer</a>
                @endif
                @if (Auth::user()->hasRole('admin'))
                    <a class="commentAction reply active" act=".delAct">Supprimer</a>
                @endif
            @endif
        </div>   
        <form action="{{ URL::route('comment.edit', [$comment->id]) }}" method="POST" class="ui reply editAct form hidden">
            {!! csrf_field() !!}
            {!! method_field('PUT') !!}
            <div class="field">
                <textarea name="comment">{{ $comment->content }}</textarea>
            </div>
            <button type="submit" class="ui yellow submit labeled icon button comment-btn"><i class="icon edit"></i>Editer</button>
        </form>
        <form action="{{ URL::route('comment.store') }}" method="POST" class="ui reply replyAct form hidden">
            {!! csrf_field() !!}
            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
            <input type="hidden" name="news" value="{{$comment->lien_id}}">
            <div class="field">
                <textarea name="comment"></textarea>
            </div>
            <button type="submit" class="ui primary submit labeled icon button comment-btn"><i class="icon send"></i>Poster</button>
        </form>
        <form action="{{ URL::route('comment.del', [$comment->id]) }}" method="POST" class="ui reply delAct form hidden">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" class="ui red submit labeled icon button comment-btn"><i class="icon ban"></i>Supprimer</button>
        </form>
    </div>
    @if (count($comment->children) > 0)
        <div class="comments">
            @each('news.commentsview', $comment->children, 'comment')
        </div>
    @endif
</div>
<!--Bouton d'édition affiché seulement si l'utilisateur a les droits pour -->