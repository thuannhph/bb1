<?php
    $featured = get_products();
    $vip = get_vips();
?>
<div class="wrap">
    <section class="home-banner">
        <div class="container">
            <div class="cas-home">
                <a href="javascript:;" title="" class="item"><img src="{{ RvMedia::url('image/banner.jpg') }}" alt=""></a>
                <a href="javascript:;" title="" class="item"><img src="{{ RvMedia::url('image/banner2.jpg') }}" alt=""></a>
                <a href="javascript:;" title="" class="item"><img src="{{ RvMedia::url('image/banner3.jpg') }}" alt=""></a>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="cas-vertical">
            <div class="item">[****3536] Received commission $6329.00</div>
            <div class="item">[****3536] Received commission $6329.00</div>
            <div class="item">[****3536] Received commission $6329.00</div>
            <div class="item">[****3536] Received commission $6329.00</div>
            <div class="item">[****3536] Received commission $6329.00</div>
            <div class="item">[****3536] Received commission $6329.00</div>
            <div class="item">[****3536] Received commission $6329.00</div>
        </div>
        <ul class="list-menu">
            <li class="item">
                <a href="/withdraw" title="">
                    <span class="ic"><img src="{{ RvMedia::url('image/deal.png') }}"></span>
                    <span class="title">Withdraw</span>
                </a>
            </li>
            <li class="item">
                <a href="javascript:;" title="">
                    <span class="ic"><img src="{{ RvMedia::url('image/w.png') }}"></span>
                    <span class="title">Wallet</span>
                </a>
            </li>
            <li class="item">
                <a href="javascript:;" title="">
                    <span class="ic"><img src="{{ RvMedia::url('image/invite.png') }}"></span>
                    <span class="title">Invite friends</span>
                </a>
            </li>
            <li class="item">
                <a href="/top-up" title="">
                    <span class="ic"><img src="{{ RvMedia::url('image/transfer.png') }}"></span>
                    <span class="title">Top-up</span>
                </a>
            </li>
            <li class="item">
                <a href="javascript:;" title="">
                    <span class="ic"><img src="{{ RvMedia::url('image/r-1.png') }}"></span>
                    <span class="title">Rule</span>
                </a>
            </li>
            <li class="item">
                <a href="javascript:;" title="">
                    <span class="ic"><img src="{{ RvMedia::url('image/company.png') }}"></span>
                    <span class="title">Platform Introduction</span>
                </a>
            </li>
        </ul>
        <div class="home-block">
            <h3 class="head-pri">Membership Level：</h3>
            <div class="list-level">
                @foreach($vip as $value)
                    <a href="javascript:;" class="item v1">
                        <span class="img"><img src="{{ RvMedia::url($value->image) }}" alt=""></span>
                        <div class="ct">
                            <h3 class="title">{{ $value->name }} @if ($value->status != 'published') (Not yet open) @endif</h3>
                            <p class="desc">Required Investment ${{$value->investment}}</p>
                            <p class="desc">Commission {{$value->commission}}% | {{$value->order}} Orders</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="home-block product">
            <h3 class="head-pri">Recommended：</h3>
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
    <div class="menu-fix">
        <div class="container">
            <ul>
                <li class="active"><a href="javascript:;" title=""><img src="{{ RvMedia::url('image/ic-head1.png') }}" alt=""></a></li>
                <li><a href="javascript:;" title=""><img src="{{ RvMedia::url('image/ic-head2.png') }}" alt=""></a></li>
                <li><a href="/order" title=""><img src="{{ RvMedia::url('image/ic-head3.png') }}" alt=""></a></li>
                <li><a href="javascript:;" title=""><img src="{{ RvMedia::url('image/ic-head4.png') }}" alt=""></a></li>
                <li><a href="/profile" title=""><img src="{{ RvMedia::url('image/ic-head5.png') }}" alt=""></a></li>
            </ul>
        </div>
    </div>
    
</div>

