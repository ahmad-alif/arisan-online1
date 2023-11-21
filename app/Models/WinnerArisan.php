<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WinnerArisan extends Model
{
    use HasFactory;

    public function arisan()
    {
        return $this->belongsTo(Arisan::class, 'id_arisan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
