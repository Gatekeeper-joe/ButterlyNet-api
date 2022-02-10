<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
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
}
