<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soals';

    protected $fillable =[
        'code',
        'kategori_id',
        'user_id',
        'soal_ujian',
        'kunci_A',
        'kunci_B',
        'kunci_C',
        'kunci_D',
        'kunci_E',
        'kunci_jawaban'
    ];

    public function kategori():BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }
    public function exams():HasMany
    {
        return $this->hasMany(ExamAnswer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
}
