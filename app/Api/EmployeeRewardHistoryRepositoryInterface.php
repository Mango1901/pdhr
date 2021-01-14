<?php

namespace App\Api;

use App\Models\EmployeeRewardsHistory;

Interface EmployeeRewardHistoryRepositoryInterface
{
    /**
     * @param int $userId
     * @param int $employeeId
     * @param int $rewardId
     * @param int $companyId
     * @return EmployeeRewardsHistory
     */
    public function createEmployeeRewards($userId,$employeeId,$rewardId,$companyId);

    /**
     * @param int $companyId
     * @return EmployeeRewardsHistory
     */
    public function getAllEmployeeRewards($companyId);

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return EmployeeRewardsHistory
     */
    public function CheckEmployeeRewardsExists($employeeId,$companyId);

    /**
     * @param $employeeId
     * @param $companyId
     * @return EmployeeRewardsHistory
     */
    public function DeleteEmployeeRewards($employeeId,$companyId);
}
