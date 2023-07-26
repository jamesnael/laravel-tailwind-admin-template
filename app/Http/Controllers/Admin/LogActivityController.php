<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Exception;

class LogActivityController extends Controller
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
                'text' => 'Log Activity',
                'route' => route('admin.log-activity.index')
            ],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/LogActivity/Index', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LogActivity  $aktivitas_kolektor
     * @return \Illuminate\Http\Response
     */
    public function detail($log_activity)
    {
        $log_activity = LogActivity::with('causer.jabatan')->find($log_activity);

        $this->breadcrumbs[] = [
            'text' => 'Detail Log Activity',
            'route' => route('admin.log-activity.detail', [$log_activity->id])
        ];

        $log_activity->created_date = \Carbon\Carbon::parse($log_activity->created_at)->locale('id')->translatedFormat('d F Y, H:i:s');

        return Inertia::render('Admin/LogActivity/Detail', [
            'breadcrumbs' => $this->breadcrumbs,
            'log_activity' => $log_activity,
            'nama_user' => $log_activity->causer->nama_lengkap
        ]);
    }

    /**
     *
     * Generate data for datatables
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function table(Request $request)
    {
    	$query = LogActivity::with('causer.jabatan');
    	if ($request->input_date) {
	        $query->whereDate('created_at', $request->input_date);
    	} else {
            $query->whereDate('created_at', \Carbon\Carbon::now()->format('Y-m-d'));
        }

    	if ($request->has('search') && $request->input('search')) {
            $query->where('description', 'LIKE', '%' . $request->input('search') . '%');

    		$query->orWhereHas('causer', function($subquery) use ($request){
                $subquery->where('nama_lengkap', 'LIKE', '%' . $request->input('search') . '%');
    		});

			$query->orWhereHas('causer.jabatan', function($subquery) use ($request){
	            $subquery->where('nama_jabatan', 'LIKE', '%' . $request->input('search') . '%');
			});
    	}

    	$query = $query->orderBy('id', 'DESC')->paginate(10);

    	$query->getCollection()->transform(function($item){
    		$item->created_date = \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y - H:i:s');

    		return $item;
    	});

        return response()->json($query);
    }
}
