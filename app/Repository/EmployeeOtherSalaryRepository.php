<?php

namespace App\Repository;

use App\Api\EmployeeOtherSalaryRepositoryInterface;
use App\Models\EmployeeOtherSalary;

class EmployeeOtherSalaryRepository implements  EmployeeOtherSalaryRepositoryInterface
{
    protected $_EmployeeOtherSalaryModels;

    /**
     * EmployeeOtherSalaryRepository constructor.
     * @param EmployeeOtherSalary $employeeOtherSalary
     */
    public function __construct(EmployeeOtherSalary $employeeOtherSalary)
    {
        $this->_EmployeeOtherSalaryModels = $employeeOtherSalary;
    }

    /**
     * @param $userId
     * @param $employeeId
     * @param $OtherSalaryId
     * @param $companyId
     * @return EmployeeOtherSalary
     */
    public function createEmployeeOtherSalary($userId, $employeeId, $OtherSalaryId, $companyId)
    {
      return $this->_EmployeeOtherSalaryModels->create([
         "user_id"=>$userId,"employee_id"=>$employeeId,"other_salary_id"=>$OtherSalaryId,"company_id"=>$companyId
      ]);
    }

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return EmployeeOtherSalary
     */
    public function getEmployeeOtherSalaryByEmployeeId($employeeId, $companyId)
    {
      return $this->_EmployeeOtherSalaryModels->where("employee_id",$employeeId)->where("company_id",$companyId)->get();
    }

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return EmployeeOtherSalary
     */
    public function DeleteEmployeeOtherSalary($employeeId, $companyId)
    {
      return $this->_EmployeeOtherSalaryModels->where("employee_id",$employeeId)->where("company_id",$companyId)->delete();
    }

    /**
     * @param int $companyId
     * @return EmployeeOtherSalary
     */
    public function getEmployeeOtherSalary($companyId)
    {
        return $this->_EmployeeOtherSalaryModels->where("company_id",$companyId)->where("status",0)->get();
    }



}
