@extends('app')

@section('content')
    <div class="text-center">
        <div class="panel">
            <div class="panel-heading orange">{{trans('messages.home')}}</div>
            <div class="body_content ">
                @include('errors.error')
                <hr>
                <h1>{{trans('messages.project-desc-head')}}</h1>
                    {{trans('messages.project-desc-text')}}
                <hr>
            </div>
        </div>
    </div>
@endsection
