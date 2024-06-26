<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'region_id'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
