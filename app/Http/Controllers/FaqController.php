<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "FAQ's"]
        ];

        return view('pages.tenant.tenant-faqs', ['faqs' => Faq::paginate(10), 'breadcrumbs' => $breadcrumbs]);
    }
}
