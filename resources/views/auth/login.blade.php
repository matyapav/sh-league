@extends('app')

@section('content')
	<div class="text-center">
            <div class="panel">
                <div class="panel-heading orange">{{trans('messages.login')}}</div>
                <div class="body_content ">

                    @include('errors.error')

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="email" class="input-label">{{trans('messages.email')}}</label>
                                <input type="email" class="input-field" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password" class="input-label">{{trans('messages.password')}}</label>
                            <input type="password" class="input-field" name="password" required>
                        </div>

                        <br>
                        <div class="text-right">
                            <button type="submit" class="btn-common green">
                                <i class="fa fa-sign-in"></i>
                                {{trans('messages.login')}}
                            </button>
                        </div>
                    </form>
                        <br><br>
                            {{trans('messages.do-not-have-acc')}}
                            <a href="{{ url('/auth/register') }}">{{trans('messages.register')}}</a>
                </div>
            </div>
    </div>
@endsection
