<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public $timestamps = false; // jei kuriame su 'new Laravel' ir istrinam migration timestamps, tai reikia sios eilutes

}
