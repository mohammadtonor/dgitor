<!DOCTYPE html>
<html dir="rtl" lang="en">

<head>
    <meta charset="UTF-8">
    <title>سامانه آموزش</title>
    <link rel="shortcut icon" href={{asset('/assets/images/favicon.ico')}} >
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf_token" content="{{csrf_token()}}">

    @yield("pagemeta")

    @include("Pannel.Admin.partials.maincss")

    @yield("pagecss")

</head>
<!-- END Head-->

<!-- START: Body-->
<body id="main-container" class="default horizontal-menu">
<!-- START: Pre Loader-->
<div class="se-pre-con">
    <img src="{{asset('/assets/images/logo.png')}}" alt="logo" width="23" class="img-fluid"/>
</div>
<!-- END: Pre Loader-->

<!-- START: Header-->
@include("Pannel.Admin.partials.header")
<!-- END: Header-->

<!-- START: Main Menu-->
@include("Pannel.Admin.partials.sidebar")
<!-- END: Main Menu-->

<!-- START: Main Content-->
@yield("content")
<!-- END: Content-->

<!-- START: Footer-->
@include("Pannel.Admin.partials.footer")
<!-- END: Footer-->

<!-- START: Back to top-->
<a href="#" class="scrollup text-center">
    <i class="icon-arrow-up"></i>
</a>
<!-- END: Back to top-->



<!-- START: Template JS-->
@include("Pannel.Admin.partials.mainjs")
<!-- END: Template JS-->

<!-- START: Page Vendor JS-->
@yield("pagejs")
<!-- END: Page Vendor JS-->



<!-- START: Toastr Error and Messages-->
@yield("toastr-msg")
<!-- END: Toastr Error and Messages-->

</body>
</html>
