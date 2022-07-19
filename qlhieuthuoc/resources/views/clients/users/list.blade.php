@extends('layouts.master')
@section('list-user')
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
                                <a href="{{route('users.add')}}" style="margin: 0 0 5px 0" class="btn btn-primary">Thêm tài khoản</a>
                            </div>
                            <div class="col-md-8" >
                                <form action="" method="GET" style="margin: 0 0 5px 0">
                                    <div class="input-group input-group-md">
                                        <input type="text" name="search" value="{{old('search')}}" class="form-control form-control-lg" placeholder="Tìm kiếm tên tài khoản">
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
                                <th>Email đăng nhập</th>
                                <th>Họ tên</th>
                                <th>Địa chỉ</th>
                                <th>Số điện thoại</th>
                                <th>Quyền hạn</th>
                                <th>Ngày tạo</th>
                                <th width = "5%">Sửa</th>
                                <th width = "5%">Xóa</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if (!empty($list))
                                    @foreach ($list as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->user_email}}</td>
                                            <td>{{$item->fullname}}</td>
                                            <td>{{$item->address}}</td>
                                            <td>{{$item->phone}}</td>
                                            <td>{{$item->permission_name}}</td>
                                            <td>{{$item->created_at}}</td>
                                            <td>
                                                <a href="{{route('users.getEdit',['id'=>$item->id])}}" class ="btn btn-warning btn-md">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa?')" href="{{route('users.delete',['id'=>$item->id])}}" class ="btn btn-danger btn-md">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                      <tr>
                                        <td colspan="7">Không có thông tin tài khoản</td>
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
                            {{$list->appends(request()->all())->links()}}
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
