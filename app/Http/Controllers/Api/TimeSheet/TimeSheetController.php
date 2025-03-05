<?php

namespace App\Http\Controllers\Api\TimeSheet;

use App\Models\Timesheet;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Api\TimeSheet\TimeSheetService;
use App\Http\Resources\Api\TimeSheet\TimeSheetResoruce;
use App\Http\Resources\Api\TimeSheet\TimeSheetCollection;
use App\Http\Requests\Api\TimeSheet\StoreTimeSheetRequest;
use App\Http\Requests\Api\TimeSheet\UpdateTimeSheetRequest;

class TimeSheetController extends Controller
{
    public function __construct(private TimeSheetService $timeSheetService) {}

    public function index()
    {
        $timeSheets = $this->timeSheetService->index();
        return ApiResponseTrait::apiResponse(new TimeSheetCollection($timeSheets));
    }

    public function show(Timesheet $timeSheet)
    {
        $timeSheet = $this->timeSheetService->show($timeSheet);
        return ApiResponseTrait::apiResponse(['timeSheet' => new TimeSheetResoruce($timeSheet)]);
    }

    public function store(StoreTimeSheetRequest $request)
    {
        $timeSheet = $this->timeSheetService->store($request);
        return ApiResponseTrait::apiResponse(['timeSheet' => new TimeSheetResoruce($timeSheet)], "Time Sheet Created Successfully", status: 201);
    }

    public function update(UpdateTimeSheetRequest $request, Timesheet $timeSheet)
    {
        if ($timeSheet->project->creator_id == Auth::guard('api')->id()) {
            $timeSheet = $this->timeSheetService->update($request, $timeSheet);
            return ApiResponseTrait::apiResponse(['timeSheet' => new TimeSheetResoruce($timeSheet)], "Time Sheet Updated Successfully");
        } else {
            return ApiResponseTrait::apiResponse([], "Unauthorized To Update Time Sheet", [], 401);
        }
    }

    public function delete(Timesheet $timeSheet)
    {
        if ($timeSheet->project->creator_id == Auth::guard('api')->id()) {
            $this->timeSheetService->delete($timeSheet);
            return ApiResponseTrait::apiResponse(message: "Time Sheet Deleted Successfully", status: 200);
        } else {
            return ApiResponseTrait::apiResponse([], "Unauthorized To Delete Time Sheet", [], 401);
        }
    }
}
