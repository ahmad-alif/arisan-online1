<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekSetoran extends Model
{
    use HasFactory;
    protected $table = 'cek_setoran';
    protected $guarded = [];

    public function arisan()
    {
        return $this->belongsTo(Arisan::class, 'uuid', 'uuid');
    }

    public function memberArisan()
    {
        return $this->belongsTo(MemberArisan::class, 'id_member', 'id');
    }
}
