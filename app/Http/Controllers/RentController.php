<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RentController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Rent List"]
        ];
        $pay = User::with('payment')->get()->find(auth()->user()->id);
        //dd($pay->payment);
        if ($request->expectsJson()) {
            return DataTables::of(User::with('payment')->get()->find(auth()->user()->id)->payment)
                ->addIndexColumn()
                ->addColumn('total', function ($payment) {
                    return $payment->monthly_rent + $payment->monthly_maintainance_rent;
                })
                ->addColumn('actions',  function ($payment) {
                    return $payment->status !== 'paid' ?
                        "<a href='/rents/{$payment->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Pay' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-flat-primary'><i
             class='fa fa-credit-card-alt'></i></a>" : '';
                })->rawColumns(['actions'])->toJson();
        }

        return view('pages.tenant.tenant-rent', ['breadcrumbs' => $breadcrumbs]);
    }

    public function edit(Payment $rent)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/rents", 'name' => "Rent List"], ['name' => "Rent Pay"]
        ];
        //dd(Payment::where('id', $rent->id)->first());
        return view('pages.tenant.tenant-rent-edit', ['rent' =>
        Payment::where('id', $rent->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function update(Payment $rent)
    {
        $validate = request()->validate(
            [
                'card_holder_name' => 'required',
                'card_number' => 'required|min:16|max:16',
                'expiry_date' => 'required',
                'cvv_number' => 'required|min:3|max:3',
            ]
        );

        $monthyear = date("m-Y");
        if (($validate['card_number'] === "1212232334344545") && ($validate['cvv_number'] === '456') && ($validate['expiry_date'] >= $monthyear)) {
            Payment::where('id', $rent->id)
                ->where('user_id', $rent->user_id)
                ->update(['status' => 'paid']);
            return redirect()->route('rents')->with('message', 'Rent Paid!');
        } else {
            return redirect()->back()->with('message', 'Card Details is not Correct!');
        }
    }
}
