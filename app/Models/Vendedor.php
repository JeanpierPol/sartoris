<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Vendedor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = "vendedor";
    protected $table = 'vendedores';


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
        'provincia',
        'direccion',
        'telefono',
        'email',
        'imagen',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasProfilePicture(): bool {
        return !is_null($this->attributes['imagen']) 
        && !empty($this->attributes['imagen']);
    }

    public function getProfilePictureAttribute() {
        return url('usuarios/vendedor/' . $this->attributes['imagen']);
    }


    
    public function setPasswordAttribute(string $password){
        $this->attributes['password'] = bcrypt($password);

    }

    public function productos(){
        return $this->hasMany(Producto::class, 'vendedor_id');
    }

}
