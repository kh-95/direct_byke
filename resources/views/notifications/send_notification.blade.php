@extends('layouts.app')
@section('title')
    @lang('validation.notification_sended')
@endsection
@section('content')
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css"/>

    @inject('client','App\Models\User')
    
    <?php
    $clients = $client->where('is_active', 1)->get();
    ?>

    <style>
        .dropdown-menu .open .show {
            /*position: absolute;*/
            top: auto;
        }
    </style>

    <section class="section">
        <div class="section-header">

            <h1>   @lang('validation.notification_sended') </h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'notification.sendNotification']) !!}
                    @if(count($errors))
                        <div class="form-group">
                            <div class="alert alert-danger" style="color: #fff" width="50%">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        {!! Form::label('category', __('validation.send_to').':') !!}

                        <div class="form-group col-sm-12" style="font-size: large">

                           

                            <input type="radio" name="sender" value="clients"
                                   class="notify_check"> {{trans('validation.clients')}}
                            <br>



                            <input type="radio" name="sender"
                                   value="client"
                                   class="notify_check"> {{trans('عملاء مخصصين')}}
                            <br>
                            <div class="participate-part">
                                <div class="col-md-12">
                                    <div class="col-lg-8 col-xs-7">
                                        <select name="clients[]" id="status"
                                                class="form-control selectpicker"
                                                data-size="5" multiple
                                                data-show-subtext="true" data-live-search="true"

                                                class="select2-multiple form-control" name="category_id[]"
                                                multiple="multiple">
                                            <option value="">{{trans('trans.choose')}} ...</option>
                                            @php
                                                $client_type_ =  'CLI';
                                            @endphp
                                            @foreach($clients as $client)
                                                <option
                                                    data-subtext="{{$client_type_.$client->id.' => '.$client->phone}}"
                                                    value="{{$client->id}}">
                                                    {{$client->fullname}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">


                        @foreach (config('app.available_locales') as $l)
                                <?php
                                $error = 'title_' . $l . '_error'
                                ?>
                            <div class="form-group col-sm-6">
                                {!! Form::label('title_' . $l , __('models/sliders.fields.title_' . $l ).':') !!}
                                {!! Form::text('title_' . $l, null, ['class' => 'form-control','id'=>'title_'.$l ,
                                'placeholder'=>__('models/sliders.fields.title_' . $l )]) !!}
                                <span style="color:red;" id={{$error}}></span>
                            </div>
                        @endforeach



                        @foreach (config('app.available_locales') as $l)
                                <?php
                                $error = 'content_' . $l . '_error';
                                $name = 'content_' . $l;
                                ?>
                            <div class="form-group col-sm-6">
                                <h4>{!! Form::label('content_' . $l , __('validation.notification_content_in_' . $l) .':') !!}</h4>
                                <textarea name="{{$name}}" class="form-control" rows="3"
                                          style="height: 137px;" id="{{$name}}"
                                          placeholder="@lang('validation.notification_content_in_' . $l)"></textarea>
                                <span style="color:red;" id={{$error}}></span>
                            </div>
                        @endforeach
                    </div>


                    <!-- Submit Field -->
                    <div class="form-group row justify-content-center">
                        <div class='col-md-3'>
                            {!! Form::submit(__('crud.send'), ['class' => 'btn btn-primary save-btn w-50']) !!}
                        </div>
                        <div class='col-md-3'>
                            <a href="{{ route('notification.get-notification-sended') }}"
                               class="btn btn-light save-btn w-50">@lang('crud.cancel')</a>

                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </section>
@endsection




@section('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function () {
            onlyForLanguage('#content_ar', 'ar', 'برجاء الكتابة باللغة العربية فقط');
            onlyForLanguage('#content_en', 'en', 'Only English, Please.');
        });
    </script>

    <script>
        $(".notify_check").change(function () {
            let notify_check = $(".notify_check:checked").val();
            if (notify_check == 'client') {
                $(".participate-part").fadeIn(1000);
            } else {
                $(".participate-part").fadeOut(1000);
            }
        });
    </script>
@endsection
