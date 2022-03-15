<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Handoff;
use Carbon\Carbon;
use Log;

class GetController extends Controller
{
    public function getUpdated(Request $request, Site $site)
    {
        $uid = $request->uid;
        $updated_page_data = $site->where('user_id', $uid)->where('update_flag', 1)->get(['host', 'url', 'last_updated_at']);
        return $updated_page_data;
    }

    public function toObject($array)
    {
        $obj = new \stdClass;
        foreach ($array as $k => $v) {
            $obj->{$k} = $v;
        }

        return $obj;
    }

    public function getRecord(Handoff $handoff)
    {
        $records = $handoff->all();
        return $records;
    }
}
