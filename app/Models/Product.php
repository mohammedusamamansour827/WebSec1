<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model  {

	protected $fillable = [
        'code',
        'name',
        'price',
        'model',
        'description',
        'photo'
    ];

    public function purchases()
{
    return $this->hasMany(\App\Models\Purchase::class);
}

public function buyers()
{
    return $this->belongsToMany(User::class)->withTimestamps();
}

}
