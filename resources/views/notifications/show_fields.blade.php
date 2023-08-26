<!-- Name Field -->
@foreach (config('app.available_locales') as $l)
    <div class="form-group">
        {{__('models/notifications.fields.title_' . $l ) . ':'}}
        <p>{{ $notification['title_'.$l] }}</p>
    </div>
    <div class="form-group">
        {{__('models/notifications.fields.content_' . $l ) . ':'}}
        <p>{{ $notification['content_'.$l] }}</p>
    </div>
@endforeach

<!-- precentage Field -->
<div class="form-group">
    {{__('models/notifications.fields.send_to') . ':'}}
    <p>{{ $notification->sender_type}}</p>
</div>











