@extends('plugins/member::layouts.header')
<div class="wrap">
    <div class="ptt"></div>
    <div class="direct-page">
        <h2 class="title">Withdraw</h2>
        <a href="/profile" class="btn-back" title=""><i class="far fa-angle-left"></i></a>
    </div>
    <div class="container">
        <div class="withdraw">
            <div class="top">
                <div class="num">${{ auth('member')->user()->money }}</div>
                <div class="desc">Withdrawable cash amount</div>
            </div>
            <div class="bottom">
                <label class="i-check">
                    <input class="hidden" type="checkbox" name="gender" checked=""><i></i>
                    <span>Withdrawal to your bank card</span>
                </label>
            </div>
        </div>
        <div class="form-second v2">
            <form method="POST" action="{{ route('money.save_withdraw') }}">
                @csrf
                <input type="text" value="{{ auth('member')->user()->id }}" hidden name="user_id">
                <input type="text" value="{{ auth('member')->user()->username }}" hidden name="name">
                <input type="text" value="1" hidden name="type">
                <input type="text" value="1" hidden name="status">
                <input type="number" value="{{ auth('member')->user()->money }}" class="form-control" hidden name="money_me">
                <h3 class="head text-left">Enter your sum</h3>
                <div class="form-group">
                    <input type="text" class="form-control {{ $errors->has('money') ? ' is-invalid' : '' }}" placeholder="Enter your sum" name="money">
                    @if ($errors->has('money'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('money') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <input type="password" class="form-control {{ $errors->has('fund_password') ? ' is-invalid' : '' }}" placeholder="Enter your Fund Password" name="fund_password">
                    @if ($errors->has('fund_password'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('fund_password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <button class="btn-pri">Withdraw</button>
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