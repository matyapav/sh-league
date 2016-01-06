@extends('app')

@section('content')
    <div class="text-center" >
        <div class="panel">
            <div class="panel-heading orange">
                    @if(!is_null($edited))
                        {{trans('messages.edit-tournament')}}
                    @else
                        {{trans('messages.new-tournament')}}
                    @endif
            </div>
            <div class="body_content ">
                @include('errors.error')

                <form id="form-id" class="form-horizontal" role="form" method="POST" action="@if(!is_null($edited)){{url('/tournaments/update/'.$edited->id)}}@else{{url('/tournaments/create')}}@endif">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name" class="input-label">
                            {{trans('messages.name')}}
                        </label>
                        <input type="text" class="input-field" id="name" name="name" value="@if(!is_null($edited)){{$edited->name}}@else{{ old('name')}}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.tour-name-hint')}} {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="min_number_of_teams" class="input-label">
                            {{trans('messages.min-teams')}}
                        </label>
                        <input type="number" class="input-field" name="min_number_of_teams" value="@if(!is_null($edited)){{$edited->min_number_of_teams}}@else{{ old('min_number_of_teams')}}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.tour-min-teams-hint')}} {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="max_number_of_teams" class="input-label">
                            {{trans('messages.max-teams')}}
                        </label>
                        <input type="number" class="input-field" name="max_number_of_teams" value="@if(!is_null($edited)){{$edited->max_number_of_teams}}@else{{old('max_number_of_teams')}}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.tour-max-teams-hint')}} {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="start_date" class="input-label">
                            {{trans('messages.start-date')}}
                        </label>
                        <input type="date" class="input-field" name="start_date" value="@if(!is_null($edited)){{date('Y-m-d',strtotime($edited->start_date))}}@else{{ old('start_date') }}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.tour-start-date-hint')}} {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="end_date" class="input-label">
                            {{trans('messages.end-date')}}
                        </label>
                        <input type="date" class="input-field" name="end_date" value="@if(!is_null($edited)){{date('Y-m-d',strtotime($edited->end_date))}}@else{{old('end_date')}}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.tour-end-date-hint')}} {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="leagueid" class="input-label">
                            {{trans('messages.league')}}
                        </label>

                        <input type="hidden" id="leagueid" value="@if(!is_null($edited) && !is_null($edited->league)){{$edited->league->id}}@else{{$leagues->first()->id}}@endif" required>
                        <select name="league_id" id="league_select" class="input-field select">
                            @foreach($leagues as $league)
                                <option value="{{$league->id}}">{{$league->name}}</option>
                            @endforeach
                        </select>
                        <script type="text/javascript">
                            selectLeague();
                        </script>
                        <sup data-tip="{{trans('messages.tour-league-hint')}} {{trans('messages.required-field')}}" required>
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="type" class="input-label">
                            {{trans('messages.type')}}
                        </label>
                        <input type="text" class="input-field" name="type" value="@if(!is_null($edited)){{$edited->type}}@else{{old('type')}}@endif" placeholder="">
                        <sup data-tip="{{trans('messages.tour-type-hint')}} {{trans('messages.optional-field')}}">
                            <i class="fa fa-question-circle"></i>
                        </sup>
                    </div>

                    <div class="form-group">
                        <label for="description" class="input-label">
                            {{trans('messages.description')}}
                        </label>
                        <input type="text" class="input-field" name="description" value="@if(!is_null($edited)){{$edited->description}}@else{{old('description')}}@endif" placeholder="">
                        <sup data-tip="{{trans('messages.tour-desc-hint')}} {{trans('messages.optional-field')}}">
                            <i class="fa fa-question-circle"></i>
                        </sup>
                    </div>
                    <br>
                    @include('common.form-controls')
                </form>
                    <br><br>
                    <a href="{{ URL::to('/tournaments')}}">
                        <button class="btn-wrap-content blue">
                            <i class="fa fa fa-arrow-circle-left"></i>
                            {{trans('messages.goto')}} {{trans('messages.tournaments')}}
                        </button>
                    </a>
            </div>
        </div>
    </div>
@endsection
