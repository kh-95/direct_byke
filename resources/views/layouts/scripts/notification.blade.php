<div class="modal inmodal" id="note_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span
                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">ارسال اشعار </h4>
                <h4 class="modal-title" id="client_name"></h4>
            </div>


            <form action="{{route('send-notification')}}" method="post" enctype="multipart/form-data"
                  class="form-horizontal">
                @csrf
                <div class="modal-body">

                    <input type="hidden" name="client_id" id="client_id" value="">
                    <input type="hidden" name="note_type" id="note_type" value="">
                    <input type="hidden" name="note_id" id="note_id" value="">
                    <div class="form-group mg-bottom-5">
                        <div class="col-md-4">
                            <label for=""> نص الاشعار :</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="text" name="note_content" id="content" required
                                   value="{{old('content')}}">
                            @if ($errors->has('content'))
                                <div class="error">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-white" data-dismiss="modal">إغلاق</a>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).on('click', '.send-note' , function (){
        let client_id = $(this).data('client_id');
        $('#client_id').val(client_id);
        let client_name = $(this).data('client_name');
        $('#client_name').text(client_name);
        let note_type = $(this).data('note_type');

        $('#note_type').val(note_type);
        let note_id = $(this).data('note_id');
        $('#note_id').val(note_id);
    });
</script>


