<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'notes',
    'attempt_number',
    'student_id',
    'assignment_id',
    'submitted_at'
])]
class Submission extends Model
{
    /** @use HasFactory<\Database\Factories\SubmissionFactory> */
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    public function student():BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function assignment():BelongsTo
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
}
