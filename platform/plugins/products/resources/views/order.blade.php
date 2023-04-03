@extends('plugins/member::layouts.header')
<?php
    $featured = get_products();
?>
<div class="wrap">
    <div class="ptt"></div>
    <section class="page-order">
        <div class="container">
            <div class="block-order">
                <div class="banner">
                    <img src="images/order-banner.png" alt="">
                </div>
                <a href="javascript:;" title="" class="btn-order">take orders</a>
                <div class="content">
                    <div class="item-order">
                        <span class="ic"><img src="images/ic-order1.png" alt=""></span>
                        <h3 class="title">Received commission</h3>
                        <div class="desc">$0.00</div>
                    </div>
                    <div class="item-order">
                        <span class="ic"><img src="images/ic-order2.png" alt=""></span>
                        <h3 class="title">Available balance</h3>
                        <div class="desc">$0.00</div>
                    </div>
                    <div class="item-order">
                        <span class="ic"><img src="images/ic-order3.png" alt=""></span>
                        <h3 class="title">Number of order</h3>
                        <div class="desc">0</div>
                    </div>
                    <div class="item-order">
                        <span class="ic"><img src="images/ic-order4.png" alt=""></span>
                        <h3 class="title">Account freeze amount</h3>
                        <div class="desc">0.00</div>
                    </div>
                </div>
            </div>
            <div class="home-block product">
                <h3 class="head-pri">Steps：</h3>
                <div class="desc-pri">
                    <p>1. Click the "Start Task" button and follow the prompts to complete the task</p>
                    <p>2. After completing the task, you can settle the commission to the balance</p>
                </div>
                <div class="row col-mar-7">
                    @foreach($featured as $value)
                        <div class="col-6">
                            <div class="item-prd">
                                <div class="img">
                                    <img src="{{ RvMedia::url($value->image) }}" alt="">
                                </div>
                                <div class="ct">
                                    <h3 class="title">{{ $value->name }}</h3>
                                    <div class="price">
                                        ${{ $value->price }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="menu-fix v2">
        <div class="container">
            <ul>
                <li><a href="/" title=""><i class="fas fa-home-lg-alt"></i></a></li>
                <li><a href="javascript:;" title=""><i class="fas fa-ballot-check"></i></a></li>
                <li class="active"><a href="/order" title=""><i class="fas fa-hand-paper"></i></a></li>
                <li><a href="/support" title=""><i class="fas fa-comment-alt-lines"></i></a></li>
                <li><a href="/profile" title=""><i class="fas fa-user"></i></a></li>
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