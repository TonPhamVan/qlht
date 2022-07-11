@extends('layouts.master')
@section('edit-product')
<section class="content-header">
    <div class="container-fluid">
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
    </div><!-- /.container-fluid -->
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
            <form action="{{route('sanpham.postEdit')}}" method="POST">
              <div class="card-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control"
                    name="name" autofocus required placeholder="name..." value="{{old('name') ?? $productDetail->name}}">
                    @error('name')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                  </div>
                <div class="form-group">
                  <label for="">Price</label>
                  <input type="number" class="form-control"
                    name="Price" autofocus required placeholder="price..." value="{{old('name') ?? $productDetail->Price}}">
                    @error('price')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('sanpham.index')}}" class="btn btn-warning">Back</a>
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
