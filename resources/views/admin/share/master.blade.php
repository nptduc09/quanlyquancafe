
<!doctype html>
<html lang="en">

<head>
    @include("admin.share.css")
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->

        @include("admin.share.menu")

		@include("admin.share.header")


		<div class="page-wrapper">
            @yield('noi_dung')
        </div>

	</div>



    @include("admin.share.js")
    @yield("js")
</body>

</html>
