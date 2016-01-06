@extends('app')

@section('content')
    <div class="text-center" >
        <div class="panel">
            <div class="panel-heading orange">
                    @if(!is_null($edited))
                        {{trans('messages.edit-team')}}
                    @else
                        {{trans('messages.new-team')}}
                    @endif
            </div>
            <div class="body_content ">
                @include('errors.error')

                <form id="form-id" class="form-horizontal" role="form" method="POST" action="@if(!is_null($edited)){{url('/teams/update/'.$edited->id)}}@else{{url('/teams/create')}}@endif">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name" class="input-label">
                            {{trans('messages.name')}}
                        </label>
                        <input type="text" class="input-field" id="name" name="name" value="@if(!is_null($edited)){{$edited->name}}@else{{ old('name')}}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.team-name-hint')}} {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>


                    <div class="form-group">
                        <label for="type" class="input-label">
                            {{trans('messages.abbreviation')}}
                        </label>
                        <input type="text" class="input-field" name="abbreviation" value="@if(!is_null($edited)){{$edited->abbreviation}}@else{{ old('abbreviation') }}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.team-abbrev-hint')}} - {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>


                    <div class="form-group">
                        <label for="description" class="input-label">
                            {{trans('messages.description')}}
                        </label>
                        <input type="text" class="input-field" name="description" value="@if(!is_null($edited)){{$edited->description}}@else{{old('description')}}@endif" placeholder="" required>
                        <sup data-tip="{{trans('messages.team-desc-hint')}} {{trans('messages.required-field')}}">
                            <i class="fa fa-asterisk"></i>
                        </sup>
                    </div>
                    <br>
                    @include('common.form-controls')
                </form>
                    <br><br>
                    <a href="{{ URL::to('/teams')}}">
                        <button class="btn-wrap-content blue">
                            <i class="fa fa fa-arrow-circle-left"></i>
                            {{trans('messages.goto')}} {{trans('messages.teams')}}
                        </button>
                    </a>
            </div>
        </div>
    </div>
@endsection
