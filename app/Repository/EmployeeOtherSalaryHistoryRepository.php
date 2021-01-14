<?php

namespace App\Repository;

use App\Api\EmployeeOtherSalaryHistoryRepositoryInterface;
use App\Models\EmployeeOtherSalaryHistory;
use Illuminate\Support\Facades\Auth;

class EmployeeOtherSalaryHistoryRepository implements EmployeeOtherSalaryHistoryRepositoryInterface
{
    protected $_employeeOtherSalaryHistoryModels;

    /**
     * EmployeeOtherSalaryHistoryRepository constructor.
     * @param EmployeeOtherSalaryHistory $employeeOtherSalaryHistory
     */
    public function __construct(EmployeeOtherSalaryHistory $employeeOtherSalaryHistory)
    {
        $this->_employeeOtherSalaryHistoryModels = $employeeOtherSalaryHistory;
    }

    /**
     * @param int $userId
     * @param int $employeeId
     * @param int $otherSalaryId
     * @param string $value
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function updateEmployeeOtherSalaryHistory($userId,$employeeId, $otherSalaryId, $value,$companyId)
    {
       return $this->_employeeOtherSalaryHistoryModels->create([
         "user_id"=>Auth::user()->id,"other_salary_id"=>$otherSalaryId,"value"=>$value,"employee_id"=>$employeeId,"company_id"=>$companyId
       ]);
    }

    /**
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function getAllEmployeeOtherSalaryHistory($companyId)
    {
      return $this->_employeeOtherSalaryHistoryModels->orderBy("id","ASC")->where("company_id",$companyId)->where("status",0)->get();
    }
    /**
     * @param int $employeeId
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function DeleteEmployeeOtherSalaryHistory($employeeId, $companyId)
    {
       return $this->_employeeOtherSalaryHistoryModels->where("employee_id",$employeeId)->where("company_id",$companyId)->update(["status"=>1]);
    }

    public function DeleteEmployeeOtherSalaryHistoryByOtherSalary($employeeId, $otherSalaryId, $companyId)
    {
        return $this->_employeeOtherSalaryHistoryModels->where("employee_id",$employeeId)->where("other_salary_id",$otherSalaryId)->where("company_id",$companyId)->update(["status"=>1]);
    }


    /**
     * @param int $employeeId
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function getEmployeeOtherSalaryHistoryByEmployeeId($employeeId, $companyId)
    {
        return $this->_employeeOtherSalaryHistoryModels->where("employee_id",$employeeId)->where("company_id",$companyId)->get();
    }

    /**
     * @param int $employeeId
     * @param int $otherSalaryId
     * @param string $value
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function UpdateEmployeeOtherSalaryValue($employeeId,$otherSalaryId, $value, $companyId)
    {
      return $this->_employeeOtherSalaryHistoryModels->where("employee_id",$employeeId)->where("other_salary_id",$otherSalaryId)->where("company_id",$companyId)->update([
          "value"=>$value
      ]);
    }

    /**
     * @param int $employeeId
     * @param int $otherSalaryId
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function ActiveEmployeeOtherSalaryHistoryByOtherSalary($employeeId, $otherSalaryId, $companyId)
    {
       return $this->_employeeOtherSalaryHistoryModels->where("employee_id",$employeeId)->where("other_salary_id",$otherSalaryId)->where("company_id",$companyId)->update(["status"=>0]);
    }

    /**
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function getAllEmployeeOtherSalaryHistoryWithoutStatus($companyId)
    {
       return $this->_employeeOtherSalaryHistoryModels->orderBy("id","DESC")->where("company_id",$companyId)->get();
    }


}
