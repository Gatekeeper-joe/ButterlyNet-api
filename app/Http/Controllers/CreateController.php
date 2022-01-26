<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class CreateController extends Controller
{
    public function execute($client, $obj, $path)
    {

        $parts = [
            $uid = $obj->user_id,
            $host = $obj->host
        ];

        $date = strval(date('YmdHis'));
        $file_name_part = implode('_', $parts);
        $file = $file_name_part . '_' . $date . '.html';
        $full_path = $path . '\\' . $file;

        $client->filter('a')->each(
            function ($a) use ($full_path) {
                $html = $a->html();
                file_put_contents($full_path, $html, FILE_APPEND);
            }
        );

        return $file_name_part;
    }
}
