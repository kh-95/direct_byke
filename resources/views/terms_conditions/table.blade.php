<div class="hhhh table-responsive">
    <table class="table" id="termsConditions-table">
        <thead>
            <tr>
                <th>@lang('models/termsConditions.fields.content_ar')</th>
        <th>@lang('models/termsConditions.fields.content_en')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
        @foreach($termsConditions as $termsConditions)
            <tr>
                       <td>{{ $termsConditions->content_ar }}</td>
            <td>{{ $termsConditions->content_en }}</td>
                       <td class=" text-center">
                           {!! Form::open(['route' => ['termsConditions.destroy', $termsConditions->id], 'method' => 'delete']) !!}
                           <div class='btn-group'>
                               <a href="{!! route('termsConditions.show', [$termsConditions->id]) !!}" class='btn btn-light action-btn '><i class="fa fa-eye"></i></a>
                               <a href="{!! route('termsConditions.edit', [$termsConditions->id]) !!}" class='btn btn-warning action-btn edit-btn'><i class="fa fa-edit"></i></a>
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
