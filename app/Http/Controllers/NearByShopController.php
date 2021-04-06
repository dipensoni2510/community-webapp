<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class NearByShopController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Shop"]
        ];

        if ($request->expectsJson()) {
            return DataTables::of(
                DB::table("companies")
                    ->select(
                        "companies.*",
                        DB::raw("ROUND(6371 * acos(cos(radians(" . auth()->user()->lat . ")) 
                * cos(radians(companies.lat)) 
                * cos(radians(companies.long) - radians(" . auth()->user()->long . ")) 
                + sin(radians(" . auth()->user()->lat . ")) 
                * sin(radians(companies.lat))), 2) AS distance")
                    )->get()
            )->addIndexColumn()
                ->make(true);
        }
        return view('pages.tenant.tenant-nearByShop', ['breadcrumbs' => $breadcrumbs]);
    }
}
