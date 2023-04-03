@extends('plugins/member::layouts.header')
<div class="wrap login">
  <div class="page-login">
    <a href="language.html" class="btn-lang"><i class="far fa-globe"></i></a>
    <div class="container">
      <div class="form-second">
        <form method="POST" action="{{ route('public.member.login') }}">
          @csrf
          <div class="form-group">
            <input type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="Please enter your username or mobile number" name="phone">
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
            <button class="btn-pri" type="submit">Login</button>
          </div>
          <div class="text-center">
            {!! apply_filters(BASE_FILTER_AFTER_LOGIN_OR_REGISTER_FORM, null, \Botble\Member\Models\Member::class) !!}
          </div>
        </form>
        <div class="form-group">
          <button class="btn-pri v2"><a href="/register" title="" class="item">Sign up</a></button>
        </div>
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

