@extends('layouts.master')
@section('add-drug_group')
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
        <div class="col-md-9">
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
            <form action="{{route('drugs.postAdd')}}" method="POST">
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Tên thuốc</label>
                            <input type="text" class="form-control"
                              name="drug_name" required placeholder="Nhập tên thuốc..." value="{{old('drug_name')}}">
                              @error('drug_name')
                                  <span style="color: red">{{$message}}</span>
                              @enderror
                        </div>
                    </div>
                  <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Nhóm thuốc</label>
                      <select class="form-control" name="id_drug_group">
                        <option selected disabled>Chọn tên nhóm thuốc</option>
                        @if (!empty($drugGroup))
                            @foreach ($drugGroup as $item)
                            <option value="{{$item->id}}">{{$item->name_drug_group}}</option>
                            @endforeach
                        @endif
                      </select>
                    </div>

                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Thành phần</label>
                        <input type="text" class="form-control"
                          name="ingredient" placeholder="Nhập thành phần thuốc..." value="{{old('ingredient')}}">
                          @error('ingredient')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Công dụng</label>
                        <input type="text" class="form-control"
                          name="uses" placeholder="Nhập công dụng thuốc..." value="{{old('uses')}}">
                          @error('uses')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Nhà sản xuất</label>
                        <input type="text" class="form-control"
                          name="producer" placeholder="Nhập nhà sản xuất thuốc..." value="{{old('producer')}}">
                          @error('producer')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">Giá bán</label>
                        <input type="text" class="form-control"
                          name="price" placeholder="Nhập giá bán thuốc..." value="{{old('price')}}">
                          @error('price')
                              <span style="color: red">{{$message}}</span>
                          @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                      <label>Đơn vị thuốc</label>
                      <select class="form-control" name="unit">
                        <option selected disabled>Chọn đơn vị thuốc</option>
                        <option value="Hộp" {{old('unit')=='Hộp' ? 'selected':false}}>Hộp</option>
                        <option value="Lọ" {{old('unit')=='Lọ' ? 'selected':false}}>Lọ</option>
                        <option value="Vỉ" {{old('unit')=='Vỉ' ? 'selected':false}}>Vỉ</option>
                      </select>
                    </div>
                </div>
            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('drugs.index')}}" class="btn btn-success">Back</a>
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
