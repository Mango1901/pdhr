<?php

namespace App\Repository;

use App\Api\EmployeeOtherSalaryHistoryRepositoryInterface;
use App\Api\EmployeeRewardHistoryRepositoryInterface;
use App\Models\EmployeeRewardsHistory;
use phpDocumentor\Reflection\File;

class EmployeeRewardHistoryRepository implements EmployeeRewardHistoryRepositoryInterface
{
    protected $_EmployeeRewardsHistoryModels;

    public function __construct(EmployeeRewardsHistory $employeeRewardsHistory)
    {
        $this->_EmployeeRewardsHistoryModels =$employeeRewardsHistory;
    }

    /**
     * @param int $userId
     * @param int $employeeId
     * @param int $rewardId
     * @param int $companyId
     * @return EmployeeRewardsHistory
     */
    public function createEmployeeRewards($userId, $employeeId, $rewardId, $companyId)
    {
        return $this->_EmployeeRewardsHistoryModels->create([
           "user_id"=>$userId,"employee_id"=>$employeeId,"rewards_id"=>$rewardId,"company_id"=>$companyId
        ]);
    }

    /**
     * @param int $companyId
     * @return EmployeeRewardsHistory
     */
    public function getAllEmployeeRewards($companyId)
    {
       return $this->_EmployeeRewardsHistoryModels->orderBy("id","DESC")->where("company_id",$companyId)->where("status",0)->get();
    }

    public function CheckEmployeeRewardsExists($employeeId, $companyId)
    {
       return $this->_EmployeeRewardsHistoryModels->where("employee_id",$employeeId)->where("company_id",$companyId)->first();
    }

    public function DeleteEmployeeRewards($employeeId, $companyId)
    {
        return $this->_EmployeeRewardsHistoryModels->where("employee_id",$employeeId)->where("company_id",$companyId)->delete();
    }


}
