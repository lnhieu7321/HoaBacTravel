@extends('business.layouts.master')
@section('menu')
@extends('business.sidebar.dashboard')
@endsection
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <h3 class="page-title mt-3">Hi, {{ Auth::user()->name }}</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="statistics-details d-flex align-items-center justify-content-between mb-5">
                    <div>
                        <p class="statistics-title">Số khách hàng</p>
                        <h3 class="rate-percentage">200</h3>
                    </div>
                    <div>
                        <p class="statistics-title">Số lượt đặt vé</p>
                        <h3 class="rate-percentage">127</h3>
                    </div>
                    <div>
                        <p class="statistics-title">Số lượng đánh giá</p>
                        <h3 class="rate-percentage">30</h3>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">VISITORS</h4>
                    </div>
                    <div class="card-body">
                        <div id="line-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="card card-chart">
                    <div class="card-header">
                        <h4 class="card-title">ROOMS BOOKED</h4>
                    </div>
                    <div class="card-body">
                        <div id="donut-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex">
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h4 class="card-title float-left mt-2">Booking</h4>
                        <button type="button" class="btn btn-primary float-right veiwbutton">Veiw All</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center">
                                <thead>
                                    <tr>
                                        <th>Mã đặt</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Tên dịch vụ</th>
                                        <th class="text-right">Tổng tiền</th>
                                        <th class="text-center">Trạng thái</th>
                                    </tr>
                                </thead>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection