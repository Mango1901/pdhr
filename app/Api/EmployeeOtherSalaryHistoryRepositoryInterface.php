<?php

namespace App\Api;

use App\Models\Employee;
use App\Models\EmployeeOtherSalaryHistory;

Interface EmployeeOtherSalaryHistoryRepositoryInterface
{
    /**
     * @param int $userId
     * @param int $employeeId
     * @param int $otherSalaryId
     * @param string $value
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function updateEmployeeOtherSalaryHistory($userId,$employeeId, $otherSalaryId, $value,$companyId);

    /**
     * @param int $employeeId
     * @param int $otherSalaryId
     * @param string $value
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function UpdateEmployeeOtherSalaryValue($employeeId,$otherSalaryId,$value,$companyId);

    /**
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function getAllEmployeeOtherSalaryHistory($companyId);

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function DeleteEmployeeOtherSalaryHistory($employeeId,$companyId);

    /**
     * @param int $employeeId
     * @param int $otherSalaryId
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function DeleteEmployeeOtherSalaryHistoryByOtherSalary($employeeId,$otherSalaryId,$companyId);

    /**
     * @param int $employeeId
     * @param int $otherSalaryId
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function ActiveEmployeeOtherSalaryHistoryByOtherSalary($employeeId,$otherSalaryId,$companyId);

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function getEmployeeOtherSalaryHistoryByEmployeeId($employeeId,$companyId);

    /**
     * @param int $companyId
     * @return EmployeeOtherSalaryHistory
     */
    public function getAllEmployeeOtherSalaryHistoryWithoutStatus($companyId);


}
