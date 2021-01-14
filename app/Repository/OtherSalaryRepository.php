<?php

namespace App\Repository;

use App\Api\OtherSalaryRepositoryInterface;
use App\Models\OtherSalary;

class OtherSalaryRepository implements OtherSalaryRepositoryInterface
{
    protected $_OtherSalaryModels;

    /**
     * OtherSalaryRepository constructor.
     * @param OtherSalary $otherSalary
     */
    public function __construct(OtherSalary $otherSalary)
    {
        $this->_OtherSalaryModels = $otherSalary;
    }

    /**
     * @param int $companyId
     * @return OtherSalary
     */
    public function getAllOtherSalary($companyId)
    {
      return $this->_OtherSalaryModels->orderBy("id","DESC")->where("company_id",$companyId)->where("status",0)->get();
    }

    /**
     * @param int $userId
     * @param string $name
     * @param string $money
     * @param string $type
     * @param int $value
     * @param int $companyId
     * @return OtherSalary
     */
    public function CreateOtherSalary($userId, $name, $money, $type, $value, $companyId)
    {
      return $this->_OtherSalaryModels->create([
         "user_id"=>$userId,"name"=>$name,"money"=>$money,"type"=>$type,"value"=>$value,"company_id"=>$companyId
      ]);
    }

    /**
     * @param int $id
     * @return OtherSalary
     */
    public function getEditOtherSalary($id)
    {
      return $this->_OtherSalaryModels->where("id",$id)->where("status",0)->first();
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $money
     * @param int $type
     * @param int $value
     * @return OtherSalary|bool
     */
    public function UpdateOtherSalary($id, $name, $money, $type, $value)
    {
        return $this->_OtherSalaryModels->where("id",$id)->update([
            "name"=>$name,"money"=>$money,"type"=>$type,"value"=>$value
        ]);
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return OtherSalary
     */
    public function DeleteOtherSalary($id, $companyId)
    {
       return $this->_OtherSalaryModels->where("id",$id)->where("company_id",$companyId)->update(["status"=>1]);
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return OtherSalary
     */
    public function GetValueFromEmployee($id,$companyId)
    {
       return $this->_OtherSalaryModels->where("id",$id)->where("company_id",$companyId)->first();
    }


}
