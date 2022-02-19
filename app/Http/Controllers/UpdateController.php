<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Handoff;
use Log;

class UpdateController extends Controller
{
    public function updateFlag(Request $request, Site $site)
    {
        $data = $request->all();
        $uid = $data['targetData']['uid'];
        $host = $data['targetData']['host'];

        $site->updateFlag($uid, $host);
    }

    public function save(Request $request, Handoff $handoff)
    {
        $data = $request->all();
        $record = $handoff->saveData($data);
        return $record;
    }
}
