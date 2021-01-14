<?php

namespace App\Api;

use App\Models\Department;

Interface DepartmentRepositoryInterface
{
    /**
     * @param int $companyId
     * @return Department
     */
    public function getAllDepartment($companyId);

    /**
     * @param int $userId
     * @param string $name
     * @param string $description
     * @param int $companyId
     * @return Department
     */
    public function createDepartment($userId,$name,$description,$companyId);

    /**
     * @param int $id
     * @return Department
     */
    public function getDepartmentById($id);

    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @return Department
     */
    public function UpdateDepartment($id,$name, $description);

    /**
     * @param $id
     * @param $companyId
     * @return Department
     */
    public function DeleteDepartment($id,$companyId);

    /**
     * @param int $id
     * @param int $companyId
     * @return Department
     */
    public function getDepartmentEdit($id,$companyId);

}
