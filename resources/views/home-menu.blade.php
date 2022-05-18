<!doctype html>
<html lang="en">
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
        @livewireStyles
        @yield('css')
    </head>
    <body style="background: #f2f3f9 !important;">
        <section>
            <div class="container welcome-page">
                <div class="row">
                    <div class="col-sm">
                        @include('shared.modal')             
                    </div>
                </div>
            </div>
        </section>
        @include('include.script')
		@livewireScripts
		@yield('js')
        <script type="text/javascript">
            var listMenu = new bootstrap.Modal(document.getElementById("exampleModal"), {
                backdrop: 'static', 
                keyboard: false,
            });
            document.onreadystatechange = function () {
                listMenu.show();
            };
        </script>
    </body>
</html>