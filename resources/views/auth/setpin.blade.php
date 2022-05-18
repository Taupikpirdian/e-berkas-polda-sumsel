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

             form {
                margin: auto;
                width: 50% !important;
            }

            .form-control {
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
                    <div class="col-6">
                        <div class="card rounded-3 text-black">
                            <div class="row g-0">
                                <div class="col-lg-12">
                                    <div class="card-body p-md-5 mx-md-4">
                                        <div class="text-center mt-3" style="margin-bottom: 50px;">
                                            <h3 class="text-header">E-BERKAS <span>+</span></h3>
                                            <h4 class=" mb-5 pb-1">Aplikasi E-BERKAS Polda Sumsel</h4>
                                        </div>
                                        <form method="POST" action="{{ route('post-set-pin') }}">
                                        @csrf
                                            <div class="row mt-5 mb-5 ">
                                                <div class="col text-center">
                                                    <p>Masukan 6 digit pin baru Anda</p>
                                                    <p>PIN</p>
                                                    <input class="form-control" autocomplete="off" maxlength="6" type="text" id="pin" name="pin" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                                </div>
                                            </div>
                                            <div class="text-center pt-1 mb-5 pb-1">
                                                <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 show-modal" type="submit">SIMPAN</button>
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

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
                backdrop: 'static', 
                keyboard: false
            })
        </script>
    </body>
</html>