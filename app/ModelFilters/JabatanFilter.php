<?php 

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class JabatanFilter extends ModelFilter
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
        $this->namaJabatan($value)
            ->tipeUser($value, true)
            ->keterangan($value, true);
    }

    public function namaJabatan($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('nama_jabatan', 'LIKE', '%'.$value.'%');
        }
        return $this->where('nama_jabatan', 'LIKE', '%'.$value.'%');
    }

    public function tipeUser($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('tipe_user', 'LIKE', '%'.$value.'%');
        }
        return $this->where('tipe_user', 'LIKE', '%'.$value.'%');
    }

    public function keterangan($value, $orWhere = false)
    {
        if ($orWhere) {
            return $this->orWhere('keterangan', 'LIKE', '%'.$value.'%');
        }
        return $this->where('keterangan', 'LIKE', '%'.$value.'%');
    }

    public function sortOrder($sortOrder)
    {
        foreach ($sortOrder as $value) {
            $this->orderBy($value['column'], $value['order']);
        }
    }
}
