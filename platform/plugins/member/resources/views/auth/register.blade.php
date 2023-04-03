@extends('plugins/member::layouts.header')
<div class="wrap login">
  <div class="page-login">
		<a href="language.html" class="btn-lang"><i class="far fa-globe"></i></a>
		<div class="container">
			<div class="form-second">
				<form method="POST" action="{{ route('public.member.register') }}">
					@csrf
					<input type="text" value="" hidden name="invitation_code_cv">
					<div class="form-group">
						<input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" placeholder="Your username" name="username">
						@if ($errors->has('username'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('username') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
					<input type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="Your phone numbers" name="phone">
						@if ($errors->has('phone'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('phone') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Enter your Password" name="password">
						<button class="btn-eye"><i class="far fa-eye"></i></button>
						@if ($errors->has('password'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<input type="password" class="form-control{{ $errors->has('confirm_password') ? ' is-invalid' : '' }}" placeholder="Confirm Password" name="confirm_password">
						<button class="btn-eye"><i class="far fa-eye"></i></button>
						@if ($errors->has('confirm_password'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('confirm_password') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<input type="fund_password" class="form-control{{ $errors->has('fund_password') ? ' is-invalid' : '' }}" placeholder="Enter Fund poassword" name="fund_password">
						<button class="btn-eye"><i class="far fa-eye"></i></button>
						@if ($errors->has('fund_password'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('fund_password') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<input type="text" class="form-control{{ $errors->has('invitation_code') ? ' is-invalid' : '' }}" placeholder="Invitation code" name="invitation_code">
						@if ($errors->has('invitation_code'))
						<span class="invalid-feedback">
							<strong>{{ $errors->first('invitation_code') }}</strong>
						</span>
						@endif
					</div>
					<div class="form-group">
						<button class="btn-pri">Sign up</button>
					</div>
					<div class="text-center">
						{!! apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, \Botble\Member\Models\Member::class) !!}
					</div>
				</form>
			</div>
		</div>
  </div>
</div>
@push('scripts')
  <script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/scrollspy.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/scrollspy.js')}}"></script>
  <script type="text/javascript" src="{{ asset('vendor/core/core/js-validation/js/js-validation.js')}}"></script>
  {!! JsValidator::formRequest(\Botble\Member\Http\Requests\LoginRequest::class); !!}

@endpush


