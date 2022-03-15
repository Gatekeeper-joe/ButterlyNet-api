<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Handoff;
use App\Models\Group;
use App\Models\User;
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

    public function save(Request $request, Handoff $handoff, User $user)
    {
        $data = $request->all();
        $handoff->saveData($data);
        return;
    }

    public function createGroup(Request $request, Group $group, User $user)
    {
        $req = $request->all();
        $gname = $req['groupInfo']['name'];
        $pwd = $req['groupInfo']['password'];

        $gid = $user->where('group_id', null)->exists();

        if ($gid) {
            return 0;
        }

        $group->create($gname, $pwd);
        return;
    }
}
