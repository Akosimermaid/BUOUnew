<?php

namespace App\Models;

//use Filament\Models\Contracts\FilamentUser;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use JeffGreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;


class User extends Authenticatable //implements FilamentUser //MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable,TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
    ];
/*
    public function canAccessFilament(): bool{

       return str_ends_with($this->email, '@gmail.com');
    } */
}
