<style>
    #client {
        font-family: system-ui;
        width: 100%;
        overflow: hidden;
    }

    #client td, #client th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #client tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #client tr:hover {
        background-color: #ddd;
    }
</style>

<div class="section-body">
    <div class="card">
        <div class="card-body">

            <div class="hhhh table-responsive">
                <table class="table" id="client">
                    <tbody style="font-weight: bold;">
                    <tr>
                        <td>
                            {{ __('models/clients.fields.user_name') }} : &nbsp; &nbsp; &nbsp;
                            {{ optional($client)->fullname }}
                        </td>
                        <td>
                            {{ __('models/clients.fields.phone_number') }} : &nbsp; &nbsp;
                            &nbsp;
                            {{ optional($client)->phone }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            {{ __('models/clients.fields.email') }} : &nbsp; &nbsp;
                            &nbsp;
                            {{ optional($client)->email }}
                        </td>
                        <td>
                            {{ __('models/clints.fields.Number of entry times') }} : &nbsp; &nbsp;
                            &nbsp;
                            {{ optional($client)->otps()->count() }}
                        </td>
                        <td>
                            {{ __('models/clints.fields.latest_login') }} : &nbsp; &nbsp;
                            &nbsp;
                            @foreach ($client->otps as $clientotp)
                            {{ optional($clientotp->created_at) }}
    @endforeach
                            
                        </td>

                        <td>
                            {{ __('models/clints.fields.otp_status') }} : &nbsp; &nbsp;
                            &nbsp;
                            {{ optional($client)->is_send_otp }}
                        </td>
                    </tr>

                   <tr>

                      <td>
                        {{ __('models/clients.fields.image') }} : &nbsp; &nbsp;
                           &nbsp;
                         {{ optional($client)->image }}
                      </td>

                   </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
