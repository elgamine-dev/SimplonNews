@extends('layouts.app')

@section('content')
    @if (count($news) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Liste des News
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>News</th>
                        <th>&nbsp;</th>
                    </thead>

                    <tbody>
                        @foreach ($news as $new)
                            <tr>
                                
                                <td class="table-text">
                                    <a href="{{ $new->lien }}">{{ $new->titre }}</a>
                                </td>
                                <td class="table-text">
                                    <div>{{$new->user->name}}</div>
                                </td>
                                <td>
                                    <form action="{{ url('poster/'.$new->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}

                                        <button>X</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="panel-body">
        @include('common.errors')
        <form action="{{ url('poster') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="news-titre" class="col-sm-3 control-label">Titre</label>
                <div class="col-sm-6">
                    <input type="text" name="titre" id="news-titre" class="form-control" aria-describedby="http">
                </div>
            </div>
            <div class="form-group">
                <label for="news-lien" class="col-sm-3 control-label">Lien</label>
                <div class="col-sm-6 input-group">
                    <span class="input-group-addon" id="http">http://</span>
                    <input type="text" name="lien" id="news-lien" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Ajouter une news
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection