<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public $timestamps = false; // jei kuriame su 'new Laravel' ir istrinam migration timestamps, tai reikia sios eilutes

    public function deletePhoto()
    {
        if($this->photo){
            $fileName = $this->photo;
            unlink(public_path().$fileName);
            $this->photo = null;
            $this->save();
        }
    }

    const SORT = [
        'asc_price' => 'Kaina nuo žemiausios',
        'desc_price' => 'Kaina nuo didžiausios',
    ];

}
