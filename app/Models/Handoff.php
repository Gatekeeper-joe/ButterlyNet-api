<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Log;

class Handoff extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'subject', 'body', 'status', 'responder', 'updater'];

    //This is named saveData because of duplicating with Model::save().
    public function saveData($data)
    {
        $key = array_keys($data);
        if ($key[0] === 'newItem') {
            $gid = $data['newItem']['group_id'];
            $subject = $data['newItem']['subject'];
            $body = $data['newItem']['body'];

            $this->fill(['group_id' => $gid, 'subject' => $subject, 'body' => $body]);
            $this->save();

            $record = $this->where('group_id', $gid)->get();
            return $record;
        } elseif ($key[0] === 'obj') {
            $gid = $data['obj']['gid'];
            $id = $data['obj']['id'];
            $subject = $data['obj']['subject'];
            $status = $data['obj']['status'];

            $this->where('id', $id)->update(['subject' => $subject, 'status' => $status]);
            $records = $this->where('group_id', $gid)->get();
            return $records;
        }
    }

    public function get($gid)
    {
        return $this->where('group_id', $gid)->get();
    }

    public function deleteRecord($gid, $id)
    {
        Log::info($id);
        $this->destroy($id);
        $records = $this->where('group_id', $gid)->get();

        return $records;
    }
}
