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
		@livewireStyles
		@yield('css')
	</head>

	<body>

		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">
                <!-- Header -->
                @include('include.header')
                <!-- end Header -->
                
				<!-- menubar -->
                @include('include.menubar')
				<!-- end menubar -->

                <!-- Content -->
				@yield('content')
				<!-- Content -->
            </div>

			<!-- Sidebar-right -->
			@include('include.sidebarright')
			<!--/Sidebar-right-->

			<!-- FOOTER -->
			@include('include.footer')
			<!-- FOOTER END -->
		</div>

		<!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

        <!-- script -->
        @include('include.script')
		@livewireScripts
		@yield('js')
	</body>
</html>