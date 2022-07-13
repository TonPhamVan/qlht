<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
  <link rel="icon" href="{{asset('images\logo.png') }}" type="image/x-icon">
  <title>Quản Lý Hiệu Thuốc</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  {{-- navbar --}}
  @include('clients.blocks.navbar')

  <!-- Main Sidebar Container -->
  @include('clients.blocks.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('add-customer')
    @yield('list-customer')
    @yield('listdelete-customer')
    @yield('edit-customer')

    {{-- drug_groups --}}
    @yield('add-drug_group')
    @yield('list-drug_group')
    @yield('listdelete-drug_group')
    @yield('edit-drug_group')

  </div>
  <!-- /.content-wrapper -->

  {{-- footer --}}
  @include('clients.blocks.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('js/app.js')}}"></script>

{{-- <script>
$(function () {
  bsCustomFileInput.init();
});
</script> --}}
</body>
</html>
