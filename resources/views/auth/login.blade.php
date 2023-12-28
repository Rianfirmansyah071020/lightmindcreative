<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>{{ env('APP_NAME') }}</title>

    @include('partials.link_dashboard')

</head>

<body>
    @include('partials.alert')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light shadow text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <h3 class="text-success mdi-text-shadow">{{ env('APP_NAME') }}</h3>
                            </div>
                            <h4 class=" text-dark">Hallo Silahkan login untuk memulai akses ke aplikasi</h4>

                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        name="email" id="exampleInputEmail1" placeholder="Username"
                                        value="{{ old('email') }}" />
                                    @error('email')
                                        <i class="text-danger" style="font-size: small;">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="exampleInputPassword1" name="password" value="{{ old('password') }}"
                                        placeholder="Password" />
                                    @error('password')
                                        <i class="text-danger" style="font-size: small;">{{ $message }}</i>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn">SIGN
                                        IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="remember" />
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    @include('partials.script_dashboard')

</body>

</html>
