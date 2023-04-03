@extends('plugins/member::layouts.header')
<?php
    $getTopUp = get_top_up();
    $index = 1;
    function getStastus($idStatus) {
        if($idStatus == 1) {
            return "Chờ xét duyệt";
        } else if ($idStatus == 2) {
            return "Thành công";
        } else {
            return "Đóng băng";
        }
    };
?>
<div class="wrap">
    <div class="ptt"></div>
    <div class="direct-page">
        <h2 class="title">Top up record</h2>
        <a href="/profile" class="btn-back" title=""><i class="far fa-angle-left"></i></a>
    </div>
    <div class="container">
        <div class="wrap-list-pri">
            <h3 class="head-second">Top up record</h3>
            <div class="tb-pri">
                <table class="table">
                    <tr>
                        <th>STT</th>
                        <th>Tiền</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                    @foreach($getTopUp as $value)
                        <tr>
                            <td>{{ $index ++ }}</td>
                            <td>{{ $value->money }}</td>
                            <td>{{ getStastus($value->status) }}</td>
                            <td>{{ $value->created_at }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <!-- <div class="pagination-container">
                <span> 0 records in total, 
                    <select>
                        <option data-num="10" value="">10</option>
                        <option data-num="20" value="" selected="">20</option>
                    </select> 0 1 records on a page
                </span>
            </div> -->
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