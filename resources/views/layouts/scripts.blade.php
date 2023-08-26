{{--<script src="{{asset('js/app.js')}}"></script>--}}
<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/metisMenu/jquery.metisMenu.js')}}"></script>
<script src="{{asset('assets/js/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/js/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/js/axios/axios.js')}}"></script>
<script src="{{asset('assets/js/jasny/jasny-bootstrap.min.js')}}"></script>


{{--<script src="{{asset('assets/js/axios/axios.js')}}"></script>--}}


<script src="{{asset('assets/js/plugins.js')}}"></script>
<script src="{{asset('assets/js/inspinia.js')}}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>





<script>
    $('.input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });
</script>


<script>
    $(document).on("keydown", "form", function (event) {
        return event.key != "Enter";
    });
</script>

@include('layouts.scripts.delete')
{{--@include('layouts.scripts.plugins')--}}
@stack('print')
@stack('scripts')
