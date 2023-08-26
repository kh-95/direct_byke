<?php

namespace App\Helpers;


class helper
{

    function sendSMS($mobile, $msg)
    {

        $curl = curl_init();
        $app_id = "TXwyukfJKDZAwrYQFq4ishincoH7gu4p5hVd4eg3";
        $app_sec = "gI7a7cso5fnd4ct41e0kD9VSTg7HbikuARojcfaU2GzTy5hFnvbUrb5tbTIHnBzvsebjYgrNcAZ3oIEy5Z7bcQVGe08Z9toV35f1";
        $app_hash = base64_encode("$app_id:$app_sec");
        $messages = [];
        $messages["messages"] = [];
        $messages["messages"][0]["text"] = $msg;
        $messages["messages"][0]["numbers"][] = $mobile;
        $messages["messages"][0]["sender"] = "";

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api-sms.4jawaly.com/api/v1/account/area/sms/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($messages),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Basic ' . $app_hash
            ),
        ));

        $response = curl_exec($curl);

        $error = '';
        if (!$response) {
            $error = 'ERROR Sending SMS!';
        }

      curl_close($curl);
    }

}

   