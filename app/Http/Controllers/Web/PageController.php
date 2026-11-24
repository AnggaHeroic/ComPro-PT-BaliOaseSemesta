<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ActivityService;
use App\Services\CompanyService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function __construct(private ActivityService $activityService, private CompanyService $companyService) {}

    public function home(): View
    {
        return view('web.home', ['activities' => $this->activityService->cards()]);
    }

    public function about(): View
    {
        return view('web.about', ['about' => $this->companyService->about()]);
    }

    public function contact(): View
    {
        return view('web.contact');
    }
}
