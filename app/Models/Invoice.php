<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'invoice';

    // public function arisan()
    // {
    //     return $this->belongsTo(Arisan::class, 'id_arisan', 'id_arisan');
    // }
    public function arisan()
    {
        return $this->belongsTo(Arisan::class, 'uuid', 'uuid');
    }
    public function setoran()
    {
        return $this->belongsTo(Setoran::class, 'invoice_number', 'invoice_number');
    }
}
