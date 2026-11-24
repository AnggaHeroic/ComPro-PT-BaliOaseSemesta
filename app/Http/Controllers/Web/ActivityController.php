<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function __construct(private ActivityService $activityService) {}

    public function index(): View
    {
        return view('web.activities', $this->activityService->listing(null));
    }

    public function category(string $category): View|RedirectResponse
    {
        // Saat pengategorian dimatikan, semua aktivitas tampil di satu halaman.
        if (! $this->activityService->categoriesEnabled()) {
            return redirect()->route('activities');
        }

        $found = $this->activityService->findCategory($category);
        abort_if($found === null, 404);

        return view('web.activities', $this->activityService->listing($found));
    }

    public function detail(string $activity): View
    {
        $data = $this->activityService->detail($activity);
        abort_if($data === null, 404);

        return view('web.activity-detail', $data);
    }
}
