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
        $status = $data['editedItem']['status'];
        if (empty($status)) {
            $gid = $data['editedItem']['group_id'];
            $subject = $data['editedItem']['subject'];
            $body = $data['editedItem']['body'];
            $status = 'Open';
            $this->fill(['group_id' => $gid, 'subject' => $subject, 'body' => $body, 'status' => $status]);
            $this->save();

            return;
        } else {
            $id = $data['editedItem']['id'];
            $subject = $data['editedItem']['subject'];
            $body = $data['editedItem']['body'];
            $status = $data['editedItem']['status'];

            $this->where('id', $id)->update(['subject' => $subject, 'body' => $body, 'status' => $status]);
            return;
        }
    }

    public function get($gid)
    {
        return $this->where('group_id', $gid)->get();
    }

    public function deleteRecord($id)
    {
        $this->destroy($id);
        return;
    }
}
