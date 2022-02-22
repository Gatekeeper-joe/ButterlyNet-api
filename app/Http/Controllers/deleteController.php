<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Handoff;
use Log;

class deleteController extends Controller
{
    public function execute(Request $request, Handoff $handoff)
    {
        $gid = $request->deleteItem['group_id'];
        $id = $request->deleteItem['id'];
        $handoff->deleteRecord($gid, $id);
    }
}
