<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
        'username'
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

    public function posts(){
        //eSTA ES LA RELACION ONE TO MANY
        return $this->hasMany(Post::class);  
        //En el caso de que no se sigan las convenciones se pasa la llave foranea
       // Return  $this->hasMany(Post::class,'id_autor');
    } 
    public function likes(){
        return $this->hasMany(Like::class);  
    }
    //Para almacenar los seguidores
    public function followers(){
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }
    //Para almacenar los seguidos
    public function followingUser(){
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }
    //Para saber si un seguidor sigue a otro
    public function following(User $user){

        return $this->followers->contains($user->id);
    }
}
