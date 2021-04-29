<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hoteles extends Model
{
    protected $table ='hotel';
	protected $primaryKey = 'idhotel';
    protected $fillable= ['idhotel','macwifi','nombre','idpais','idusuario'];
	public $timestamps= false;

    public function User(){
       // return $this->belongsTo('App\Models\User','id','idusuario');
        return $this->belongsTo(User::class,'id','idusuario');
    }

    public function paises(){
        return $this->belongsTo(Pais::class,'idpais','id');
    }

    public function datos(){        
         return $this->hasMany(Datos::class,'hotel_idhotel');
     }

     
     

}