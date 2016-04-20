@extends('layouts.app')

@section('content')
<div><a href="{{ $news->lien }}">{{ $news->titre }}</a></div>
{{$news->user->name}} | <i class="empty star icon"></i> {{ $news->likes->sum('val') }} 
@if($news->voted)
    <form class="inlineForm" action="{{ url('delLinkVote/'.$news->id) }}" method="POST">
        {!! csrf_field() !!}
        @if($news->voted == 1)
            <button class="ui basic mini compact green button"><i class="checkmark icon"></i></button>
        @else
            <button class="ui basic mini compact red button"><i class="remove icon"></i></button>
        @endif
    </form>
@else
    <form class="inlineForm" action="{{ url('upLink/'.$news->id) }}" method="POST">
        {!! csrf_field() !!}
        <button class="ui basic mini compact button">+</button>
    </form>
    <form class="inlineForm" action="{{ url('downLink/'.$news->id) }}" method="POST">
        {!! csrf_field() !!}
        <button class="ui basic mini compact button">-</button>
    </form>
@endif
<div class="ui threaded comments">
    @if (Auth::check())
        <form class="ui reply form" action="{{ url('comment') }}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="news" value="{{ $news->id }}">
            <input type="hidden" name="comment_id" value="">
            <div class="field">
              <textarea name="comment"></textarea>
            </div>
            <button class="ui primary submit labeled icon button"><i class="icon edit"></i> Commenter </button>
        </form>
    @endif
    @if (count($comments) > 0)
        <h5 class="ui dividing header">Commentaires</h5>
        @each('news.commentsview', $comments, 'comment')
    @endif
</div>
@endsection