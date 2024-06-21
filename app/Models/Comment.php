<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient ;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [] ;

    /**
     * Get the patient that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class , 'patient_id');
    }
}
