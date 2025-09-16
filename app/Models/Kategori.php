<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public function kategoris() {
        return $this->belongsToMany(Kategori::class, 'kategori_master_item');
    }
    
    protected $fillable = [
        'kode',
        'nama',
    ];

    public function masterItems() {
        return $this->belongsToMany(MasterItem::class, 'kategori_master_item');
    }
}
