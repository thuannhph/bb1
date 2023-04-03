@extends('plugins/member::layouts.header')
<div class="wrap">
    <div class="ptt"></div>
    <div class="direct-page">
        <h2 class="title">Top-Up</h2>
        <a href="/profile" class="btn-back" title=""><i class="far fa-angle-left"></i></a>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('money.save_top_up') }}">
            @csrf
            <div class="form-pri">
                <div class="row col-mar-5">
                    <div class="col-12">
                        <input type="text" value="{{ auth('member')->user()->id }}" hidden name="user_id">
                        <input type="text" value="{{ auth('member')->user()->username }}" hidden name="name">
                        <input type="text" value="2" hidden name="type">
                        <div class="form-group">
                            <label>Amount of top up</label>
                            <input type="text" id="money" class="form-control num-top-up {{ $errors->has('money') ? ' is-invalid' : '' }}" placeholder="" name="money">
                            @if ($errors->has('money'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('money') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <a class="btn-num" value="200">200$</a>
                    </div>
                    <div class="col-6">
                        <a class="btn-num" value="500">500$</a>
                    </div>
                    <div class="col-6">
                        <a class="btn-num" value="1000">1000$</a>
                    </div>
                    <div class="col-6">
                        <a class="btn-num" value="3000">3000$</a>
                    </div>
                    <div class="col-6">
                        <a class="btn-num" value="5000">5000$</a>
                    </div>
                    <div class="col-6">
                        <a class="btn-num" value="10000">10000$</a>
                    </div>
                </div>
            </div>
            <div class="wrap-payment">
                <h3 class="head">Please select payment method</h3>
                <div class="row col-mar-5">
                    <div class="col-md-6">
                        <div class="box-pay">
                            <button class="btn-num" style="width:100%">
                                <h4 class="title"><i class="fas fa-money-check"></i>Contact Customer Service</h4>
                            </button>
                            <p>BIDV</p>
                            <p>3638383838</p>
                            <p>Nguyễn Văn Hải</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    window.onload = function() {
        var anchors = document.getElementsByClassName("btn-num");
        for(var i = 0; i < anchors.length; i++) {
            var anchor = anchors[i];
            anchor.onclick = function() {
                var fired_button = this.getAttribute('value');
                document.getElementById("money").value = fired_button;
            }
        }
    }
</script>
@push('scripts')
  <script type="text/javascript" src="{{ asset('js/jquery.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/slick.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/scrollspy.js')}}"></script>
  <script type="text/javascript" src="{{ asset('js/scrollspy.js')}}"></script>
  <script type="text/javascript" src="{{ asset('vendor/core/core/js-validation/js/js-validation.js')}}"></script>
@endpush