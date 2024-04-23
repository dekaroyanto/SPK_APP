<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('loginform/style.css') }}" />
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form action="{{ url('proses_login') }}" method="post" autocomplete="off" class="sign-in-form">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('loginform/img/columbus.jpg') }}" alt="easyclass" />
                        </div>

                        <div class="heading">
                            <h2>Welcome Back</h2>
                        </div>
                        {{-- @error('loginError')
                            <div class="alert alert-danger">
                                <strong>Gagal Login</strong>
                                <p>{{ $message }}</p>
                            </div>
                        @enderror --}}

                        @if ($errors->any())
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal Login',
                                    text: '{{ $errors->first() }}'
                                });
                            </script>
                        @endif
                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="username" minlength="4" class="input-field"
                                    autocomplete="off" required />
                                <label>Username</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password" minlength="4" class="input-field"
                                    autocomplete="off" required />
                                <label>Password</label>
                            </div>

                            <input type="submit" value="Login" class="sign-btn" />
                        </div>
                    </form>
                </div>

                <div class="rightpict">
                    <div class="images-wrapper">
                        <img src="{{ asset('loginform/img/image1.png') }}" class="image img-1 show" alt="" />
                    </div>
                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Login untuk melanjutkan</h2>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Javascript file -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{ asset('loginform/app.js') }}"></script>
</body>

</html>
