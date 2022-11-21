<?php


namespace App\Http\Services;


use App\Http\Requests\CreateRequest;
use App\Http\Requests\DeletedRequest;
use App\Http\Requests\EntriesByReadRequest;
use App\Http\Requests\PhoneNumberDigitsRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\ContactMessage;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ReportMessageService
{
    public function create(CreateRequest $request): ContactMessage
    {
        $message = new ContactMessage();
        $message->name = $request->name;
        $message->message = $request->message;
        $message->phone = $request->phone;
        $message->created_at = Carbon::now();
        $message->save();

        return $message;
    }

    public function getRead(EntriesByReadRequest $request): Collection|array
    {
        $messages = ContactMessage::query();

        if (isset($request->filter)) {
            $messages->where(
                'phone',
                'like',
                '%' . $request->filter . '%',
            );
        }

        return $messages->where('read', '=', $request->read)->get();
    }

    public function getDeleted(DeletedRequest $request): Collection|array
    {
        $messages = ContactMessage::query();

        if (isset($request->filter)) {
            $messages->where(
                'phone',
                'like',
                '%' . $request->filter . '%',
            );
        }

        return $messages->whereNotNull('deleted_at')->get();
    }

    public function getByDigits(PhoneNumberDigitsRequest $request): Collection|array
    {
        return ContactMessage::query()
            ->where(
                'phone',
                'like',
                '%' . $request->phoneDigits . '%',
            )
            ->get();
    }

    public function update(UpdateRequest $request, ContactMessage $message): ContactMessage
    {
        if (isset($request->name)) {
            $message->name = $request->name;
        }

        if (isset($request->phone)) {
            $message->name = $request->phone;
        }

        if (isset($request->message)) {
            $message->message = $request->message;
        }

        $message->save();

        return $message;
    }

    public function setRead(ContactMessage $message): ContactMessage
    {
        $message->read = true;
        $message->save();

        return $message;
    }

    public function delete(ContactMessage $message): ContactMessage
    {
        $message->deleted_at = Carbon::now();
        $message->save();

        return $message;
    }

    public function enable(ContactMessage $message): ContactMessage
    {
        $message->deleted_at = null;
        $message->save();

        return $message;
    }
}
