<?php

namespace App\Api;

use App\Models\DepartmentEmployment;

Interface DepartmentEmployeeRepositoryInterface
{
    /**
     * @param int $userId
     * @param int $departmentId
     * @param int $employeeId
     * @param int $companyId
     * @return DepartmentEmployment
     */
    public function createDepartmentEmployee($userId,$departmentId,$employeeId,$companyId);

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return DepartmentEmployment
     */
    public function getDepartmentEditByEmployee($employeeId,$companyId);

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return DepartmentEmployment
     */
    public function DeleteDepartmentEmployee($employeeId,$companyId);

    /**
     * @param int $companyId
     * @return DepartmentEmployment
     */
    public function getDepartmentEmployee($companyId);

}
