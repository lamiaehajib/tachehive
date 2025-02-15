<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Traits\HasRoles;

class Formation extends Model
{
    use HasFactory,HasRoles,Notifiable;

    protected $fillable = ['name', 'status', 'nomformateur',  'date','file_path','statut', 
    'nombre_heures', 
    'nombre_seances', 
    'prix', 
    'duree'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'formation_user', 'formation_id', 'user_id');
    }
    public function Dashboard()
    {
        return $this->hasMany(Dashboard::class, 'idformation');
    }
}