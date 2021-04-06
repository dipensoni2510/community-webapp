<?php

namespace App\Http\Controllers;

use App\MaintainanceService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class MaintainanceServiceController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Maintainance Service List"]
        ];

        if ($request->expectsJson()) {
            return DataTables::of(MaintainanceService::query())
                ->addIndexColumn()
                ->addColumn('actions',  function ($maintainanceService) {
                    return
                        "<a href='/maintainance-services/{$maintainanceService->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
                 class='feather icon-eye'></i></a>

                 <a href='/maintainance-services/{$maintainanceService->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
                 class='feather icon-edit'></i></a>
                 
                 <a href='#' data-id='{$maintainanceService->id}' type='button' data-toggle='tooltip' data-placement='top' title='Remove Service' class='pl-0 pr-0 pt-0 pb-0 button-remove-service btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
                 class='feather icon-trash-2'></i></a>";
                })->rawColumns(['actions'])->toJson();
        }

        return view('pages.maintainance-services.maintainance-services-view', ['breadcrumbs' => $breadcrumbs]);
    }

    public function show(MaintainanceService $maintainanceService)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/maintainance-services", 'name' => "Maintainance Service List"], ['name' => "View"]
        ];
        return view('pages.maintainance-services.maintainance-services-show', ['service' => MaintainanceService::where('id', $maintainanceService->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/maintainance-services", 'name' => "Maintainance Service List"], ['name' => "Create"]
        ];
        return view('pages.maintainance-services.maintainance-services-create', ['breadcrumbs' => $breadcrumbs]);
    }

    public function store(MaintainanceService $maintainanceService)
    {
        $validate = request()->validate(
            [
                'title' => ['required', Rule::unique('maintainance_services')->ignore($maintainanceService)],
                'image' => ''
            ]
        );

        if (request('image')) {
            $validate['image'] = request('image')->store('services-image', 'public');
        }

        $maintainanceService->create($validate);
        return redirect()->route('maintainance-services')->with('message', 'Maintainance Service Inserted!');
    }

    public function edit(MaintainanceService $maintainanceService)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/maintainance-services", 'name' => "Maintainance Service List"], ['name' => "Edit"]
        ];
        return view('pages.maintainance-services.maintainance-services-edit', ['service' => MaintainanceService::where('id', $maintainanceService->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function update(MaintainanceService $maintainanceService)
    {
        //dd($maintainanceService->id);
        $validate = request()->validate(
            [
                'title' => ['required', Rule::unique('maintainance_services')->ignore($maintainanceService->id)],
                'image' => ''
            ]
        );
        if (request('image')) {
            $validate['image'] = request('image')->store('services-image');
        }
        $maintainanceService->update($validate);
        return redirect()->route('maintainance-services')->with('message', 'Maintainance Service Updated!');
    }

    public function destroy(MaintainanceService $maintainanceService)
    {
        //dd(MaintainanceService::withTrashed()->get());
        MaintainanceService::find($maintainanceService->id)->delete();

        return back()->with(json_encode(['success' => 'ok']));
    }
}
