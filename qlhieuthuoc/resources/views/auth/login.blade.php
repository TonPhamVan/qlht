
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Quản lý hiệu thuốc | Log in</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <h1>Pharmacy Manager</h1>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            @if (session('msg'))
                <div class="alert alert-danger">{{session('msg')}}</div>

            @endif
            <form action="" method="post">
                @csrf
              <div class="input-group mb-3">
                <input id="user_email" type="user_email" class="form-control @error('user_email') is-invalid @enderror" name="user_email" value="{{ old('user_email') }}" required autocomplete="user_email" autofocus>

                @error('user_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="fa-solid fa-user"></i>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">


                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            {{-- <div class="social-auth-links text-center mt-2 mb-3">
              <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
              </a>
              <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
              </a>
            </div> --}}
            <!-- /.social-auth-links -->

            {{-- <p class="mb-1">
              <a href="forgot-password.html">I forgot my password</a>
            </p>
            <p class="mb-0">
              <a href="register.html" class="text-center">Register a new membership</a>
            </p> --}}
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
<!-- /.login-box -->

<script src="{{asset('js/app.js')}}"></script>

</body>
</html>
