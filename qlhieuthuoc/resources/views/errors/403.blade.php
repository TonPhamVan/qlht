@extends('layouts.master')
@section('403')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
    <div class="error-page">
        <h2 class="headline text-warning"> 403</h2>

        <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Bạn không có quyền truy cập trang này.</h3>

        <p>
            {{$exception->getMessage()}} Bạn có thể <a href="{{route('master')}}">quay lại trang chủ.</a>
        </p>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>
@endsection

