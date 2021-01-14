<?php

namespace App\Repository;

use App\Api\DepartmentRepositoryInterface;
use App\Models\Department;

class DepartmentRepository implements  DepartmentRepositoryInterface
{
    protected $_DepartmentModels;

    /**
     * DepartmentRepository constructor.
     * @param Department $department
     */
    public function __construct(Department $department)
    {
        $this->_DepartmentModels = $department;
    }

    /**
     * @param int $companyId
     * @return Department
     */
    public function getAllDepartment($companyId)
    {
      return $this->_DepartmentModels->where("company_id",$companyId)->orderBy("id","DESC")->where("status",0)->get();
    }

    /**
     * @param int $userId
     * @param string $name
     * @param string $description
     * @param int $companyId
     * @return Department
     */
    public function createDepartment($userId,$name, $description, $companyId)
    {
      return $this->_DepartmentModels->create([
         "user_id"=>$userId,"name"=>$name,"description"=>$description,"company_id"=>$companyId
      ]);
    }

    /**
     * @param int $id
     * @return Department
     */
    public function getDepartmentById($id)
    {
      return $this->_DepartmentModels->where("id",$id)->where("status",0)->first();
    }

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @return Department
     */
    public function UpdateDepartment($id, $name, $description)
    {
      return $this->_DepartmentModels->where("id",$id)->update([
         "name"=>$name,"description"=>$description
      ]);
    }

    /**
     * @param $id
     * @param $companyId
     * @return Department
     */
    public function DeleteDepartment($id, $companyId)
    {
      return $this->_DepartmentModels->where("id",$id)->where("company_id",$companyId)->update(["status"=>1]);
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return Department
     */

    public function getDepartmentEdit($id,$companyId)
    {
        return $this->_DepartmentModels->where("company_id",$companyId)->whereNotIn("id",[$id])->get();
    }




}
