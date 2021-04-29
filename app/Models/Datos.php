<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    protected $table ='datos';
	protected $primaryKey = 'iddatos';
    protected $fillable= ['iddatos','temperatura','humedad','hotel_idhotel','id_users'];

    public function hoteles(){
        return $this->belongTo(hoteles::class);
    }
	
}
