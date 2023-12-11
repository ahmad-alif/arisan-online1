<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Arisan extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $fillable = ['winner_drawn'];
    protected $primaryKey = 'id_arisan';

    // public function setWinnerDrawnAttribute($value)
    // {
    //     $this->attributes['winner_drawn'] = $value ? 1 : 0;
    // }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

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

    public function winners()
    {
        return $this->hasMany(WinnerArisan::class, 'id_arisan');
    }

    public function isUserJoined($user)
    {
        return $this->members()->where('id_user', $user->id)->exists();
    }

    public function cekSetoran()
    {
        return $this->hasMany(CekSetoran::class, 'uuid', 'uuid');
    }


    // public function invoices()
    // {
    //     return $this->hasMany(Invoice::class, 'id_arisan', 'id_arisan');
    // }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'uuid', 'uuid');
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class, 'uuid', 'uuid');
    }
}
