@extends('business.layouts.allbooking')
@section('menu')
@extends('business.sidebar.allbooking')
@endsection
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Quản lý đặt chỗ</h4>
                        <!--<button class="btn btn-primary float-right veiwbutton" type="submit">Xóa</button>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped table table-hover table-center mb-0">
                                <thead>
                                    <tr>

                                        <th>Mã đơn</th>
                                        <th>Tên khách hàng</th>
                                        <th>Dạng đặt</th>
                                        <th>Vé người lớn</th>
                                        <th>Vé trẻ em</th>
                                        <th>Từ ngày</th>
                                        <th>Đến ngày</th>
                                        <th>Tổng tiền</th>
                                        <th>Email</th>
                                        <th>số điện thoại</th>
                                        <th>Trang thái</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allBookings as $bookings)

                                    <tr>
                                        <td>{{ $bookings->id }}</td>
                                        <td>{{ $bookings->customers->last_name . ' ' . $bookings->customers->first_name ?? '' }}
                                        </td>
                                        <td>{{ $bookings->type_of_day }}</td>
                                        <td>{{ $bookings->number_of_adults }}</td>
                                        <td>{{ $bookings->number_of_children }}</td>
                                        <td>{{ $bookings->start_date }}</td>
                                        <td>{{ $bookings->end_date }}</td>
                                        <td>{{number_format( $bookings->total_cost,  2, '.', ','). ' ₫'}}</td>
                                        <td>{{ $bookings->customers->users->email ?? ''}}</td>
                                        <td>{{ $bookings->customers->users->phone ?? ''}}</td>
                                        <td>
                                            <div class="actions"> <a href="#" class="btn btn-sm bg-success-light mr-2">{{ $bookings->status_book }}</a> </div>

                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('form/booking/approveBooking', $bookings->id) }}">
                                                        <i class="fas fa-check m-r-5"></i> Duyệt
                                                    </a>
                                                    <a class="dropdown-item bookingDelete" href="{{ route('form/booking/cancelBooking', $bookings->id) }}">
                                                        <i class="fas fa-times m-r-5"></i> Hủy
                                                    </a>
                                                    <a class="dropdown-item bookingDelete" href="#" data-toggle="modal" data-target="#delete_asset">
                                                        <i class="fas fa-trash-alt m-r-5"></i> Xóa
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Model delete --}}
    <div id="delete_asset" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('form/booking/delete') }}" method="POST">
                    @csrf
                    <h3 class="delete_class">Are you sure want to delete this Asset?</h3>
                    <div class="m-t-20">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <input class="form-control" type="hidden" id="e_id" name="id" value="">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End Model delete --}}
</div>
@section('script')
{{-- delete model --}}
<script>
    $(document).on('click', '.bookingDelete', function() {
        var _this = $(this).parents('tr');
        $('#e_id').val(_this.find('.id').text());
    });
</script>
@endsection

@endsection