<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tracks extends Model
{

    protected $guarded = [];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'store_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
