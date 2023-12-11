<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberArisan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function arisan()
    {
        return $this->belongsTo(Arisan::class, 'id_arisan', 'id_arisan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function cekSetoran()
    {
        return $this->hasOne(CekSetoran::class, 'id', 'id_member');
    }
}
