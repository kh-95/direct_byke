<div class="hhhh table-responsive">
    <table class="table" id="contactuses-table">
        <thead>
            <tr>
                <th>@lang('models/contactuses.fields.phone_number')</th>
        <th>@lang('models/contactuses.fields.snapshat')</th>
        <th>@lang('models/contactuses.fields.youtube')</th>
        <th>@lang('models/contactuses.fields.instagram')</th>
        <th>@lang('models/contactuses.fields.whatsapp')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($contactuses as $contactUs)
            <tr>
                       <td>{{ $contactUs->phone_number }}</td>
            <td>{{ $contactUs->snapshat }}</td>
            <td>{{ $contactUs->youtube }}</td>
            <td>{{ $contactUs->instagram }}</td>
            <td>{{ $contactUs->whatsapp }}</td>
                       <td class=" text-center">
                           {!! Form::open(['route' => ['contactuses.destroy', $contactUs->id], 'method' => 'delete']) !!}
                           <div class='btn-group'>
                               <a href="{!! route('contactuses.show', [$contactUs->id]) !!}" class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
                               <a href="{!! route('contactuses.edit', [$contactUs->id]) !!}" class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
                               {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger action-btn delete-btn', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                           </div>
                           {!! Form::close() !!}
                       </td>
                   </tr>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
