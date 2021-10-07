<?php

namespace App\Http\Controllers\Admin\UserProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileController extends Controller
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
                'text' => 'Profile',
                'route' => route('admin.profile.show')
            ]
        ];
    }

    /**
     * Display user profile page
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return Inertia::render('Admin/Profile/Show', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }
}
