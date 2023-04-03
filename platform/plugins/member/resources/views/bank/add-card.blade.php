@extends('plugins/member::layouts.header')
    <div class="wrap">
        <div class="ptt"></div>
        <div class="direct-page">
            <h2 class="title">My Payment Card</h2>
            <a href="/profile" class="btn-back" title=""><i class="far fa-angle-left"></i></a>
        </div>
        <div class="container">
            <div class="form-second">
                <form method="POST" action="{{ route('member.card_add') }}">
                    @csrf
                    <h3 class="head">Personal Information</h3>
                    <input type="text" hidden name="user_id" value="{{ auth('member')->user()->id }}">
                    <div class="form-group">
                        <label>Bank List</label>
                        <!-- <select name="bank_name" id="" class="form-control">
                            <option value="Agribank" {{ $user->bank_number ? 'selected' : '' }}>Agribank</option>
                            <option value="Vietcombank">Vietcombank</option>
                        </select> -->
                        <select name="bank_name" id="" class="form-control">
                            @foreach ($dataBankName as $value)
                                <option value="{{ $value['name'] }}" {{ $value['name'] == $user->bank_name ? 'selected' : ''}}>
                                    {{ $value['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Account number</label>
                        <input type="text" class="form-control{{ $errors->has('bank_number') ? ' is-invalid' : '' }}" value="{{ $user->bank_number }}" placeholder="" name="bank_number">
                        @if ($errors->has('bank_number'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('bank_number') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Account name</label>
                        <input type="text" class="form-control{{ $errors->has('account_holder') ? ' is-invalid' : '' }}" value="{{ $user->account_holder }}" placeholder="" name="account_holder">
                        @if ($errors->has('account_holder'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('account_holder') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn-pri" type="submit">Information setting</button>
                    </div>
                    <div class="form-group">
                        <p>Dear user, to protect your money, please do not enter your bank card password, our staff will not ask you to enter your bank card password</p>
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
@endpush