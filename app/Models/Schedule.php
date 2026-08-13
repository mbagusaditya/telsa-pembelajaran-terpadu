<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'place',
    'started_at',
    'finished_at',
    'day',
    'course_offering_id',
    'created_by'
])]
class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    public function creator():BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function courseOffering():BelongsTo
    {
        return $this->belongsTo(CourseOffering::class, 'course_offering_id');
    }
}
