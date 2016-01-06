@extends('app')

@section('content')
    <div class="text-center" >
        <div class="panel">
            <div class="panel-heading orange">
                @if(!is_null($edited))
                    {{trans('messages.edit-league')}}
                @else
                    {{trans('messages.new-league')}}
                @endif
            </div>
            <div class="body_content ">
                @include('errors.error')

                <form id="form-id" class="form-horizontal" role="form" method="POST" action="@if(!is_null($edited)){{url('/leagues/update/'.$edited->id)}}@else{{ url('/leagues/create') }}@endif">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name" class="input-label">
                            {{trans('messages.name')}}
                        </label>
                        <input type="text" class="input-field" id="name" name="name" value="@if(!is_null($edited)){{$edited->name}}@else{{ old('name') }}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.league-name-hint')}} - {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="type" class="input-label">
                            {{trans('messages.abbreviation')}}
                        </label>
                        <input type="text" class="input-field" name="abbreviation" value="@if(!is_null($edited)){{$edited->abbreviation}}@else{{ old('abbreviation') }}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.league-abbrev-hint')}} - {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="description" class="input-label">
                            {{trans('messages.description')}}
                        </label>
                        <input type="text" class="input-field" name="description" value="@if(!is_null($edited)){{$edited->description}}@else{{ old('description')}}@endif" placeholder="">
                        <sup data-tip="{{trans('messages.league-desc-hint')}} - {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="gameid" class="input-label">
                            {{trans('messages.game')}}
                        </label>

                        <input type="hidden" id="gameid" value="@if(!is_null($edited) && !is_null($edited->game)){{$edited->game->id}}@else{{$games->first()->id}}@endif" required>
                        <select name="game_id" id="game_select" class="input-field select">
                            @foreach($games as $game)
                                <option value="{{$game->id}}">{{$game->name}}</option>
                            @endforeach
                        </select>
                        <script type="text/javascript">
                            selectGame();
                        </script>
                        <sup data-tip="{{trans('messages.league-game-hint')}} - {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>
                    <br>
                   @include('common.form-controls')
                </form>
                <br><br>
                    <a href="{{ URL::to('/leagues')}}">
                        <button class="btn-wrap-content blue">
                            <i class="fa fa fa-arrow-circle-left"></i>
                            {{trans('messages.goto')}} {{trans('messages.leagues')}}
                        </button>
                    </a>
            </div>
        </div>
    </div>
@endsection
