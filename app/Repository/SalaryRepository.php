<?php

namespace App\Repository;

use App\Api\SalaryRepositoryInterface;
use App\Models\Salary;

class SalaryRepository implements SalaryRepositoryInterface
{
    protected $_SalaryModels;

    /**
     * SalaryRepository constructor.
     * @param Salary $salary
     */
    public function __construct(Salary $salary)
    {
        $this->_SalaryModels = $salary;
    }

    /**
     * @param int $userId
     * @param int $companyId
     * @param string $name
     * @param int $level
     * @param int $value
     * @param int $type
     * @return Salary
     */
    public function createSalary($userId, $companyId, $name, $level, $value,$type)
    {
        return $this->_SalaryModels->create([
            "user_id"=>$userId,"company_id"=>$companyId,"name"=>$name,"level"=>$level,"value"=>$value,"type"=>$type
         ]);
    }

    /**
     * @param int $companyId
     * @return Salary
     */
    public function getAllSalary($companyId)
    {
      return $this->_SalaryModels->where("company_id",$companyId)->where("status",0)->get();
    }

    /**
     * @param int $id
     * @return Salary
     */
    public function getSalaryById($id)
    {
        return $this->_SalaryModels->where("id",$id)->where("status",0)->first();
    }

    /**
     * @param int $id
     * @param string $name
     * @param int $level
     * @param int $value
     * @param int $type
     * @return Salary
     */
    public function UpdateSalary($id,$name, $level, $value,$type)
    {
       return $this->_SalaryModels->where("id",$id)->update([
          "name"=>$name,"level"=>$level,"value"=>$value,"type"=>$type
       ]);
    }

    public function DeleteSalary($id, $companyId)
    {
       return $this->_SalaryModels->where("id",$id)->where("company_id",$companyId)->update(["status"=>1]);
    }

    public function getEditSalary($id, $companyId)
    {
      return $this->_SalaryModels->orderBy("id","DESC")->where("company_id",$companyId)->whereNotIn("id",[$id])->where("status",0)->get();
    }

}
