<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class KaryawanFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    /**
     *
     * Any methods defined in the blackist array will not be called by the filter.
     * Those methods are normally used for internal filter logic.
     *
     * @var array
     */    
    protected $blacklist = [
        'namaJabatan',
        'tipeUser',
        'keterangan',
    ];

    public function setup()
    {
        // 
    }

    public function search($value)
    {
        $this->namaLengkap($value)
            ->username($value, true)
            ->email($value, true)
            ->nomorHp($value, true)
            ->jabatan($value, true);
    }

    public function namaLengkap($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('nama_lengkap', 'LIKE', '%'.$value.'%');
        }
        return $this->where('nama_lengkap', 'LIKE', '%'.$value.'%');
    }

    public function username($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('username', 'LIKE', '%'.$value.'%');
        }
        return $this->where('username', 'LIKE', '%'.$value.'%');
    }

    public function email($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('email', 'LIKE', '%'.$value.'%');
        }
        return $this->where('email', 'LIKE', '%'.$value.'%');
    }

    public function nomorHp($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('nomor_hp', 'LIKE', '%'.$value.'%');
        }
        return $this->where('nomor_hp', 'LIKE', '%'.$value.'%');
    }

    public function jabatan($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhereHas('jabatan', function($query) use ($value)
                        {
                            return $query->where('nama_jabatan', 'LIKE', '%'.$value.'%');
                        });
        }
        return $this->whereHas('jabatan', function($query) use ($value)
                        {
                            return $query->where('nama_jabatan', 'LIKE', '%'.$value.'%');
                        });
    }

    public function sortOrder($sortOrder)
    {
        foreach ($sortOrder as $value) {
            $this->orderBy($value['column'], $value['order']);
        }
    }
}
