<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    use HasFactory;

    public $timestamps = false; // jei kuriame su new (greiciausiai ejo kalba apie Laravel instaliacija) ir istrinam migration timestamps

    public function typeDrinks()
    {
        return $this->hasMany(Drink::class, 'type_id', 'id');
    }

}
