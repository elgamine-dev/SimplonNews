@extends('layouts.app')

@section('content')

<div class="mid-content" style="position: relative; top: 25%;">
    <!-- /* ne pas oublié d'enlever le style dans la balise*/ -->
    <div class="ui middle aligned center aligned grid">
        <div class="four wide column">
            <h2 class="ui teal image header">Inscription</h2>
            <form class="ui large form" role="form" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <div class="ui stacked segment">
                    @if ($errors->has('email'))
                    <div class="ui negative message">
                        <div class="header">{{ $errors->first('email') }}</div>
                    </div>
                    @endif
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input type="text" name="email" placeholder="E-mail address">
                        </div>
                    </div>
                    @if ($errors->has('password'))
                    <div class="ui negative message">
                        <div class="header">{{ $errors->first('password') }}</div>
                    </div>
                    @endif
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input type="text" name="email" placeholder="Password">
                        </div>
                    </div>
                    @if ($errors->has('password'))
                    <div class="ui negative message">
                        <div class="header">{{ $errors->first('password') }}</div>
                    </div>
                    @endif
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="text" name="email" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <br>
                    <button class="ui fluid large inverted pink submit button">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
