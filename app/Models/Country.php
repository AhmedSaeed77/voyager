<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $fillable = ['name','membership_number'];

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function cities()
    {
        return $this->hasManyThrough(City::class, State::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user)
        {
            $user->membership_number = self::generateMembershipNumber();
        });
    }

    protected static function generateMembershipNumber()
    {
        $lastMembershipNumber = self::max('membership_number');
        if ($lastMembershipNumber === null)
        {
            return 1000;
        }
        else
        {
            return $lastMembershipNumber + 1;
        }
    }

    public function parent()
    {
        return $this->belongsTo(Country::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Country::class, 'parent_id');
    }
}
