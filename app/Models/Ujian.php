<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ujian extends Model
{
    use HasFactory;

    protected $table = 'ujians';
    protected $fillable = [
        'kelas',
        'tanggal_ujian',
        'jam_ujian',
        'category_id',
        'kategori_id',
        'user_id',
        'siswa_id',
        'durasi',
        'status',
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(CategoryExam::class);
    }
    public function siswa():BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
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
