<?php


namespace App\Http\Controllers;


use App\Http\Requests\CreateRequest;
use App\Http\Services\ReportMessageService;

class ReportController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function report(CreateRequest $request, ReportMessageService $service)
    {
        $service->create($request);

        return view('contact');
    }
}
