<?php

namespace App\Http\Controllers;

use App\MaintainanceProvider;
use App\MaintainanceService;
use Illuminate\Http\Request;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class MaintainanceProviderController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Maintainance Provider List"]
        ];
        //dd($arr);
        //dd(MaintainanceProvider::with('maintainance_service')->get()->find(3)->maintainance_service);
        if ($request->expectsJson()) {
            return DataTables::of(MaintainanceProvider::with('maintainance_service')->get())
                ->addColumn('service_type', function ($maintainanceProvider) {
                    return $maintainanceProvider->maintainance_service->title;
                })
                ->addColumn('actions',  function ($maintainanceProvider) {
                    return
                        "<a href='/maintainance-providers/{$maintainanceProvider->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
                 class='feather icon-eye'></i></a>

                 <a href='/maintainance-providers/{$maintainanceProvider->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
                 class='feather icon-edit'></i></a>
                 
                 <a href='#' data-id='{$maintainanceProvider->id}' type='button' data-toggle='tooltip' data-placement='top' title='Remove Service Provider' class='pl-0 pr-0 pt-0 pb-0 button-remove-service-provider btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
                 class='feather icon-trash-2'></i></a>";
                })->rawColumns(['actions'])->toJson();
        }

        return view('pages.maintainance-providers.maintainance-providers-view', ['breadcrumbs' => $breadcrumbs]);
    }

    public function show(MaintainanceProvider $maintainanceProvider)
    {

        //dd(MaintainanceProvider::with('maintainance_service')->find($maintainanceProvider->id));

        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/maintainance-providers", 'name' => "Maintainance Provider List"], ['name' => "View"]
        ];
        return view('pages.maintainance-providers.maintainance-providers-show', ['service' => MaintainanceProvider::with('maintainance_service')->find($maintainanceProvider->id), 'breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/maintainance-providers", 'name' => "Maintainance Provider List"], ['name' => "Create"]
        ];
        return view('pages.maintainance-providers.maintainance-providers-create', [
            'types' => MaintainanceService::all(), 'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function store(MaintainanceProvider $maintainanceProvider)
    {
        $validate = request()->validate(
            [
                'name' => 'required',
                'maintainance_service_id' => 'required',
                'website' => 'required|max:255',
                'description' => 'required|max:255',
                'phone' => 'required|min:10|max:11',
                'address' => 'required|max:255',
            ]
        );

        $maintainanceProvider->create($validate);
        return redirect()->route('maintainance-providers')->with('message', 'Maintainance Provider Inserted!');
    }

    public function edit(MaintainanceProvider $maintainanceProvider)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/maintainance-providers", 'name' => "Maintainance Provider List"], ['name' => "Edit"]
        ];
        return view('pages.maintainance-providers.maintainance-providers-edit', ['service_provider' => MaintainanceProvider::where('id', $maintainanceProvider->id)->first(), 'types' => MaintainanceService::all(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function update(MaintainanceProvider $maintainanceProvider)
    {
        $validate = request()->validate(
            [
                'name' => 'required',
                'maintainance_service_id' => 'required',
                'website' => 'required|max:255',
                'description' => 'required|max:255',
                'phone' => 'required|min:10|max:11',
                'address' => 'required|max:255',
            ],
            ['maintainance_service_id.required' => 'The maintainance service field is required.']
        );

        $maintainanceProvider->update($validate);
        return redirect()->route('maintainance-providers')->with('message', 'Maintainance Provider Updated!');
    }

    public function destroy(MaintainanceProvider $maintainanceProvider)
    {
        //dd(MaintainanceService::withTrashed()->get());
        MaintainanceProvider::find($maintainanceProvider->id)->delete();

        return back()->with(json_encode(['success' => 'ok']));
    }
}
