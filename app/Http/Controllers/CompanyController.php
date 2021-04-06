<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Company List"]
        ];

        if ($request->expectsJson())
        {
            return DataTables::of(Company::query())
            ->addColumn('actions',  function ($company) {
                return
                    "<a href='/companies/{$company->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
                 class='feather icon-eye'></i></a>

                 <a href='/companies/{$company->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
                 class='feather icon-edit'></i></a>";
            })->rawColumns(['actions'])->toJson();
        }

        return view('pages.company.companies-view', ['breadcrumbs' => $breadcrumbs]);
    }

    // public function getCompanies()
    // {
    //     return DataTables::of(Company::query())
    //         ->addColumn('actions',  function ($company) {
    //             return
    //                 "<a href='/companies/{$company->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
    //              class='feather icon-eye'></i></a>

    //              <a href='/companies/{$company->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
    //              class='feather icon-edit'></i></a>";
    //         })->rawColumns(['actions'])->toJson();
    // }

    public function create()
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/companies", 'name' => "Company List"], ['name' => "Create"]
        ];
        return view('pages.company.company-register', ['types' => Company::select('type')->groupBy('type')->get(), 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Company $company)
    {
        $validate = request()->validate(
            [
                'name' => 'required',
                'website' => 'required|max:255',
                'description' => 'required|max:255',
                'phone' => 'required|min:10|max:11',
                'address' => 'required|max:255',
                'type' => 'required',
            ]
        );

        $company->create($validate);
        return redirect()->route('companies')->with('message', 'Company Inserted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/companies", 'name' => "Company List"], ['name' => "View"]
        ];
        return view('pages.company.companies-show', ['company' => Company::where('id', $company->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/companies", 'name' => "Company List"], ['name' => "Edit"]
        ];
        return view('pages.company.company-edit', ['company' => Company::where('id', $company->id)->first(), 'types' => Company::select('type')->groupBy('type')->get(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function update(Company $company)
    {
        $validate = request()->validate(
            [
                'name' => 'required',
                'website' => 'required|max:255',
                'description' => 'required|max:255',
                'phone' => 'required|min:10|max:11',
                'address' => 'required|max:255',
                'type' => 'required',
            ]
        );

        $company->update($validate);
        return redirect()->route('companies')->with('message', 'Company Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
