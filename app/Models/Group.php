<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Log;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['group_name', 'password'];

    public function create($gname, $pwd)
    {
        $hashedPwd = Hash::make($pwd);
        $this->fill(['group_name' => $gname, 'password' => $hashedPwd]);
        $this->save();
        return;
    }
}
