<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * Cast the options attribute to an array.
     */
    protected $casts = [
        'options' => 'array',
    ];
}
