<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\DeletedRequest;
use App\Http\Requests\EntriesByReadRequest;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\PhoneNumberDigitsRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Http\Services\ReportMessageService;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;


class MessageController extends Controller
{
    public function index(IndexRequest $request): JsonResponse
    {
        $messages = DB::table('contact_messages');

        if (isset($request->filter)) {
            $messages
                ->where(
                    'phone',
                    'like',
                    '%' . $request->filter . '%',
                );
        }

        return response()->json(new MessageCollection($messages->get()->collect()));
    }

    public function create(CreateRequest $request, ReportMessageService $service): JsonResponse
    {
        return response()->json(new MessageResource($service->create($request)));
    }

    public function getRead(EntriesByReadRequest $request, ReportMessageService $service): JsonResponse
    {
        return response()->json(new MessageCollection($service->getRead($request)));
    }

    public function getDeleted(DeletedRequest $request, ReportMessageService $service): JsonResponse
    {
        return response()->json(new MessageCollection($service->getDeleted($request)));
    }

    public function getByPhoneNumberDigits(
        PhoneNumberDigitsRequest $request,
        ReportMessageService $service,
    ): JsonResponse
    {
        return response()->json(new MessageCollection($service->getByDigits($request)));
    }

    public function update(ContactMessage $message, UpdateRequest $request, ReportMessageService $service): JsonResponse
    {
        return response()->json(new MessageResource($service->update($request, $message)));
    }

    public function setRead(ContactMessage $message, ReportMessageService $service): JsonResponse
    {
        return response()->json(new MessageResource($service->setRead($message)));
    }

    public function delete(ContactMessage $message, ReportMessageService $service): JsonResponse
    {
        return response()->json(new MessageResource($service->delete($message)));
    }

    public function enable(ContactMessage $message, ReportMessageService $service): JsonResponse
    {
        return response()->json(new MessageResource($service->enable($message)));
    }
}
