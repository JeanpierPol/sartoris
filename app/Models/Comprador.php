<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Comprador extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $guard = "comprador";
    protected $table = 'compradores';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'nickname',
        'fecha_nac',
        'google_id',
        'provincia',
        'direccion',
        'telefono',
        'email',
        'imagen',
        'password',
        'total_ventas',
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


    
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function setPasswordAttribute(string $password){
        $this->attributes['password'] = bcrypt($password);

    }
    
    public function hasProfilePicture(): bool {
        return !is_null($this->attributes['imagen']) 
        && !empty($this->attributes['imagen']);
    }

    
    public function detalleTransacciones()
    {
        return $this->hasMany(DetalleTransaccion::class);
    }

}
