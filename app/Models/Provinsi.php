<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'ms_provinsi';

    protected $fillable = [
    	'provinsi',
    	'kota',
    	'kelurahan'
    ];

    /**
     * Get the relations for the model.
     */
    
    public function regional_detail()
    {
        return $this->hasOne(RegionalDetail::class, 'provinsi_id', 'id');
    }

    /**
     * Get the relations for the model.
     */
    
    public function jadwal_sales()
    {
        return $this->hasMany(RegionalDetail::class, 'provinsi_id', 'id');
    }

    /**
     * Get the relations for the model.
     */
    
    public function customer()
    {
        return $this->hasOne(Customer::class, 'provinsi_id', 'id');
    }
}
