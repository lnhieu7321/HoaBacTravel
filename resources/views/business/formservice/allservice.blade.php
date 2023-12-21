@extends('business.layouts.allbooking')
@section('menu')
@extends('business.sidebar.allservice')
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
                        <h4 class="card-title float-left mt-2">Quản lý dịch vụ</h4>
                        <a href="{{ route('form/serviceadd') }}" class="btn btn-primary float-right veiwbutton ">Thêm</a>
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
                                        <th>Mã dịch vụ</th>
                                        <th>Tên dịch vụ</th>
                                        <th>Mô tả</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá chung</th>
                                        <th>Địa chỉ</th>
                                        <th>Phường/ Quận</th>
                                        <th>Thành Phố</th>
                                        <th>Quốc gia</th>
                                        <th class="text-right">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allServices as $services )
                                    <tr>
                                        <td>{{ $services->id }}</td>
                                        <td>{{ $services->service_name }}</td>
                                        <td>{{ $services->description }}</td>
                                        <td>
                                            @if ($services->images->count())
                                            <img src="{{ URL::to('/assets/upload/'.$services->images->first()->url) }}" alt="{{ $services->service_name }}" width="100px">
                                            @else
                                            <span>Không có hình ảnh</span>
                                            @endif
                                        </td>
                                        <td>{{number_format( $services->price,  0, '.', ','). ' ₫'}}</td>
                                        <td>{{ $services->address }}</td>
                                        <td>{{ $services->ward . ', ' . $services->district ?? '' }}
                                        </td>
                                        <td>{{ $services->city }}</td>
                                        <td>{{ $services->country }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v ellipse_color"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">

                                                    <a class="dropdown-item" href="{{ route('form/serviceedit', $services->id) }}">
                                                        <i class="fas fa-pencil-alt m-r-5"></i> Sửa
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
                    <div class="modal-body text-center">
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