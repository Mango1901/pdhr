<?php

namespace App\Api;
use App\Models\Employee;
Interface EmployeeRepositoryInterface
{
    /**
     * @param int $companyId
     * @return Employee
     */
    public function getAllEmployee($companyId);

    /**
     * @param int $userId
     * @param string $full_name
     * @param string $date_of_birth
     * @param int $phone_number
     * @param int $idCard
     * @param string $address
     * @param int $companyId
     * @param string $avatar
     * @param int $salaryId
     * @param int $salaryValue
     * @param string $inDate
     * @param string $outDate
     * @param int $insuranceId
     * @return Employee
     */
    public function CreateEmployee($userId,$full_name, $date_of_birth, $phone_number,$idCard,$address, $companyId,$avatar,$salaryId,$salaryValue,$inDate,$outDate,$insuranceId);

    /**
     * @param int $userId
     * @param string $full_name
     * @param string $date_of_birth
     * @param int $phone_number
     * @param int $idCard
     * @param string $address
     * @param int $companyId
     * @param int $salaryId
     * @param int $salaryValue
     * @param string $inDate
     * @param string $outDate
     * @param int $insuranceId
     * @return Employee
     */
    public function CreateEmployeeWithoutAvatar($userId,$full_name, $date_of_birth, $phone_number,$idCard,$address, $companyId,$salaryId,$salaryValue,$inDate,$outDate,$insuranceId);

    /**
     * @param int $companyId
     * @param int $phone_number
     * @return Employee
     */
    public function CheckPhoneExist($companyId,$phone_number);

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return Employee
     */
    public function checkEmployeeEditByUser($employeeId,$companyId);

    /**
     * @param int $id
     * @return Employee
     */
    public function getEmployeeById($id);

    /**
     * @param int $id
     * @param int $companyId
     * @param int $phone_number
     * @return Employee
     */
    public function CheckPhoneUpdateExist($id,$companyId,$phone_number);

    /**
     * @param int $id
     * @param int $userId
     * @param string $full_name
     * @param string $date_of_birth
     * @param int $phone_number
     * @param int $idCard
     * @param string $address
     * @param string $avatar
     * @param int $salaryId
     * @param int $salaryValue
     * @param string $inDate
     * @param string $outDate
     * @param int $insuranceId
     * @return Employee
     */
    public function UpdateEmployee($id,$userId,$full_name, $date_of_birth, $phone_number,$idCard, $address,$avatar,$salaryId,$salaryValue,$inDate,$outDate,$insuranceId);
    /**
     * @param int $id
     * @param int $userId
     * @param string $full_name
     * @param string $date_of_birth
     * @param int $phone_number
     * @param int $idCard
     * @param string $address
     * @param int $salaryId
     * @param int $salaryValue
     * @param string $inDate
     * @param string $outDate
     * @param int $insuranceId
     * @return Employee
     */
    public function UpdateEmployeeWithoutAvatar($id,$userId,$full_name, $date_of_birth, $phone_number,$idCard, $address,$salaryId,$salaryValue,$inDate,$outDate,$insuranceId);

    /**
     * @param int $id
     * @param int $companyId
     * @return Employee
     */
    public function DeleteEmployee($id,$companyId);

    /**
     * @param int $id
     * @param int $userId
     * @param int $companyId
     * @return Employee
     */
    public function CheckUserEditExist($id,$userId,$companyId);

    /**
     * @param int $companyId
     * @param int $IdCard
     * @return Employee
     */
    public function CheckIdCardExist($companyId,$IdCard);

    /**
     * @param int $id
     * @param int $companyId
     * @param int $IdCard
     * @return Employee
     */
    public function CheckIdCardExistUpdate($id,$companyId,$IdCard);

    /**
     * @param int $userId
     * @param int $companyId
     * @return Employee
     */
    public function getEmployeeByUserId($userId,$companyId);

    /**
     * @param int $salaryId
     * @param int $companyId
     * @return Employee
     */
    public function getEmployeeBYSalaryId($salaryId,$companyId);

    /**
     * @param int $salaryId
     * @param int $companyId
     * @param int $salaryValue
     * @return Employee
     */
    public function UpdateEmployeeSalaryValue($salaryId,$companyId,$salaryValue);

    /**
     * @param string $information
     * @param string $companyId
     * @return Employee
     */
    public function getAllEmployeeBySearchReport($information,$companyId);
}
