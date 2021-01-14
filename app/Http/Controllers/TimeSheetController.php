<?php

namespace App\Http\Controllers;

use App\Repository\EmployeeRepository;
use App\Repository\TimeSheetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeSheetController extends Controller
{
    protected $_EmployeeRepository;
    protected $_timeSheetRepository;

    public function __construct(TimeSheetRepository $timeSheetRepository,EmployeeRepository $employeeRepository)
    {
        $this->_EmployeeRepository = $employeeRepository;
        $this->_timeSheetRepository = $timeSheetRepository;
    }

    public function getTimeSheet(Request $request){
        $requestData = $request->all();
        if(isset($requestData["search_by_date"])){
        $getAllTimeSheet = $this->_timeSheetRepository->getTimeSheetByDate($requestData["search_by_date"],Auth::user()->company_id);
        }elseif(isset($requestData["search_account"])){
            $getAllTimeSheet = $this->_timeSheetRepository->getTimeSheetByEmployeeNameAndEmail($requestData["search_account"],Auth::user()->company_id);
        }else {
        $getAllTimeSheet = $this->_timeSheetRepository->getAllTimeSheet(Auth::user()->company_id);
        }

        return view("timeSheet.view",compact("getAllTimeSheet"));
    }

    public function UpdateTimeSheet(Request $request,$id){
        $requestData = $request->all();
        if(!isset($requestData["in_date"])){
            $requestData["in_date"] = NULL;
        }
        if(!isset($requestData["out_date"])){
            $requestData["out_date"] = NULL;
        }
        $this->_timeSheetRepository->UpdateDateTimeSheet($id,$requestData["in_date"],$requestData["out_date"],Auth::user()->company_id);
        return redirect(route("timeSheet.view"))->with("message","checked Employee");
    }
}
