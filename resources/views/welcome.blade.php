<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{--  <meta name="viewport" content="width=device-width, initial-scale=1">  --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ trans('crud.' .config('app.name')) }}</title>
    <link href="assets/web-asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/web-asset/css/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/web-asset/css/nice-select.css" />
	<link rel="stylesheet" href="assets/web-asset/css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="assets/web-asset/css/style.css">
    <link rel="stylesheet" href="assets/web-asset/css/menu-style.css" />

</head>
<body>

    <div id="app">

    </div>
    <!-- scripts -->
	<script src="assets/web-asset/js/jquery-3.6.0.js"></script>
	<script src="assets/web-asset/js/popper.min.js"></script>
    <script src="assets/web-asset/js/bootstrap.min.js"></script>
	<script src="assets/web-asset/js/bootstrap.bundle.min.js"></script>
	<script src="assets/web-asset/js/jquery.nice-select.js"></script>
	<script src="assets/web-asset/js/jquery-ui.js"></script>
    <script
	type="text/javascript"
	src="https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyCmT97qMPjKdidWGuTUr8c9KC2l4sVUcNs"
  ></script>
  <script src="./assets/web-asset/js/locationpicker.jquery.min.js"></script>
  <script src="{{asset('public/js/app.js') }}"></script>

    <script src="assets/web-asset/js/auth.js"></script>

    <script>



        </script>
</body>
</html>
