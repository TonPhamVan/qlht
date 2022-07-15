@extends('layouts.master')
@section('listdelete-supplier')
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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-8" >
                                <form action="" method="GET" style="margin: 0 0 5px 0">
                                    <div class="input-group input-group-md">
                                        <input type="text" name="search" class="form-control form-control-lg" placeholder="Tìm kiếm tên nhà cung cấp">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-lg btn-default btn-secondary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                      <div class="table-responsive p-0">
                        <table class="table  table-hover text-nowrap">
                            <thead>
                              <tr>
                                <th style="width: 10px">STT</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Ngày tạo</th>
                                <th width = "5%">Khôi phục</th>
                                <th width = "5%">Xóa</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if (!empty($listdelete))
                                    @foreach ($listdelete as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->supplier_name}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>
                                                <a href="{{route('suppliers.untrash',['id'=>$item->id])}}" class ="btn btn-warning btn-md">
                                                    <i class="fa-solid fa-trash-arrow-up"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('suppliers.forceDelete',['id'=>$item->id])}}" class ="btn btn-danger btn-md">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                      <tr>
                                        <td colspan="7">Không có thông tin nhà cung cấp</td>
                                      </tr>
                                @endif

                            </tbody>
                          </table>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      <div class="row">
                        <div class="col-md-4">
                            {{$listdelete->appends(request()->all())->links()}}
                        </div>
                        <div class="col-md-8">
                            <a href="{{route('suppliers.index')}}" style="margin: 0 0 5px 0" class="btn btn-success float-right">Back</a>
                        </div>
                      </div>
                    </div>

                  </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>

@endsection
