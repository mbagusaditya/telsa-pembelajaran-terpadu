<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'score',
    'feedback',
    'teacher_id',
    'submission_id',
])]
class SubmissionGrade extends Model
{
    /** @use HasFactory<\Database\Factories\SubmissionGradeFactory> */
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
}
