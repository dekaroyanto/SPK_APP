<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Pendukung Keputusan Metode ROC VIKOR</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body class="bg-gradient-warning">
    <nav class="navbar navbar-expand-lg navbar-dark bg-white shadow-lg pb-3 pt-3 font-weight-bold">
        <div class="container">
            <a class="navbar-brand text-warning" style="font-weight: 900;" href="{{ url('/') }}"> <i class="fa fa-database mr-2 rotate-n-15"></i> Sistem Pendukung Keputusan Metode ROC VIKOR</a>
        </div>
    </nav>

    <div class="container">
        <!-- Outer Row -->
        <div class="row d-flex justify-content-between mt-5">				
            <div class="col-xl-6 col-lg-6 col-md-6 mt-5">
                <div class="card bg-none o-hidden border-0 my-5 text-white" style="background: none;">
                    <div class="text-justify card-body p-0">
                        <h4 style="font-weight: 800;">Sistem Pendukung Keputusan Metode ROC VIKOR</h4>
                        <p class="pt-4">
                            Metode Rank Order Centroid (ROC) merupakan metode yang dapat menghasil pembobotan terhadap sejumlah kriteria sesuai dengan tingkat kepentingan dari kriteria yang ditetapkan. Hasil yang diberikan oleh metode ROC cukup membantu pengambil keputusan dalam penetapan bobot dari suatu kriteria.
                        </p>
                        <p>
                            Metode Vise Kriterijumska Optimizacija I Kompromisno Resenje (VIKOR) didasarkan pada perangkingan dan pemilihan dari sekumpulan alternatif yang ada. Metode ini dapat digunakan untuk merangking sebanyak kriteria baik itu kualitatif maupun kuantitatif. Metode VIKOR dapat menyelesaikan pengambilan keputusan bersifat diskret pada kriteria yang bertentangan dan non commensurable, yaitu perbedaan unit antar kriteria.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-5 col-lg-5 col-md-5 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Account</h1>
                                    </div>
                                    @if(session('message'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        {{ session('message') }}
                                    </div>
                                    @endif

                                    <form class="user" action="{{ url('proses_login') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input required autocomplete="off" type="text" class="form-control form-control-user" id="exampleInputUser" placeholder="Username" name="username" />
                                        </div>
                                        <div class="form-group">
                                            <input required autocomplete="off" type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password" />
                                        </div>
                                        <button name="submit" type="submit" class="btn btn-warning btn-user btn-block"><i class="fas fa-fw fa-sign-in-alt mr-1"></i> Masuk</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>
</html>
