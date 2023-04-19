<?php

namespace App\Services;

use App\Models\Reminder;
use DataTables;
use App\Helpers\Helper;
use Illuminate\Support\Carbon;

class ReminderService
{
    public function getReminders()
    {
        $query = Reminder::query();
        return DataTables::of($query)
            ->addColumn('action', function ($data) {
                $viewLink = '';
                $deleteLink = $data->id;
                $editLink = route('reminder.edit', [$data]);
                return Helper::action($editLink, $deleteLink, $viewLink);
            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function create($request)
    {
        $date = $request->scheduled_at;
        $date = Carbon::createFromFormat('Y-m-d H:i', $date,$request->timezone);
        $date->setTimezone('UTC');
        $timestamp = $date->unix();
        
        return Reminder::create([
            'title' => $request->title,
            'description' => $request->description,
            'scheduled_at' => $timestamp,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function update($request,$reminder)
    {
        $date = $request->scheduled_at;
        $date = Carbon::createFromFormat('Y-m-d H:i', $date,$request->timezone);
        $date->setTimezone('UTC');
        $timestamp = $date->unix();

        $reminder->title = $request->title;
        $reminder->description = $request->description;
        $reminder->scheduled_at = $timestamp;
        $reminder->save();
        return $reminder;
    }
}
