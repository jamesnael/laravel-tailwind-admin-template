<?php

namespace App\Http\Controllers\Admin\UserProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PasswordController extends Controller
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
                'text' => 'Ubah Password',
                'route' => route('admin.profile.password')
            ]
        ];
    }

    /**
     * Display update password page
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return Inertia::render('Admin/Profile/Password', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }
}
