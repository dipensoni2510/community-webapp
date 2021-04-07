<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Company;
use App\Faq;
use App\MaintainanceProvider;
use App\MaintainanceService;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $approvedTenant = User::where('role', "tenant")
            ->where('status', 'approved')->count();
        $declinedTenant = User::where('role', "tenant")
            ->where('status', 'declined')->count();
        $pendingTenant = User::where('role', "tenant")
            ->where('status', 'pending')->count();

        $compnies = Company::count();

        $sevices = MaintainanceService::count();

        $serviceProviders = MaintainanceProvider::count();

        $pendingPayment = 0;
        $paidPayment = 0;
        $userPendingPayment = 0;
        $userPaidPayment = 0;
        $faqs = 0;
        if (auth()->user()->role === 'admin') {
            $pendingPayment = Payment::where('status', 'pending')->count();
            $paidPayment = Payment::where('status', 'paid')->count();
        } elseif (auth()->user()->role === 'tenant') {
            $userPendingPayment = Payment::where('user_id', auth()->user()->id)
                ->where('status', 'pending')
                ->count();
            $userPaidPayment = Payment::where('user_id', auth()->user()->id)
                ->where('status', 'paid')
                ->count();
            //dd($userPaidPayment);
            $faqs = Faq::count();
        }
        //dd($userPaidPayment);
        $announcementCount = Announcement::count();

        return view('pages.dashboard-analytics', ['approvedTenant' => $approvedTenant, 'declinedTenant' => $declinedTenant, 'pendingTenant' => $pendingPayment, 'company' => $compnies, 'services' => $sevices, 'service_providers' => $serviceProviders, 'pending_payment' => $pendingPayment, 'paid_payment' => $paidPayment, 'user_pending_payment' => $userPendingPayment, 'user_paid_payment' => $userPaidPayment, 'announcement' => $announcementCount, 'faqs' => $faqs]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
