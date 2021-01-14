<?php

namespace App\Repository;

use App\Api\RewardsRepositoryInterface;
use App\Models\Reward;
use Brick\Math\BigInteger;

class RewardsRepository implements RewardsRepositoryInterface
{
    protected $_RewardsModels;

    public function __construct(Reward $reward)
    {
        $this->_RewardsModels = $reward;
    }

    /**
     * @param $companyId
     * @return Reward
     */
    public function getAllRewards($companyId)
    {
        return $this->_RewardsModels->where("company_id",$companyId)->where("status",0)->get();
    }

    public function createRewards($userId, $name, $value, $companyId)
    {
      return $this->_RewardsModels->create([
         "user_id"=>$userId,"name"=>$name,"value"=>$value,"company_id"=>$companyId
      ]);
    }

    /**
     * @param int $id
     * @return Reward
     */
    public function getRewardsById($id)
    {
      return $this->_RewardsModels->where("id",$id)->where("status",0)->first();
    }

    /**
     * @param int $id
     * @param string $name
     * @param BigInteger $value
     * @return Reward
     */
    public function UpdateRewards($id, $name, $value)
    {
      return $this->_RewardsModels->where("id",$id)->update([
         "name"=>$name,"value"=>$value
      ]);
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return Reward
     */
    public function DeleteRewards($id, $companyId)
    {
       return $this->_RewardsModels->where("id",$id)->where("company_id",$companyId)->update(["status"=>1]);
    }


}
