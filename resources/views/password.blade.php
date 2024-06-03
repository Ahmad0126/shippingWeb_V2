<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Ganti Password</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <link href="css/style.css" rel="stylesheet">
    
</head>

<body class="h-100">
    
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <h4 class="text-center mb-3">Ganti Password</h4>

                                @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show notifikasi" role="alert">
                                    @foreach ($errors->all() as $e)
                                    <p>
                                        <span class="alert-icon"><i class="fa fa-exclamation"></i></span>
                                        <span class="alert-text">{{ $e }}</span>
                                    </p>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                @endif

                                <form action="{{ route('ganti_password') }}" method="post" class="mt-5 mb-5 login-input">
                                    @csrf
                                    <div class="form-group">
                                        <input name="password_lama" type="password" class="form-control" placeholder="Password Lama">
                                    </div>
                                    <div class="form-group">
                                        <input name="password_baru" type="password" class="form-control" placeholder="Password Baru">
                                    </div>
                                    <div class="form-group">
                                        <input name="password_konfirmasi" type="password" class="form-control" placeholder="Konfirmasi Password Baru">
                                    </div>
                                    <button class="btn login-form__btn submit w-100">LogIn</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="plugins/common/common.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/gleek.js"></script>
    <script src="js/styleSwitcher.js"></script>
</body>
</html>





