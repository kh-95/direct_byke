@component('mail::message')
Dear {{$email}},
Thank you for Contacting us.
Here is the reply from our team.
{{$reply}}
Thanks,<br>
{{ config('app.name') }}
@endcomponent
