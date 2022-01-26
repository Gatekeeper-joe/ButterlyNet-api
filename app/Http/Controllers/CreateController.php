<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class CreateController extends Controller
{
    public function execute($goutte, $obj, $path)
    {

        $parts = [
            $uid = $obj->user_id,
            $host = $obj->host
        ];

        $date = strval(date('YmdHis'));
        $file_name_part = implode('_', $parts);
        $file = $file_name_part . '_' . $date . '.html';
        $full_path = $path . '\\' . $file;

        //ファイルの更新確認が取れたら消す。下のfile_put_contentsも。
        $a = $path . '\child\\' . $file;
        $fp = $a;

        // $goutte->filter('a')->each(function ($a) use ($full_path, $fp) {
        //     $a->filter('span')->each(function ($span) use ($full_path, $fp) {
        //         $html = $span->html();
        //         file_put_contents($full_path, $html, FILE_APPEND);
        //         file_put_contents($fp, $html, FILE_APPEND);
        //     });
        // });

        $goutte->filter('a')->each(
            function ($a) use ($full_path, $fp) {
                $html = $a->html();
                file_put_contents($full_path, $html, FILE_APPEND);
                file_put_contents($fp, $html, FILE_APPEND);
            }
        );

        return $file_name_part;
    }
}
