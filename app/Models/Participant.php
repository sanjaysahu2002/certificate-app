<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['certificate_id', 'name', 'email', 'mobile'];
}
