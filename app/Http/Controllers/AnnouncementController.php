<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Announcement List"]
        ];

        if ($request->expectsJson()) {
            return DataTables::of(Announcement::query())
                ->addIndexColumn()
                ->addColumn('actions',  function ($announcement) {
                    return auth()->user()->role === "admin" ?
                        "<a href='/announcements/{$announcement->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
                        class='feather icon-eye'></i></a>

                 <a href='/announcements/{$announcement->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
                 class='feather icon-edit'></i></a>
                 
                 <a href='#' data-id='{$announcement->id}' type='button' data-toggle='tooltip' data-placement='top' title='Remove Service' class='pl-0 pr-0 pt-0 pb-0 button-remove-service btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
                 class='feather icon-trash-2'></i></a>"
                        :
                        "<a href='/announcements/{$announcement->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
                 class='feather icon-eye'></i></a>";
                })->rawColumns(['actions'])->toJson();
        }

        return view('pages.announcement.view', ['breadcrumbs' => $breadcrumbs]);
    }

    public function show(Announcement $announcement)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/announcements", 'name' => "Announcement List"], ['name' => "View"]
        ];
        return view('pages.announcement.show', ['announcement' => Announcement::where('id', $announcement->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function create(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/announcements", 'name' => "Announcements"], ['name' => "Create"]
        ];
        return view('pages.announcement.create', ['breadcrumbs' => $breadcrumbs]);
    }

    public function store(Request $request)
    {
        $validate = request()->validate(
            [
                'title' => 'required',
                'type' => 'required',
                'description' => 'required',
                'date' => 'required',
                'time' => 'required',
                'days' => 'required',
            ]
        );

        //dd($request->all());

        $announcement = Announcement::create($validate);

        return $announcement ? redirect()->route('announcements')->with('message', 'Announcements Inserted!') : redirect()->route('announcements.creates')->with('message', 'Something went wrong!');

        // return redirect()->route('announcements')->with('message', 'Announcements Inserted!');
    }

    public function edit(Request $request, Announcement $announcement)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/announcements", 'name' => "Announcement List"], ['name' => "Edit"]
        ];
        return view('pages.announcement.edit', ['announcement' => Announcement::where('id', $announcement->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validate = request()->validate(
            [
                'title' => 'required',
                'type' => 'required',
                'description' => 'required',
                'date' => 'required',
                'time' => 'required',
                'days' => 'required',
            ]
        );

        $announcement->update($validate);
        return redirect()->route('announcements')->with('message', 'Announcement Updated!');
    }

    public function destroy(Announcement $announcement)
    {
        Announcement::find($announcement->id)->delete();
        return back()->with(json_encode(['success' => 'ok']));
    }
}
