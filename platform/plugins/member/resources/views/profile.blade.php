
@extends('plugins/member::layouts.header')
<div class="wrap">
    <div class="ptt"></div>
    <section class="page-profile">
        <div class="container">
            <div class="detail-profile">
                <div class="info-user">
                    <div class="avt">
                        <img src="{{ asset(auth('member')->user()->avatar_url) }}" alt="">
                    </div>
                    <div class="ct">
                        <h3 class="name">{{ auth('member')->user()->username }}: {{ auth('member')->user()->phone }}</h3>
                        <div class="code">Invitation code <b>47231</b></div>
                    </div>
                </div>
                <div class="detail-user">
                    <div class="top">
                        <div class="left">
                            <h3 class="count">$0.00</h3>
                            <div class="desc">Account Balance</div>
                        </div>
                        <button type="submit" class="btn-plus"><a href="/add-card" title="" class="item"><i class="fal fa-plus"></i></a></button>
                    </div>
                    <div class="btn-bottom">
                        <a href="/top-up" title="" class="item">Top-up</a>
                        <a href="/add-card" title="" class="item">Withdraw</a>
                    </div>
                </div>
            </div>
            <ul class="menu-profile">
                <li>
                    <a href="/add-card" title="">
                        <span class="ic"><i class="fas fa-upload"></i></span> Withdraw
                    </a>
                </li>
                <li>
                    <a href="javascript:;" title="">
                        <span class="ic"><i class="fas fa-users"></i></span> Team statement
                    </a>
                </li>
                <li>
                    <a href="/top-up" title="">
                        <span class="ic"><i class="fas fa-layer-plus"></i></span> Top-up Record
                    </a>
                </li>
                <li>
                    <a href="javascript:;" title="">
                        <span class="ic"><i class="fas fa-layer-minus"></i></span> Withdraw Record
                    </a>
                </li>
                <li>
                    <a href="javascript:;" title="">
                        <span class="ic"><i class="fas fa-repeat"></i></span> Detailed Bills
                    </a>
                </li>
                <li>
                    <a href="javascript:;" title="">
                        <span class="ic"><i class="fas fa-money-check-alt"></i></span> Shipping Address
                    </a>
                </li>
                <li>
                    <a href="/add-card" title="">
                        <span class="ic"><i class="fas fa-money-check-alt"></i></span> Payment Card
                    </a>
                </li>
                <li>
                    <a href="/find-your-password" title="">
                        <span class="ic"><i class="fas fa-unlock-alt"></i></span> Find Your Password
                    </a>
                </li>
                <li>
                    <a href="/fund-password" title="">
                        <span class="ic"><i class="fas fa-unlock-alt"></i></span> Fund Password
                    </a>
                </li>
                <li>
                    <a href="/language" title="">
                        <span class="ic"><i class="fas fa-globe"></i></span> Language
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="{{ trans('plugins/member::dashboard.header_logout_link') }}">
                        <span class="ic"><i class="fas fa-power-off"></i></span> Log out
                    </a>
                    <form id="logout-form" action="{{ route('public.member.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </section>
    <div class="menu-fix v2">
        <div class="container">
            <ul>
                <li><a href="/" title=""><i class="fas fa-home-lg-alt"></i></a></li>
                <li><a href="javascript:;" title=""><i class="fas fa-ballot-check"></i></a></li>
                <li><a href="/order" title=""><i class="fas fa-hand-paper"></i></a></li>
                <li><a href="/support" title=""><i class="fas fa-comment-alt-lines"></i></a></li>
                <li class="active"><a href="/profile" title=""><i class="fas fa-user"></i></a></li>
            </ul>
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