<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\CommunityLinkUser;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function isTrusted()
    {
        return $this->trusted;
    }

    public function votes()
    {
        // Para acceder a los links que ha votado un usuario, hay que especificarle la clase (CommunityLink) y el nombre de la tabla pivot donde tiene que buscar
        return $this->belongsToMany(CommunityLink::class, 'community_link_users')->withTimestamps();
    }

    /**
     * Checks whether the user has voted on a link
     * @param CommunityLink $link
     * @return bool
     */
    public function votedFor(CommunityLink $link)
    {
        return $this->votes->contains($link);
    }
}
