<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
class Form extends Model
{
    use Sluggable,SoftDeletes;
    protected $fillable = ['name'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    /**
     * Get the fields for the form.
     */
    public function fields()
    {
        return $this->hasMany(FormField::class);
    }
}
