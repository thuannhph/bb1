@extends('plugins/member::layouts.header')
<div class="wrap">
    <div class="ptt"></div>
    <div class="direct-page">
        <h2 class="title">Language</h2>
        <a href="/profile" class="btn-back" title=""><i class="far fa-angle-left"></i></a>
    </div>
    <div class="container">
        <ul class="wrap-language">
            <li><a href="javascript:;" title=""><i class="far fa-credit-card-blank"></i> 简体中文</a></li>
            <li><a href="javascript:;" title=""><i class="far fa-credit-card-blank"></i> English</a></li>
            <li><a href="javascript:;" title=""><i class="far fa-credit-card-blank"></i> ไทย</a></li>
            <li><a href="javascript:;" title=""><i class="far fa-credit-card-blank"></i> 日文</a></li>
            <li><a href="javascript:;" title=""><i class="far fa-credit-card-blank"></i> 한국인</a></li>
            <li><a href="javascript:;" title=""><i class="far fa-credit-card-blank"></i> Tiếng Việt</a></li>
        </ul>
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
