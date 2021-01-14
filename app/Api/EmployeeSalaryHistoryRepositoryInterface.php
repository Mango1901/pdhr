<?php

namespace App\Api;

Interface EmployeeSalaryHistoryRepositoryInterface
{
    /**
     * @param int $userId
     * @param int $salaryId
     * @param string $startDate
     * @param string $endDate
     * @param $companyId
     * @return mixed
     */
    public function createEmployeeSalaryHistory($userId,$salaryId,$startDate,$endDate,$companyId);
}
