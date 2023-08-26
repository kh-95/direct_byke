<!-- Name Field -->
<div class="form-group">
    {{__('models/contacts.fields.name' ) . ':'}}
    <p>{{ $contact->fullname }}</p>
</div>
<div class="form-group">
    {{__('models/contacts.fields.phone' ) . ':'}}
    <p>{{ $contact->phone }}</p>
</div>
<div class="form-group">
    {{__('models/contacts.fields.email' ) . ':'}}
    <p>{{ $contact->email }}</p>
</div>
<div class="form-group">
    {{__('models/contacts.fields.message_types' ) . ':'}}
    <p>{{ $contact->fullname }}</p>
</div>
<div class="form-group">
    {{__('models/contacts.fields.created_at' ) . ':'}}
    <p>{{ $contact->created_at }}</p>
</div>
<div class="form-group">
    {{__('models/contacts.fields.content' ) . ':'}}
    <p>{{ $contact->content}}</p>
</div>

@if ($contact->reply)
    <div class="form-group">
        {{__('models/contacts.fields.reply' ) . ':'}}
        <p>{{ $contact->reply->reply}}</p>
    </div>
@else
    <div class="form-group">
        {{__('models/contacts.fields.reply' ) . ':'}}
        {!! Form::open(['route' => 'contact_replies.store']) !!}
        {!! Form::hidden('contact_id', $contact->id) !!}
        {!! Form::textarea('reply', null, ['class' => 'form-control']) !!}
        {!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>

@endif
