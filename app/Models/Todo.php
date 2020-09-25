<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Todo extends Model
{
    use Notifiable;
    protected $fillable=[
        "title","content","done"
    ];


    public function user(){
        return $this->belongsTo(User::class,"createdBy_id");
    }
    /**
     * Get User affected to this todo
     */

    public function todoAffectedTo(){
        return $this->belongsTo(User::class,"affectedTo_id");
    }

    /**
     * Get User who has affected to this todo
     */
    public function todoAffectedBy(){
        return $this->belongsTo(User::class,"affectedBy_id");
    }
}
