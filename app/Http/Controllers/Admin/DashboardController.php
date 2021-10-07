<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Karyawan;

class DashboardController extends Controller
{
    /**
     *
     * Initiate controller instance
     *
     */    
    function __construct()
    {
        $this->breadcrumbs = [
            [
                'text' => 'Dashboard',
                'route' => route('admin.dashboard.index')
            ]
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'sales' => '50',
            'collector' => '20',
            'customer' => '132',
            'totalPenjualan' => '1000000',
            'totalPembayaran' => '500000',
            'breadcrumbs' => $this->breadcrumbs,
        ]);
    }
}
