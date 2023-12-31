<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'username',
    //     'email',
    //     'password',
    //     'nohp',
    //     'role',
    //     'active',
    // ];
    protected $guarded = [];

    public $timestamps = true;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

    public function memberArisans()
    {
        return $this->hasMany(MemberArisan::class, 'id_user', 'id');
    }

    public function arisans()
    {
        return $this->belongsToMany(Arisan::class, 'member_arisans', 'id_user', 'id_arisan')->withTimestamps();
    }
    public function arisans_owner()
    {
        return $this->hasMany(Arisan::class, 'id_user', 'id');
    }

    public function joinedArisans()
    {
        return $this->belongsToMany(Arisan::class, 'member_arisans', 'id_user', 'id_arisan')->withTimestamps();
    }

    // public function getTotalArisan()
    // {
    //     return $this->arisans()->count();
    // }

    // public function getTotalMember()
    // {
    //     return DB::table('member_arisans')
    //         ->join('arisans', 'member_arisans.id_arisan', '=', 'arisans.id_arisan')
    //         ->where('arisans.id_user', $this->id)
    //         ->count();
    // }
}
