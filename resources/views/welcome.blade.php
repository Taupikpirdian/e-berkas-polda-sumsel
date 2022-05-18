<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />

    <!-- icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('images/icon/icon.png')}}" />

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/icon.png')}}" />

    <!-- TITLE -->
    <title>CJS-Polda Sumsel</title>
  </head>
  <body style="background: #f2f3f9 !important;">
    <section>
        <div class="container welcome-page">
            <div class="row header">
                <div class="col text-center">
                    <h1>E-BERKAS <span>+</spann></h1>
                    {{-- <h2>ELEKTRONIK BERKAS</h2> --}}
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p class="text-center" style="color: #6259CA;">Pilih menu dibawah untuk login</p>
                    <div class="row mt-4">
                        <div class="col-sm-3">
                            <a href="/login">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="{{asset('images/polda.png')}}" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="/login">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="{{asset('images/jaksa.png')}}" class="mt-2" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="/login">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="{{asset('images/pengadilan.png')}}" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="/login">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="{{asset('images/kemenkumham.png')}}" class="mt-3" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>