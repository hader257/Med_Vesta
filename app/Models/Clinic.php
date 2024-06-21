<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Clinic extends Model
{
    use HasFactory , HasTranslations ;

    protected $fillable = ['name' , 'price','address' , 'doc_id'];
    public $translatable = ['name'];

    /**
     * Get the doctor that owns the Clinic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doc_id');
    }
}

