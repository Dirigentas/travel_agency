<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    // sita funkcija reikalinga, kad Laravelyje suristi dvi lenteles. Kreipdamasis i Order, galesiu naudoti 'users' lentele
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
