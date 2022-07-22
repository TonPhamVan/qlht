@extends('layouts.master')
@section('list-import_detail')
<section class="content-header">
    {{-- <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{$title}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active"><a href="#">Contact</a></li>
          </ol>
        </div>
      </div>
    </div> --}}
    <!-- /.container-fluid -->
  </section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{$title}}</h3>
                    </div>
                    <div style="margin: 15px 15px 0 15px">
                        @if (session('msg'))
                        <div class="alert alert-success">{{session('msg')}}</div>

                        @endif
                    </div>
                    <div>
                        @if (session('msg'))
                            <div class="alert alert-success">{{session('msg')}}</div>

                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">Dữ liệu nhập vào không hơp lệ. Vui lòng kiểm tra lại</div>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{route('export_details.postAdd')}}" method="POST">
                      <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                <label>Khách hàng</label>
                                <select class="form-control" name="drug_id">
                                    <option selected disabled>Chọn khách hàng</option>
                                        @if (!empty($customer))
                                            @foreach ($customer as $item)
                                            <option value="{{$item->id}}">{{$item->customer_name}}</option>
                                            @endforeach
                                        @endif
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                <label>Người bán</label>
                                <select class="form-control" name="drug_id">
                                    <option selected disabled>Chọn người bán</option>
                                        @if (!empty($user))
                                            @foreach ($user as $item)
                                            <option value="{{$item->id}}">{{$item->fullname}}</option>
                                            @endforeach
                                        @endif
                                </select>
                                </div>
                            </div>
                            {{-- <div class="col-sm-12">
                                <!-- select -->
                                <div class="form-group">
                                <label>Tên thuốc cần xuất</label>
                                <select class="form-control" name="drug_id">
                                    <option selected disabled>Chọn thuốc cần xuất</option>
                                        @if (!empty($drug))
                                            @foreach ($drug as $item)
                                            <option value="{{$item->id}}">{{$item->drug_name}}</option>
                                            @endforeach
                                        @endif
                                </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Số lượng xuất</label>
                                    <input type="number" class="form-control"
                                    name="quantity_export" pattern="[-+]?[0-9]" min="0" placeholder="Nhập số lượng..." value="{{old('quantity_export')}}">
                                    @error('quantity_export')
                                        <span style="color: red">{{$message}}</span>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>
                      <!-- /.card-body -->

                        <div class="card-body">
                            <div class="row">
                            </div>
                        <div class="table-responsive p-0">
                            <table class="table  table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 10px">STT</th>
                                    <th>Tên thuốc</th>
                                    <th>Số lượng xuất đi</th>
                                    <th>Giá bán</th>
                                    <th>Đơn vị</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày tạo</th>
                                    <th width = "5%">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($listUpdate))
                                        @foreach ($listUpdate as $key => $item)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$item->drug_name}}</td>
                                                <td>{{$item->quantity_export}}</td>
                                                <td>{{number_format($item->price) .'đ'}}</td>
                                                <td>{{$item->unit}}</td>
                                                <td>{{number_format($item->total_price).'đ'}}</td>
                                                <td>{{$item->created_at}}</td>
                                                <td>
                                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('export_details.delete',['id'=>$item->id])}}" class ="btn btn-danger btn-md">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7">Không có thuốc xuất đi</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                            @csrf
                        </div>
                    </form>


                  </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>

@endsection
