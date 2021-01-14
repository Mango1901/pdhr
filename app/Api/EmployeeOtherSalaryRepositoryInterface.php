<?php

namespace App\Api;

use App\Models\EmployeeOtherSalary;

Interface EmployeeOtherSalaryRepositoryInterface
{
    /**
     * @param $userId
     * @param $employeeId
     * @param $OtherSalaryId
     * @param $companyId
     * @return EmployeeOtherSalary
     */
    public function createEmployeeOtherSalary($userId,$employeeId,$OtherSalaryId,$companyId);

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return EmployeeOtherSalary
     */
    public function getEmployeeOtherSalaryByEmployeeId($employeeId,$companyId);

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return EmployeeOtherSalary
     */
    public function DeleteEmployeeOtherSalary($employeeId,$companyId);

    /**
     * @param int $companyId
     * @return EmployeeOtherSalary
     */
    public function getEmployeeOtherSalary($companyId);
}
