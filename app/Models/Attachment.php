<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'file_name',
    'file_size',
    'file_path',
    'file_mime',
    'disk',
    'attachable_type',
    'attachable_id'
])]
class Attachment extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;
}
