<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'student_id',
    'class_group_id',
    'joined_at',
    'left_at'
])]
class StudentClassGroup extends Model
{
    /** @use HasFactory<\Database\Factories\StudentClassGroupFactory> */
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;
}
