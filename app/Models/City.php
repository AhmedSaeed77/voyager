<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class City extends Model
{
    use HasFactory,Searchable;

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function toSearchableArray()
    {
        return [
            'created_at' => $this->created_at,
            'name' => $this->name,
        ];
    }
    
}
