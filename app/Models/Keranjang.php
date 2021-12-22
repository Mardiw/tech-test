<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produk;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'tbl_keranjang';
    protected $fillable = [
        'qty',
        'status_checkout',
        'id_produk',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
