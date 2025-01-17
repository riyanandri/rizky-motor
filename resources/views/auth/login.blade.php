<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('spica/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('spica/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('spica/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('spica/images/favicon.png') }}" />
</head>
<body>
    <div class="container-scroller d-flex">
        <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
          <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
              <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="auth-form-transparent text-left p-3">
                  <div class="brand-logo">
                    <img src="{{ asset('spica/images/logo.svg') }}" alt="logo">
                  </div>
                  <h4>Welcome back!</h4>
                  <h6 class="font-weight-light">Happy to see you again!</h6>
                  <form method="POST" action="{{ route('login') }}" class="pt-3">
                    @csrf
                    <div class="form-group">
                      <label for="email">Email</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="mdi mdi-account-outline text-primary"></i>
                          </span>
                        </div>
                        <input type="email" class="form-control form-control-lg border-left-0" id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="mdi mdi-lock-outline text-primary"></i>
                          </span>
                        </div>
                        <input type="password" class="form-control form-control-lg border-left-0" id="password" name="password" placeholder="Password">                        
                      </div>
                    </div>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                          <input type="checkbox" class="form-check-input">
                          Keep me signed in
                        </label>
                      </div>
                      @if (Route::has('password.request'))
                      <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
                      @endif
                    </div>
                    <div class="my-3">
                      <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">LOGIN</button>
                    </div>
                    <div class="text-center mt-4 font-weight-light">
                      Don't have an account? <a href="{{ route('register') }}" class="text-primary">Create</a>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-6 login-half-bg d-none d-lg-flex flex-row">
                <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2024  All rights reserved.</p>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ asset('spica/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('spica/js/off-canvas.js') }}"></script>
    <script src="{{ asset('spica/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('spica/js/template.js') }}"></script>
    <!-- endinject -->
</body>
</html>