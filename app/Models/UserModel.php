<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserModel extends Authenticatable
{
    protected $table = 'tb_employees';

    protected $fillable = [
        'nik',
        'name',
        'password',
        'level_id',
        'address',
        'phone',
        'remember_token',
        'ip_address',
        'login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function identity(string $nik): ?self
    {
        return self::with('level')
            ->where('nik', $nik)
            ->first();
    }

    public static function set_token(string $nik, string $token, string $ip_address): bool
    {
        $user = self::where('nik', $nik)->first();

        if (!$user)
        {
            return false;
        }

        $user->update([
            'remember_token' => $token,
            'ip_address'     => $ip_address,
            'login_at'       => Carbon::now(),
        ]);

        return true;
    }

    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getAuthIdentifierName(): string
    {
        return 'nik';
    }

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id');
    }
}
