<div class="hhhh table-responsive">
    <table class="table" id="whouses-table">
        <thead>
            <tr>
                <th>@lang('models/whouses.fields.content_ar')</th>
        <th>@lang('models/whouses.fields.content_en')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($whouses as $whoUs)
            <tr>
                       <td>{{ $whoUs->content_ar }}</td>
            <td>{{ $whoUs->content_en }}</td>
                       <td class=" text-center">
                           {!! Form::open(['route' => ['whouses.destroy', $whoUs->id], 'method' => 'delete']) !!}
                           <div class='btn-group'>
                               <a href="{!! route('whouses.show', [$whoUs->id]) !!}" class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
                               <a href="{!! route('whouses.edit', [$whoUs->id]) !!}" class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
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
