<?php

namespace App\Http\Controllers;

use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Payment List"]
        ];

        if ($request->expectsJson()) {
            return DataTables::of(Payment::with('user')->get())
                ->addIndexColumn()
                ->addColumn('tenant_name', function ($payment) {
                    return $payment->user->first_name . ' ' . $payment->user->last_name;
                })
                ->addColumn('total', function ($payment) {
                    return $payment->monthly_rent + $payment->monthly_maintainance_rent;
                })
                ->addColumn('actions',  function ($payment) {
                    return
                        "<a href='/payments/{$payment->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
             class='feather icon-eye'></i></a>

             <a href='/payments/{$payment->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
             class='feather icon-edit'></i></a>
             
             <a href='#' data-id='{$payment->id}' type='button' data-toggle='tooltip' data-placement='top' title='Remove Service Provider' class='pl-0 pr-0 pt-0 pb-0 button-decline-action btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
             class='feather icon-trash-2'></i></a>";
                })->rawColumns(['actions'])->toJson();
        }

        return view('pages.payment.payment-view', ['breadcrumbs' => $breadcrumbs]);
    }

    public function show(Payment $payment)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/payments", 'name' => "Payment List"], ['name' => "Show"]
        ];
        // dd(['payemt' =>
        //Payment::with('user')->find($payment->id)]);
        return view('pages.payment.payment-show', ['payemt' =>
        Payment::with('user')->find($payment->id), 'breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/payments", 'name' => "Payment List"], ['name' => "Create"]
        ];
        // where('status', 'approved')->get()
        return view('pages.payment.payment-create', ['tenants' => User::where('status', 'approved')->get(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate(
            [
                'user_id' => 'required',
                'start_date' => 'required|date_format:Y-m-d',
                'end_date' => 'required|date_format:Y-m-d',
                'contract' => '',
                'monthly_rent' => 'required',
                'monthly_maintainance_rent' => 'required',
            ]
        );

        if (request('contract')) {
            $validate['contract'] = request('contract')->store('contracts');
        }

        $payment = new Payment;
        $payment->user_id = $validate['user_id'];
        $payment->start_date = $validate['start_date'];
        $payment->end_date = $validate['end_date'];
        $payment->monthly_rent = $validate['monthly_rent'];
        $payment->monthly_maintainance_rent = $validate['monthly_maintainance_rent'];
        $payment->contract = $validate['contract'];
        $payment->save();
        return redirect()->route('payments')->with('message', 'Payment Inserted!');
    }

    public function edit(Payment $payment)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/payments", 'name' => "Payment List"], ['name' => "Edit"]
        ];

        return view('pages.payment.payment-edit', ['payment' =>
        Payment::with('user')->find($payment->id), 'tenants' => User::where('status', 'approved')->get(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function update(Payment $payment)
    {
        $validate = request()->validate(
            [
                'user_id' => 'required',
                'start_date' => 'required|date_format:Y-m-d',
                'end_date' => 'required|date_format:Y-m-d',
                'contract' => '',
                'monthly_rent' => 'required',
                'monthly_maintainance_rent' => 'required',
            ]
        );

        if (request('contract')) {
            $validate['contract'] = request('contract')->store('contracts');
            $payment->contract = $validate['contract'];
        }

        //$payment = new Payment;
        $payment->user_id = $validate['user_id'];
        $payment->start_date = $validate['start_date'];
        $payment->end_date = $validate['end_date'];
        $payment->monthly_rent = $validate['monthly_rent'];
        $payment->monthly_maintainance_rent = $validate['monthly_maintainance_rent'];
        $payment->update();
        return redirect()->route('payments')->with('message', 'Payment Update!');
    }

    public function destroy(Payment $payment)
    {
        Payment::find($payment->id)->delete();
        return back()->with(json_encode(['success' => 'ok']));
    }
}
