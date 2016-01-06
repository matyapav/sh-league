@extends('app')

@section('content')
	<div class="text-center">
			<div class="panel">
				<div class="panel-heading orange">{{trans('messages.registration')}}</div>
				<div class="body_content ">
					@include('errors.error')
					<form id="form-id" class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label for="nickname" class="input-label">
								{{trans('messages.nickname')}}
							</label>
							<input type="text" class="input-field" id="nickname" name="nickname" value="{{old('nickname')}}" onblur="checkUserNicknameAvailability()" required>
							<sup data-tip="{{trans('messages.user-nickname-hint')}} {{trans('messages.required-field')}}">
								<i class="fa fa-asterisk"></i>
							</sup>

							<!-- CHECKING AVAILABILITY -->
							<span id="loading-icon-user"><i class="fa fa-spinner fa-spin"></i></span>
							<span id="user-availability-status"></span>
						</div>

						<div class="form-group">
							<label for="email" class="input-label">
								{{trans('messages.email')}}
							</label>
							<input type="email" class="input-field" name="email" id="email" value="{{old('email')}}" onblur="checkUserEmailAvailability()" required>
							<sup data-tip="{{trans('messages.user-email-hint')}} {{trans('messages.required-field')}}">
								<i class="fa fa-asterisk"></i>
							</sup>

							<!-- CHECKING AVAILABILITY -->
							<span id="loading-icon-mail"><i class="fa fa-spinner fa-spin"></i></span>
							<span id="email-availability-status"></span>
						</div>

						<div class="form-group">
							<label for="password" class="input-label">
								{{trans('messages.password')}}
							</label>
							<input type="password" class="input-field" name="password" placeholder="" required>
							<sup data-tip="{{trans('messages.user-psswd-hint')}} {{trans('messages.required-field')}}">
								<i class="fa fa-asterisk"></i>
							</sup>
						</div>

						<div class="form-group">
							<label for="password_confirmation" class="input-label">
								{{trans('messages.password2')}}
							</label>
							<input type="password" class="input-field" name="password_confirmation" placeholder="" required>
							<sup data-tip="{{trans('messages.user-psswd2-hint')}} {{trans('messages.required-field')}}">
								<i class="fa fa-asterisk"></i>
							</sup>
						</div>
						<div class="form-group">
							<label for="name" class="input-label">
								{{trans('messages.name')}}
							</label>
							<input type="text" class="input-field" name="name" value="{{old('name')}}">
							<sup data-tip="{{trans('messages.user-name-hint')}} {{trans('messages.optional-field')}}">
								<i class="fa fa-question-circle"></i>
							</sup>
						</div>

						<div class="form-group">
							<label for="city" class="input-label">
								{{trans('messages.city')}}
							</label>
							<input type="text" class="input-field" name="city" value="{{old('city')}}">
							<sup data-tip="{{trans('messages.user-city-hint')}} {{trans('messages.optional-field')}}">
								<i class="fa fa-question-circle"></i>
							</sup>
						</div>

						<div class="form-group">
							<label for="state" class="input-label">
								{{trans('messages.state')}}
							</label>
							<input type="text" class="input-field" name="state" value="{{old('state')}}">
							<sup data-tip="{{trans('messages.user-state-hint')}} {{trans('messages.optional-field')}}">
								<i class="fa fa-question-circle"></i>
							</sup>
						</div>

						<div class="form-group">
							<label for="birthdate" class="input-label">
								{{trans('messages.birthdate')}}
							</label>
							<input type="date" class="input-field date" name="birthdate" value="{{old('birthdate')}}" placeholder="mm.dd.rrrr">
							<sup data-tip="{{trans('messages.user-birthdate-hint')}} {{trans('messages.optional-field')}}">
								<i class="fa fa-question-circle"></i>
							</sup>
						</div>

						<div class="form-group">
							<label for="info" class="input-label">
								{{trans('messages.description')}}
							</label>
							<input type="text" class="input-field" name="info" value="{{old('info')}}">
							<sup data-tip="{{trans('messages.user-desc-hint')}} {{trans('messages.optional-field')}}">
								<i class="fa fa-question-circle"></i>
							</sup>
						</div>

						<div id="targetLayer">No Image</div>
						<div id="uploadFormLayer" class="text-vert-center">

							<div>
								<label for="avatar" class="input-label">
									<span class="text-left">{{trans('messages.avatar')}}</span>
								</label><br>
								<input type="file" id="avatar" name="avatar" value="{{old('avatar')}}" onchange="uploadImage(this.files)">
							</div>
							<sup data-tip="{{trans('messages.user-avatar-hint')}} {{trans('messages.optional-field')}}">
								<i class="fa fa-question-circle"></i>

							</sup>
						</div>
						@include('common.form-controls')
					</form>
						<br><br>
						<a href="{{ URL::to('/')}}">
							<button class="btn-wrap-content blue">
								<i class="fa fa fa-arrow-circle-left"></i>
								{{trans('messages.goto')}} {{trans('messages.home')}}
							</button>
						</a>
				</div>

			</div>
		</div>

	<script>
		hideLoadingIcons();
	</script>
@endsection
