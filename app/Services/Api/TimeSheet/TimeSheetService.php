<?php

namespace App\Services\Api\TimeSheet;

use App\Models\Timesheet;

class TimeSheetService
{
    public function index()
    {
        return Timesheet::with('user', 'project')
            ->paginate();
    }

    public function show($timeSheet)
    {
        return Timesheet::with('user', 'project')
            ->findOrFail($timeSheet->id);
    }

    public function store($request)
    {
        $data = $request->validated();
        return Timesheet::create($data);
    }

    public function update($request, $timeSheet)
    {
        $data = $request->validated();
        $timeSheet->update($data);
        return $timeSheet;
    }

    public function delete($timeSheet)
    {
        $timeSheet->delete();
    }
}
