<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'last_name', 'dni', 'email', 'address', 'region_id', 'commune_id', 'status'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
    
}
