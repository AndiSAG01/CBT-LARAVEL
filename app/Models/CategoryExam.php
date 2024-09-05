<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryExam extends Model
{
    use HasFactory;

    protected $table = "category_exams";

    protected $fillable = [
        'name','user_id'
    ];

    public function ujian():HasMany
    {
        return $this->hasMany(Ujian::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
