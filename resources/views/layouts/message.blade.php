  {{-- Show errors --}}
  @if($errors->any())
  @foreach ($errors->all() as $error )
  <div class="alert alert-danger" role="alert">
    {{$error}}
  </div>
  @endforeach
  @endif


{{-- check for session success --}}
@if(session()->has('message'))
  <div  class="col-md-6 col-xs-12 col-sm-12  alert alert-success">
    {{session()->get('message')}}
  </div>
@endif
