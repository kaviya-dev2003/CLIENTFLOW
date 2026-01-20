<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'client_id', 'status', 'deadline', 'budget'];
    public function client() { return $this->belongsTo(Client::class); }
}
