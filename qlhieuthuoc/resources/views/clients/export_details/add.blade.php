@extends('layouts.master')
@section('add-export_detail')
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
            <form action="{{route('export_details.postAdd')}}" method="POST">
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
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
                </div>

            </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('export_details.index')}}" class="btn btn-success">Back</a>
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
