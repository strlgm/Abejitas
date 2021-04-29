<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table ='pais';
	protected $primaryKey = 'id';
    protected $fillable= ['id','paisnombre'];
	public $timestamps= false;

    public function hoteles(){
        return $this->hasMany(hoteles::class,'idpais','idhotel');
    }

}
