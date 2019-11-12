<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestSubmittion ;
class TrackingTimelineController extends Controller
{
    public function show($id)
    {
        return RequestSubmittion::with(['RequestHistory'])->find($id);
    }
}
