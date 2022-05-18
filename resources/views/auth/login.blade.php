<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('images/icon/icon.png')}}" />

		<!-- TITLE -->
		<title>CJS-Polda Sumsel</title>
        <!-- style -->
        @include('include.style')
        <!-- end style -->
        <style>
            .horizontalMenucontainer {
                height: 100%;
                background-color: #f2f3f9 !important;
            }
            .container .btn-primary {
                font-size: 15px;
                border: none;
                background: #6259CA !important;
                padding: 12px !important;
            }
            .text-header{
                margin-bottom : 12px;
                font-size: 50px;
                color: #6259CA;
            }

            .text-header span {
                color: #F63131;
            }

            .modal form {
                margin: auto;
                width: 50% !important;
            }

            .modal .form-control {
                text-align: center !important;
                border-top : none !important;
                border-left : none !important;
                border-right : none !important;
                border-radius: 0px !important;
            }

            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            .modal-dialog {
                margin-top: 8% !important;
            }

            @media (max-width: 576px) { 
                .carousel {
                    display: none !important;
                }
            }
            @media (min-width: 768px) { 
                .carousel {
                    display: none !important;
                }
            }
            @media (min-width: 992px) { 
                .carousel {
                    display: block !important;
                }
            }
        </style>
	</head>
    <body>
        <section class="h-100 gradient-form">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-10">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{asset('images/login1.png')}}" class="d-block w-100 hv-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{asset('images/login2.png')}}" class="d-block w-100 hv-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{asset('images/login3.png')}}" class="d-block w-100 hv-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{asset('images/login4.png')}}" class="d-block w-100 hv-100" alt="...">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                        </div>
                                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                        </div>
                                        <!-- <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{asset('images/login1.png')}}" class="d-block w-100 hv-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{asset('images/login2.png')}}" class="d-block w-100 hv-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{asset('images/login3.png')}}" class="d-block w-100 hv-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{asset('images/login4.png')}}" class="d-block w-100 hv-100" alt="...">
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <div class="text-center mt-3">
                                            <h3 class="text-header">E-BERKAS <span>+</span></h3>
                                            <h4 class=" mb-5 pb-1">APLIKASI E-BERKAS SUMATERA SELATAN</h4>
                                        </div>
                                        <div style="height: 20px"></div>
                                        <h4>Login</h4>
                                        <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" id="email" name="email" class="form-control" placeholder="Masukan Email Anda"/>
                                            </div>

                                            <div class="form-outline mb-5">
                                                <label class="form-label" for="form2Example22">Password</label>
                                                <input type="password" id="password" name="password" placeholder="Masukan Password Anda" class="form-control" />
                                            </div>

                                            <div class="form-outline mb-5 mt-5">
                                            {!! NoCaptcha::renderJs('in', false, 'recaptchaCallback') !!}
                                            {!! NoCaptcha::display() !!}
                                            </div>


                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Login</button>
                                                <!-- <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 show-modal" type="button">Login</button> -->
                                                {{-- <a href="/set-pin" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Login</a> --}}
                                            </div>
                                        </form>
                                        <div style="height: 40px;"></div>
                                        <div class="text-center">
                                            <img src="{{asset('images/icon/icon.png')}}" style="height: 40px; margin-right: 10px;" alt="logo">
                                            <img src="{{asset('images/icon/icon-kejaksaan-lg.png')}}" style="height: 40px; margin-right: 10px;" alt="logo">
                                            <img src="{{asset('images/icon/icon-pengadilan.png')}}" style="height: 40px; margin-right: 10px;" alt="logo">
                                            <img src="{{asset('images/icon/icon-kemenkumham-lg.png')}}" style="height: 40px" alt="logo">
                                        </div>
                                        <div style="height: 20px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row mt-3">
                            <div class="col text-center">
                                <h1>PIN <span style="color: #6259CA;">CJS</span><span style="color: #F63131">+</span></h1>
                                <p>masukan 6 digit pin anda</p>
                            </div>
                        </div>
                        <form action="">
                            <div class="row mt-4">
                                <div class="col text-center">
                                    <p>Kode Verifikasi</p>
                                    <input class="form-control" maxlength="6" type="text" id="salary" name="salary" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </div>
                            </div>
                            <div class="row mt-5 mb-3">
                                <div class="col text-center">
                                    <a href="" class="btn btn-primary">Verifikasi</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
            backdrop: 'static', 
            keyboard: false,
        });
        var onloadCallback = function() {
            alert("grecaptcha is ready!");
        };
    </script>
    
</html>