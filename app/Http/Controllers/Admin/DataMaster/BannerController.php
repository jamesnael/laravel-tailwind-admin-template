<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Banner;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class BannerController extends Controller
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
                'route' => route('admin.data-master.banner.index')
            ],
            [
                'text' => 'Banner',
                'route' => route('admin.data-master.banner.index')
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
        return Inertia::render('Admin/DataMaster/Banner/Index', [
            'breadcrumbs' => $this->breadcrumbs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $this->breadcrumbs[] = [
            'text' => 'Edit Banner',
            'route' => route('admin.data-master.banner.edit', [$banner->slug])
        ];
        return Inertia::render('Admin/DataMaster/Banner/Edit', [
            'breadcrumbs' => $this->breadcrumbs,
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate($this->validationRules($banner));

        DB::beginTransaction();
        try {
            $banner->update($request->except(['banner_image']));
            if ($request->hasFile('banner_image')) {
                $file_name = $banner->slug . '-' . uniqid() . '.' . $request->file('banner_image')->getClientOriginalExtension();
                $path = Storage::disk('public')->putFileAs('banner/banner_image', $request->file('banner_image'), $file_name);
                $banner->banner_image = $path;
            }

            $banner->save();

            log_activity(
                'Edit Banner ' . $banner->page_name,
                $banner
            );

            DB::commit();
            return redirect()->route('admin.data-master.banner.index')->with('alertState', 'success')->with('alertMessage', 'Data Banner berhasil diubah.');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('alertState', 'error')->with('alertMessage', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        DB::beginTransaction();
        try {
            $banner->delete();

            log_activity(
                'Delete Banner ' . $banner->page_name,
                $banner
            );

            DB::commit();
            return redirect()->route('admin.data-master.banner.index')->with('alertState', 'success')->with('alertMessage', 'Banner berhasil dihapus.');
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
        return response()->json(Banner::orderBy('created_at', 'DESC')->filter($request->all())->paginateFilter());
    }

    /**
     *
     * Validation Rules for Store/Update Data
     *
     */
    public function validationRules($banner = null)
    {
        return [
            'page_name' => 'required',
            'title' => 'required',
            'banner_image' => 'required',
            'description' => 'nullable',
            'sub_description' => 'nullable',
            'button_title' => 'nullable',
            'link_redirect' => 'nullable',
        ];
    }
}
