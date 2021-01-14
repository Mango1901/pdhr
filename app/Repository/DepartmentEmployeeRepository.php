<?php

namespace App\Repository;

use App\Api\DepartmentEmployeeRepositoryInterface;
use App\Models\DepartmentEmployment;

class DepartmentEmployeeRepository implements DepartmentEmployeeRepositoryInterface
{
    protected $_DepartmentEmployeeModels;

    /**
     * DepartmentEmployeeRepository constructor.
     * @param DepartmentEmployment $departmentEmployment
     */
    public function __construct(DepartmentEmployment $departmentEmployment)
    {
        $this->_DepartmentEmployeeModels = $departmentEmployment;
    }

    /**
     * @param int $userId
     * @param int $departmentId
     * @param int $employeeId
     * @param int $companyId
     * @return DepartmentEmployment
     */
    public function createDepartmentEmployee($userId, $departmentId, $employeeId, $companyId)
    {
        return $this->_DepartmentEmployeeModels->create([
           "user_id"=>$userId,"department_id"=>$departmentId,"employee_id"=>$employeeId,"company_id"=>$companyId
        ]);
    }

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return DepartmentEmployment
     */
    public function getDepartmentEditByEmployee($employeeId, $companyId)
    {
      return $this->_DepartmentEmployeeModels->where("employee_id",$employeeId)->where("company_id",$companyId)->get();
    }

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return DepartmentEmployment
     */
    public function DeleteDepartmentEmployee($employeeId,$companyId)
    {
        return $this->_DepartmentEmployeeModels->where("employee_id",$employeeId)->where("company_id",$companyId)->delete();
    }

    /**
     * @param int $companyId
     * @return DepartmentEmployment
     */
    public function getDepartmentEmployee($companyId)
    {
     return $this->_DepartmentEmployeeModels->orderBy("id","DESC")->where("company_id",$companyId)->where("status",0)->get();
    }


}
