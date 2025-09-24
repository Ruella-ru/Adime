<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jenis_id',
        'title', 
        'meta_desc',
        'slug',
        'description',
        'image',
        'price',
        'discount',
        'sku',
        'stock',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relasi Many-to-One dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Many-to-One dengan Category
    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function getFinalPriceAttribute()
{
    if ($this->discount) {
        // Jika diskon persen
        return $this->price - ($this->price * $this->discount / 100);

        // Kalau Anda lebih suka diskon nominal (potong langsung),
        // ganti dengan baris ini:
        // return $this->price - $this->discount;
    }

    return $this->price;
}

}
