<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\TryCatch;

class Site extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'host', 'url'];

    public function saveNow($obj)
    {
        $now = date("Y-m-d H:i:s");
        Site::where('user_id', $obj->user_id)->where('host', $obj->host)->update(['update_flag' => 1, 'last_updated_at' => $now]);
    }

    public function updateFlag($uid, $host)
    {
        try {
            $this->where('user_id', $uid)->where('host', $host)->update(['update_flag' => 0]);
            return;
        } catch (\Throwable $th) {
            return;
        }
    }
}
