<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NearByMaintainanceServiceProviderController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Service Provider"]
        ];

        if ($request->expectsJson()) {
            return DataTables::of(
                DB::table("maintainance_providers")
                    ->join('maintainance_services', 'maintainance_providers.maintainance_service_id', 'maintainance_services.id')
                    ->select(
                        "maintainance_providers.*",
                        "maintainance_services.title",
                        DB::raw("ROUND(6371 * acos(cos(radians(" . auth()->user()->lat . ")) 
                * cos(radians(maintainance_providers.lat)) 
                * cos(radians(maintainance_providers.long) - radians(" . auth()->user()->long . ")) 
                + sin(radians(" . auth()->user()->lat . ")) 
                * sin(radians(maintainance_providers.lat))), 2) AS distance")
                    )->get()
            )->addIndexColumn()
                ->make(true);
        }
        return view('pages.tenant.tenant-nearByServiceProvider', ['breadcrumbs' => $breadcrumbs]);
    }
}
