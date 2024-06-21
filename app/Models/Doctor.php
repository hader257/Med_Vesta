<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Models\Clinic ;
use App\Models\Comment;
use App\Models\Government ;
use App\Models\Specialization ;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, HasTranslations, Notifiable;

    protected $fillable = [
        'name' ,
        'email',
        'password',
        'image',
        'phone',
        'rate',
        'recommandation',
        'nid',
        'bio',
        'img_verify',
        'gov_id',
        'special_id',
        ] ;
    public $translatable = ['name' , 'bio'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    /**
     * Get all of the clinic for the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class,'id','doc_id');
    }


    /**
     * Get the special that owns the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function special()
    {
        return $this->belongsTo(Specialization::class, 'special_id');
    }

        /**
     * Get the government that owns the Doctor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function government()
    {
        return $this->belongsTo(Government::class, 'gov_id');
    }

    //     /**
    //  * Get all of the comments for the Comment
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}
