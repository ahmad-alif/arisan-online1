<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arisan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id_arisan';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'member_arisans', 'id_arisan', 'id_user')->withTimestamps();
    }

    public function memberArisans()
    {
        return $this->hasMany(MemberArisan::class, 'id_arisan', 'id_arisan');
    }
}
