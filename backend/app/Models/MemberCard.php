<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberCard extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'title', 'age', 'email', 'mobile_number', 'status', 'order'];
    public function getStatusAttribute($value)
    {
        return ucwords(str_replace('_', ' ', $value));
    }


    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower(str_replace(' ', '_', $value));
    }

}
