<?php

namespace App\Helpers;


use App\Models\GeneralSetting;

class Setting
{

    public function setting()
    {
        return GeneralSetting::first();
    }


}

