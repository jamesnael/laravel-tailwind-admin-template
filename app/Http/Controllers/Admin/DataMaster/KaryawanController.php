<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
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
                'text' => 'Master Data',
                'route' => route('admin.data-master.karyawan.index')
            ],
            [
                'text' => 'User',
                'route' => route('admin.data-master.karyawan.index')
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
        return Inertia::render('Admin/DataMaster/Karyawan/Index', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->breadcrumbs[] = [
            'text' => 'Create User',
            'route' => route('admin.data-master.karyawan.create')
        ];
        return Inertia::render('Admin/DataMaster/Karyawan/Create', [
            'breadcrumbs' => $this->breadcrumbs,
            'jabatan' => Jabatan::select('id AS value', 'nama_jabatan AS label', 'tipe_user AS tipe_user')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules());

        DB::beginTransaction();
        try {
            $request->merge(['password' => Hash::make($request->password)]);
            $karyawan = Karyawan::create($request->except(['password_confirmation', 'ektp']));
            if ($request->hasFile('ektp')) {
                $file_name = $karyawan->slug . '-' . uniqid() . '.' . $request->file('ektp')->getClientOriginalExtension();
                $path = Storage::disk('public')->putFileAs('karyawan/ektp', $request->file('ektp'), $file_name);
                $karyawan->ektp_path = $path;
                $karyawan->save();
            }

            log_activity(
                'Create User ' . $karyawan->nama_lengkap,
                $karyawan
            );

            DB::commit();
            return redirect()->route('admin.data-master.karyawan.index')->with('alertState', 'success')->with('alertMessage', 'Karyawan baru berhasil ditambahkan.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function edit(Karyawan $karyawan)
    {
        $this->breadcrumbs[] = [
            'text' => 'Edit User',
            'route' => route('admin.data-master.karyawan.edit', [$karyawan->slug])
        ];
        return Inertia::render('Admin/DataMaster/Karyawan/Edit', [
            'breadcrumbs' => $this->breadcrumbs,
            'jabatan' => Jabatan::select('id AS value', 'nama_jabatan AS label','tipe_user AS tipe_user')->get(),
            'karyawan' => $karyawan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate($this->validationRules($karyawan));

        DB::beginTransaction();
        try {
            $karyawan->update($request->except(['password', 'password_confirmation', 'ektp']));
            if ($request->hasFile('ektp')) {
                $file_name = $karyawan->slug . '-' . uniqid() . '.' . $request->file('ektp')->getClientOriginalExtension();
                $path = Storage::disk('public')->putFileAs('karyawan/ektp', $request->file('ektp'), $file_name);
                $karyawan->ektp_path = $path;
            }
            if ($request->password) {
                $karyawan->password = Hash::make($request->password);
            }
            $karyawan->save();

            log_activity(
                'Edit User ' . $karyawan->nama_lengkap,
                $karyawan
            );

            DB::commit();
            return redirect()->route('admin.data-master.karyawan.index')->with('alertState', 'success')->with('alertMessage', 'Data Karyawan berhasil diubah.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Karyawan $karyawan)
    {
        DB::beginTransaction();
        try {
            $karyawan->delete();

            log_activity(
                'Delete User ' . $karyawan->nama_lengkap,
                $karyawan
            );

            DB::commit();
            return redirect()->route('admin.data-master.karyawan.index')->with('alertState', 'success')->with('alertMessage', 'Karyawan berhasil dihapus.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
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
        return response()->json(Karyawan::with('jabatan')->orderBy('created_at', 'DESC')->filter($request->all())->paginateFilter());
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validationRules($karyawan = null)
    {
        return [
            'nama_lengkap' => 'required',
            'username' => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
                Rule::unique('\App\Models\Karyawan', 'username')->ignore($karyawan)
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('\App\Models\Karyawan', 'email')->ignore($karyawan)
            ],
            'password' => [
                Rule::requiredIf(function () use ($karyawan) {
                    return $karyawan == null;
                }),
                'nullable',
                'string',
                'min:8',
                'max:16',
                'confirmed',
            ],
            'password_confirmation' => 'required_with:password',
            'jabatan_id' => 'required|exists:App\Models\Jabatan,id',
            'status' => 'required|boolean',
        ];
    }
}
