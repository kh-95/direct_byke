@foreach (config('app.available_locales') as $l)
    <?php
    $error = 'content_' . $l . '_error'
    ?>
    <div class="form-group col-sm-12 col-lg-12">
        {!! Form::label('content_' . $l , __('models/termsConditions.fields.content_' . $l ).':') !!}
        {!! Form::textarea('content_' . $l , null,
            ['class' => 'form-control width-100'
            ,  'rows' => 10, 'cols' => 50,
             'style'=>"height: 137px;",
             'id'=>'content_'.$l
            ]
      ) !!}

        <span style="color:red;" id={{$error}}></span>
    </div>
@endforeach




    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    </div>



@section('scripts')
    <script>
        $(document).ready(function () {
            onlyForLanguage('#content_ar', 'ar', 'برجاء الكتابة باللغة العربية فقط');
            onlyForLanguage('#content_en', 'en', 'Only English, Please.');
        });
    </script>
@endsection
