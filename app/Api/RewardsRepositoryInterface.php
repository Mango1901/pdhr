<?php

namespace App\Api;

use App\Models\Reward;
use Brick\Math\BigInteger;

Interface RewardsRepositoryInterface
{
    /**
     * @param $companyId
     * @return Reward
     */
    public function getAllRewards($companyId);

    /**
     * @param $userId
     * @param $name
     * @param $value
     * @param $companyId
     * @return Reward
     */
    public function createRewards($userId,$name,$value,$companyId);

    /**
     * @param int $id
     * @return Reward
     */
    public function getRewardsById($id);

    /**
     * @param int $id
     * @param string $name
     * @param BigInteger $value
     * @return Reward
     */
    public function UpdateRewards($id,$name,$value);

    /**
     * @param int $id
     * @param int $companyId
     * @return Reward
     */
    public function DeleteRewards($id,$companyId);
}
