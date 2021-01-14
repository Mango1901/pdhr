<?php

namespace App\Api;

use App\Models\Salary;

Interface SalaryRepositoryInterface
{
    /**
     * @param int $companyId
     * @return Salary
     */
    public function getAllSalary($companyId);


    /**
     * @param int $userId
     * @param int $companyId
     * @param string $name
     * @param int $level
     * @param int $value
     * @param int $type
     * @return Salary
     */
    public function createSalary($userId,$companyId,$name,$level,$value,$type);

    /**
     * @param int $id
     * @return Salary
     */
    public function getSalaryById($id);

    /**
     * @param int $id
     * @param string $name
     * @param int $level
     * @param int $value
     * @param int $type
     * @return Salary
     */
    public function UpdateSalary($id,$name,$level,$value,$type);

    /**
     * @param int $id
     * @param int $companyId
     * @return Salary
     */
    public function DeleteSalary($id,$companyId);

    /**
     * @param int $id
     * @param int $companyId
     * @return Salary
     */
    public function getEditSalary($id,$companyId);
}
