<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateReminderRequest;
use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Services\ReminderService;
use Illuminate\Support\Facades\Response;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreReminderRequest;

class ReminderController extends Controller
{

    private $reminderService;

    public function __construct(ReminderService $reminderService)
    {
        $this->reminderService =  $reminderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reminder.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reminder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReminderRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->reminderService->create($request);
            session()->flash('success', __('message.reminderCreateSuccess'));
            DB::commit();
            return redirect()->route('reminder.index');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reminder $reminder)
    {
        return view('reminder.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reminder $reminder)
    {
        return view('reminder.edit', compact('reminder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReminderRequest $request, Reminder $reminder)
    {
        try {
            DB::beginTransaction();
            $this->reminderService->update($request,$reminder);
            session()->flash('success', __('message.reminderUpdateSuccess'));
            DB::commit();
            return redirect()->route('reminder.index');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reminder $reminder)
    {
        try {
            return $reminder->delete();
        } catch (Exception $e) {
            return Response::json($e->getMessage(), 500);
        }
    }

    public function getReminders()
    {

        try {
            return $this->reminderService->getReminders();
        } catch (Exception $e) {
            return Response::json($e->getMessage(), 500);
        }

        $this->reminderService->getReminders();
    }
}
