@extends('layouts.master')
@section('edit-user')
<section class="content-header">
    {{-- <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{$title}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item active"><a href="#">{{$title}}</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid --> --}}
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>

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
            <form action="{{route('users.postEdit')}}" method="POST">
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Email tài khoản *</label>
                            <input type="email" class="form-control"
                              name="user_email" required placeholder="Nhập tên tài khoản..." value="{{old('user_email') ?? $detail->user_email}}">
                              @error('user_email')
                                  <span style="color: red">{{$message}}</span>
                              @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Mật khẩu *</label>
                            <input type="text" class="form-control"
                              name="password" required placeholder="Nhập mật khẩu..." value="{{old('password') ?? $detail->password}}">
                              @error('password')
                                  <span style="color: red">{{$message}}</span>
                              @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Họ và tên *</label>
                            <input type="text" class="form-control"
                              name="fullname" required placeholder="Nhập mật khẩu..." value="{{old('fullname') ?? $detail->fullname}}">
                              @error('fullname')
                                  <span style="color: red">{{$message}}</span>
                              @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Số điện thoại *</label>
                            <input type="tel" class="form-control"
                              name="phone" required placeholder="Nhập số điện thoại..." value="{{old('phone') ?? $detail->phone}}">
                              @error('phone')
                                  <span style="color: red">{{$message}}</span>
                              @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" class="form-control"
                              name="address" placeholder="Nhập địa chỉ..." value="{{old('address') ?? $detail->address}}">
                              @error('address')
                                  <span style="color: red">{{$message}}</span>
                              @enderror
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <!-- select -->
                        <div class="form-group">
                          <label>Quyền hạn *</label>
                          <select class="form-control" name="permission_id">
                            <option disabled>Chọn quyền hạn</option>
                            @if (!empty($permission))
                                @foreach ($permission as $item)
                                <option value="{{$item->id}}" {{$detail->permission_id==$item->id ? 'selected' : ''}}>{{$item->permission_name}}</option>
                                @endforeach
                            @endif
                          </select>
                        </div>
                    </div>
                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('users.index')}}" class="btn btn-warning">Back</a>
                @csrf
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (right) -->
        <div class="col-md-1"></div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
