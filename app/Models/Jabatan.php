<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use EloquentFilter\Filterable;

class Jabatan extends Model
{
    use HasFactory, SoftDeletes, Sluggable, Filterable;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = \Auth::user()->name ?? 'System';
            $model->updated_by = \Auth::user()->name ?? 'System';
        });
        static::updating(function ($model) {
            $model->updated_by = \Auth::user()->name ?? 'System';
        });
        static::deleted(function ($model) {
            $model->deleted_by = \Auth::user()->name ?? 'System';
            $model->save();
        });
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_jabatan';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'hak_akses' => 'array',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['nama_jabatan', 'tipe_user']
            ]
        ];
    }

    /**
     * Get the relations for the model.
     */
    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'jabatan_id', 'id');
    }
}
