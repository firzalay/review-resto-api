<?php

namespace App\Models;

use App\Models\User;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resto extends Model
{
    use HasFactory;

    protected $guarded = [
       'id'
    ];

     /**
     * Get all of the reviews for the Resto
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
