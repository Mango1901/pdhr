<?php

namespace App\Repository;

use App\Api\TimeSheetRepositoryInterface;
use App\Models\TimeSheet;

class TimeSheetRepository implements TimeSheetRepositoryInterface
{
    protected $_TimeSheetModels;

    /**
     * TimeSheetRepository constructor.
     * @param TimeSheet $timeSheet
     */
    public function __construct(TimeSheet $timeSheet)
    {
        $this->_TimeSheetModels = $timeSheet;

    }

    /**
     * @param int $companyId
     * @return TimeSheet
     */
    public function getAllTimeSheet($companyId)
    {
        return $this->_TimeSheetModels->where("company_id",$companyId)->whereDate("created_at",date("Y-m-d"))->where("status",0)->get();
    }

    /**
     * @param int $id
     * @param string $inDate
     * @param string $outDate
     * @param int $companyId
     * @return TimeSheet
     */
    public function UpdateDateTimeSheet($id, $inDate, $outDate, $companyId)
    {
        return $this->_TimeSheetModels->where("id",$id)->where("company_id",$companyId)->update([
           "in_date"=>$inDate,"out_date"=>$outDate
        ]);
    }

    /**
     * @param string $date
     * @param int $companyId
     * @return TimeSheet
     */
    public function getTimeSheetByDate($date, $companyId)
    {
        return $this->_TimeSheetModels->whereDate("created_at",$date)->where("company_id",$companyId)->where("status",0)->get();
    }

    public function getTimeSheetByEmployeeNameAndEmail($searchAccount,$companyId)
    {
       return $this->_TimeSheetModels->join("employees","employees.id","=","time_sheets.employee_id")
           ->join("users","employees.user_id","=","users.id")->where("email","like","%$searchAccount%")->where("time_sheets.company_id",$companyId)
           ->orwhere("full_name","like","%$searchAccount%")->where("time_sheets.company_id",$companyId)->get();
    }
}
