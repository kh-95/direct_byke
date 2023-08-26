<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<style>



</style>
<div class="alert alert-success" role="alert" id="user" style="display: none"></div>

<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th class=" text-center"> {{__('models/contacts.fields.name')}}</th>
            <th class="text-center">@lang('validation.attributes.phone_number')</th>
            <th class="text-center">@lang('validation.email_')</th>
            <th class="text-center">@lang('validation.message_type')</th>
            <th class="text-center">@lang('validation.created_at')</th>
            <th class="text-center">@lang('validation.message_status')</th>





            <th class=" text-center" colspan="5">@lang('crud.action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contacts as $key => $contact)
            <tr>
                <td class=" text-center">{{ $contact->fullname }}</td>
                <td class=" text-center">{{ $contact->phone }}</td>
                <td class=" text-center">{{ $contact->email }}</td>
                <td class=" text-center">{{ $contact->message_types }}</td>
                <td class=" text-center">{{ $contact->created_at }}</td>
                <td class=" text-center">{{ $contact->message_status }}</td>
                <td class=" text-center" colspan="5">
                <div class='btn-group'>
                    @if ($contact->message_status == 'pending')
                        <div class='btn-group'>
                                <a href="{!! route('contacts.show', [$contact->id]) !!}"
                                class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
                        </div>
                    @endif
                        <div class='btn-group'>
                        <a href="{!! route('contacts.show', [$contact->id]) !!}" class='btn btn-primary action-btn '><i
                                class="fa fa-eye"></i></a>
                        </div>
                </div>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {!! $contacts->withQueryString()->links() !!}
    </div>
</div>


