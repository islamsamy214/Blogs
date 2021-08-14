<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSettingRequest;

class SettingController extends Controller
{

    public function retreve()
    {
        return Setting::first();
    } //end of retreve


    public function update(StoreSettingRequest $request)
    {
        $request->validated();
        Setting::first()->update($request->all());
    } // end of update

}
