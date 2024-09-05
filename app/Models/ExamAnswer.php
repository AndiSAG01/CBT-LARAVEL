<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamAnswer extends Model
{
    use HasFactory;

    protected $table = 'exam_answers';

    protected $fillable = [
        'student_id',
        'ujian_id',
        'soal_id',
        'answer',
        'status'
    ];

    public function student():BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function ujian():BelongsTo
    {
        return $this->belongsTo(Ujian::class,'ujian_id');
    }

    public function soal():BelongsTo
    {
        return $this->belongsTo(Soal::class);
    }

    // public function ujians():HasMany
    
    // {
    //     return $this->hasMany(Ujian::class);
    // }
}
