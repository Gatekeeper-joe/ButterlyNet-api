<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Handoff;

class GetController extends Controller
{
    public function getUpdated(Site $site)
    {
        $updated_page_data = $site->where('update_flag', 1)->get(['host', 'url', 'last_updated_at']);
        return $updated_page_data;
    }

    public function getRecord(Handoff $handoff)
    {
        $records = $handoff->all();
    }
}
