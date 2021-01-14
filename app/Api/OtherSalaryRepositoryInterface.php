<?php

namespace App\Api;

use App\Models\OtherSalary;

Interface OtherSalaryRepositoryInterface
{
    /**
     * @param int $companyId
     * @return OtherSalary
     */
    public function getAllOtherSalary($companyId);

    /**
     * @param int $userId
     * @param string $name
     * @param string $money
     * @param string $type
     * @param int $value
     * @param int $companyId
     * @return OtherSalary
     */
    public function CreateOtherSalary($userId,$name,$money,$type,$value,$companyId);

    /**
     * @param int $id
     * @return OtherSalary
     */
    public function getEditOtherSalary($id);

    /**
     * @param int $id
     * @param string $name
     * @param string $money
     * @param int $type
     * @param int $value
     * @return OtherSalary
     */
    public function UpdateOtherSalary($id,$name,$money,$type,$value);

    /**
     * @param int $id
     * @param int $companyId
     * @return OtherSalary
     */
    public function DeleteOtherSalary($id,$companyId);

    /**
     * @param int $id
     * @param int $companyId
     * @return OtherSalary
     */
    public function GetValueFromEmployee($id,$companyId);
}
