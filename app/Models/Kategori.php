<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class 
Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $fillable = ['name','user_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function soal():HasMany
    {
        return $this->hasMany(Soal::class);
    }
    public function ujian():HasMany
    {
        return $this->hasMany(Ujian::class);
    }
}
