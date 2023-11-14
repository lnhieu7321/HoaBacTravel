@extends('business.layouts.allbooking')
@section('menu')
@extends('business.sidebar.serviceadd')
@endsection
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">Thêm dịch vụ du lịch</h3>
                </div>
            </div>
        </div>
        <form action="{{ route('form/service/save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tên dịch vụ</label>
                                <input type="text" class="form-control @error('service_name') is-invalid @enderror" name="service_name" value="{{ old('service_name') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mô tả</label>
                                <div>
                                    <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Giá</label>
                                <div>
                                    <input type="text" class="form-control @error('prices') is-invalid @enderror" name="prices" value="{{ old('prices') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <div>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phường(xã)</label>
                                <div>
                                    <input type="text" class="form-control @error('ward') is-invalid @enderror" name="ward" value="{{ old('ward') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quận(huyện)</label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tỉnh(Thành phố)</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quốc gia</label>
                                <select class="form-control @error('country') is-invalid @enderror" id="sel2" name="country">
                                    <option selected disabled> --Chọn quốc gia-- </option>
                                    @foreach ($data as $items )
                                    <option value="{{ $items->name_country }}">{{ $items->name_country }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary buttonedit1">Lưu</button>
        </form>
    </div>
</div>
@section('script')
<script>
    $(function() {
        $('#datetimepicker3').datetimepicker({
            format: 'LT'
        });
    });
</script>
@endsection

@endsection