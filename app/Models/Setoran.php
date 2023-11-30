<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;
    protected $table = 'setoran';
    protected $guarded = [];

    public function getSetoranForMember($memberId)
    {
        return $this->where('id_member', $memberId)->value('setoran');
    }

    // public function arisan()
    // {
    //     return $this->belongsTo(Arisan::class, 'id_arisan', 'id_arisan');
    // }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_number', 'invoice_number');
    }

    public function arisan()
    {
        return $this->belongsTo(Arisan::class, 'id_arisan');
    }
}
