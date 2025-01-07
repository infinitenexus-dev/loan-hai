<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Service;
use App\Http\Controllers\Controller;

class FrontendHome extends Controller
{
    public function view()
    {
        $reviews = Review::latest()->limit(6)->get();
        foreach ($reviews as $review) {
            $service = Service::find($review->service);
            if ($service) {
                $review->service_info = $service->service_name;
            } else {
                $review->service_info = null;
            }
        }
        return view('frontend.index', compact('reviews', 'service'));
    }
}
