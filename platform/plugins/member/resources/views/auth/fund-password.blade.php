@extends('plugins/member::layouts.header')
<div class="wrap">
    <div class="ptt"></div>
    <div class="direct-page">
        <h2 class="title">Manage Fund Password</h2>
        <a href="/profile" class="btn-back" title=""><i class="far fa-angle-left"></i></a>
    </div>
    <div class="container">
        <div class="form-second">
            <form method="POST" action="{{ route('public.member.fund_password') }}">
                @csrf
                <div class="form-group">
                    <input type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" placeholder="Old Password" name="old_password">
                    <button class="btn-eye"><i class="far fa-eye"></i></button>
                    @if ($errors->has('old_password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('old_password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" placeholder="New Password" name="new_password">
                    <button class="btn-eye"><i class="far fa-eye"></i></button>
                    @if ($errors->has('new_password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('new_password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" class="form-control{{ $errors->has('confirm_new_password') ? ' is-invalid' : '' }}" placeholder="Confirm New Password" name="confirm_new_password">
                    <button class="btn-eye"><i class="far fa-eye"></i></button>
                    @if ($errors->has('confirm_new_password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('confirm_new_password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn-pri">Confirm to change</button>
                </div>
                <div class="form-group">
                    <p>Please remember your fund password, and contact customer service if you forget</p>
                </div>
            </form>
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