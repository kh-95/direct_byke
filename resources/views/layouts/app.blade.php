<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title') | {{ trans('crud.' .config('app.name')) }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>

{{--    <link href="{{asset('inspina/css/plugins/iCheck/custom.css')}}" rel="stylesheet')}}">--}}

{{--    <link href="{{asset('inspina/css/animate.css')}}" rel="stylesheet">--}}

{{--    <link href="{{asset('web/css/plugins/steps/jquery.steps.css')}}" rel="stylesheet">--}}

{{--    <link href="{{asset('web/css/css/style-new.css')}}" rel="stylesheet">--}}

@yield('page_css')
<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/components.css')}}">

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('web/css/rtl.css') }}">
    @endif

    @yield('page_css')

    @yield('css')
</head>
<body>

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('layouts.header')

        </nav>
        <div class="main-sidebar main-sidebar-postion">
            @include('layouts.sidebar')
        </div>
        <!-- Main Content -->
        <div class="main-content">



            @yield('content')
        </div>
        <footer class="main-footer">
            @include('layouts.footer')
        </footer>
    </div>
</div>

@include('profile.change_password')
@include('profile.edit_profile')

</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
{{--<script src="{{asset('web/js/plugins/steps/jquery.steps.min.js')}}"></script>--}}
{{--<script src="{{asset('web/js/plugins/validate/jquery.validate.min.js')}}"></script>--}}

@yield('page_js')
@yield('scripts')
<script>
    let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
    let loginUrl = '{{ route('login') }}';
    const userUrl = '{{url('users')}}';
    // Loading button plugin (removed from BS4)
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };

        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);

    }(jQuery));
</script>


<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#edit_preview_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#pfImage").change(function () {
        readURL(this);
    });
</script>

<script>
    $("form").submit(function () {
        $(":submit", this).attr("disabled", "disabled");
    });
</script>


<script type="text/javascript">

    function onlyForLanguage($fieldId, $lang = "ar", $msg = '') {
        $(`${$fieldId}_error`).html('');

        if ($lang == 'ar') {
            // Arabic characters fall in the Unicode range 0600 - 06FF
            // var charRange = /[\u0600-\u06FF]/;
            // var charRange = /^[\u0621-\u064A0-9 ]+$/;
            var charRange = /^[_\-!%^&*=;:?><+|\u0621-\u064A0-9 ]+$/;
            // var charRange = /^[\u0621-\u064A0-9 ][^(|]~`!%^&*=};:?><’)*$/;
            // var charRange = /^[\u0621-\u064A0-9"!'\\]* ]+$/;
            // /^[0-9a-zA-Z]+$/
        } else {
            // English characters fall in the range aA - zZ
            // var charRange = /[A-Za-z]/;
            // var charRange = /^[0-9a-zA-Z]+$/u + /^[^(|]~`!%^&*=};:?><’)]*$/;
            var charRange = /^[0-9a-zA-Z_\-!%^&*=;:?><+|]+$/u;
        }

        $(document).find(`${$fieldId}`).bind("keypress", function (event) {
            var key = event.which;
            // [ 0 = numpad, 8 = backspace, 32 = space ]
            if (key == 8 || key == 0 || key === 32) {
                $(`${$fieldId}_error`).html('');
                return true;
            }
            var str = String.fromCharCode(key);
            if (charRange.test(str)) {
                $(`${$fieldId}_error`).html('');
                return true;
            }
            $(`${$fieldId}_error`).html($msg);
            return false;
        });
    }


</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#edit_preview_photo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#pfImage").change(function () {
        console.log(this , ">>>>>>")
        readURL(this);
    });
</script>

</html>
