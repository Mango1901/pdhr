<?php

namespace App\Repository;

use App\Api\EmployeeRepositoryInterface;
use App\Models\Employee;
use App\Models\User;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $_EmployeeModels;

    /**
     * EmployeeRepository constructor.
     * @param Employee $employee
     */
    public function __construct(Employee $employee)
    {
        $this->_EmployeeModels = $employee;
    }

    /**
     * @param int $companyId
     * @return Employee
     */
    public function getAllEmployee($companyId)
    {
        return $this->_EmployeeModels->orderBy("id","DESC")->where("company_id",$companyId)->where("status",0)->get();
    }

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
     * @param $inDate
     * @param $outDate
     * @param $insuranceId
     * @return Employee
     */
    public function CreateEmployee($userId,$full_name, $date_of_birth, $phone_number,$idCard,$address, $companyId,$avatar,$salaryId,$salaryValue,$inDate,$outDate,$insuranceId){
        return $this->_EmployeeModels->create(
            array("user_id"=>$userId,"full_name"=>$full_name,"date_of_birth"=>$date_of_birth,"ID_card"=>$idCard,"salary_value"=>$salaryValue,
            "phone_number"=>$phone_number,"address"=>$address,"company_id"=>$companyId,"avatar"=>$avatar,"salary_id"=>$salaryId,"in_date"=>$inDate,"out_date"=>$outDate,"insurance_id"=>$insuranceId)
        );
    }

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
     * @param $outDate
     * @param $insuranceId
     * @return Employee
     */
    public function CreateEmployeeWithoutAvatar($userId, $full_name, $date_of_birth, $phone_number,$idCard, $address, $companyId, $salaryId,$salaryValue, $inDate, $outDate, $insuranceId)
    {
        return $this->_EmployeeModels->create(
            array("user_id"=>$userId,"full_name"=>$full_name,"date_of_birth"=>$date_of_birth,"ID_card"=>$idCard,"salary_value"=>$salaryValue,
                "phone_number"=>$phone_number,"address"=>$address,"company_id"=>$companyId,"salary_id"=>$salaryId,"in_date"=>$inDate,"out_date"=>$outDate,"insurance_id"=>$insuranceId)
        );
    }


    /**
     * @param int $companyId
     * @param int $phone_number
     * @return Employee
     */
    public function CheckPhoneExist($companyId,$phone_number)
    {
        return $this->_EmployeeModels->where("phone_number",$phone_number)->where("company_id",$companyId)->where("status",0)->first();
    }

    /**
     * @param int $employeeId
     * @param int $companyId
     * @return Employee
     */
    public function checkEmployeeEditByUser($employeeId,$companyId)
    {
       return $this->_EmployeeModels->orderBy("id","DESC")->where("company_id",$companyId)->whereNotIn("id",[$employeeId])->where("status",0)->get();
    }

    /**
     * @param int $id
     * @return Employee
     */
    public function getEmployeeById($id)
    {
       return $this->_EmployeeModels->where("id",$id)->where("status",0)->first();
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param int $phone_number
     * @return Employee
     */
    public function CheckPhoneUpdateExist($id, $companyId, $phone_number)
    {
      return $this->_EmployeeModels->where("company_id",$companyId)->where("phone_number",$phone_number)->whereNotIn("id",[$id])->where("status",0)->first();
    }

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
     * @param $inDate
     * @param $outDate
     * @param $insuranceId
     * @return Employee
     */

    public function UpdateEmployee($id,$userId, $full_name, $date_of_birth,$phone_number,$idCard, $address,$avatar,$salaryId,$salaryValue,$inDate,$outDate,$insuranceId)
    {
       return $this->_EmployeeModels->where("id",$id)->update([
           "user_id"=>$userId,"full_name"=>$full_name,"date_of_birth"=>$date_of_birth,"avatar"=>$avatar,"ID_card"=>$idCard,"salary_value"=>$salaryValue,
           "phone_number"=>$phone_number,"address"=>$address,"salary_id"=>$salaryId,"in_date"=>$inDate,"out_date"=>$outDate,"insurance_id"=>$insuranceId
       ]);
    }

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
     * @param $outDate
     * @param $insuranceId
     * @return Employee
     */
    public function UpdateEmployeeWithoutAvatar($id, $userId, $full_name, $date_of_birth, $phone_number,$idCard, $address, $salaryId,$salaryValue, $inDate, $outDate, $insuranceId)
    {
        return $this->_EmployeeModels->where("id",$id)->update([
            "user_id"=>$userId,"full_name"=>$full_name,"date_of_birth"=>$date_of_birth,"ID_card"=>$idCard,"salary_value"=>$salaryValue,
            "phone_number"=>$phone_number,"address"=>$address,"salary_id"=>$salaryId,"in_date"=>$inDate,"out_date"=>$outDate,"insurance_id"=>$insuranceId
        ]);
    }


    /**
     * @param int $id
     * @param int $companyId
     * @return Employee
     */

    public function DeleteEmployee($id, $companyId)
    {
       return $this->_EmployeeModels->where("id",$id)->where("company_id",$companyId)->update(["status"=>1]);
    }

    /**
     * @param int $id
     * @param int $userId
     * @param int $companyId
     * @return Employee
     */
    public function CheckUserEditExist($id, $userId, $companyId)
    {
      return $this->_EmployeeModels->whereNotIn("id",[$id])->where("user_id",$userId)->where("company_id",$companyId)->first();
    }

    /**
     * @param int $companyId
     * @param int $IdCard
     * @return Employee
     */
    public function CheckIdCardExist($companyId, $IdCard)
    {
      return $this->_EmployeeModels->where("company_id",$companyId)->where("ID_card",$IdCard)->where("status",0)->first();
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param int $IdCard
     * @return Employee
     */
    public function CheckIdCardExistUpdate($id, $companyId, $IdCard)
    {
      return $this->_EmployeeModels->whereNotIn("id",[$id])->where("company_id",$companyId)->where("ID_card",$IdCard)->where("status",0)->first();
    }

    /**
     * @param int $userId
     * @param int $companyId
     * @return Employee
     */
    public function getEmployeeByUserId($userId, $companyId)
    {
      return $this->_EmployeeModels->where("user_id",$userId)->where("company_id",$companyId)->first();
    }

    public function getEmployeeBYSalaryId($salaryId, $companyId)
    {
      return $this->_EmployeeModels->where("salary_id",$salaryId)->where("company_id",$companyId)->where("status",0)->first();
    }

    /**
     * @param int $salaryId
     * @param int $companyId
     * @param int $salaryValue
     * @return Employee
     */
    public function UpdateEmployeeSalaryValue($salaryId, $companyId,$salaryValue)
    {
      return $this->_EmployeeModels->where("salary_id",$salaryId)->where("company_id",$companyId)->update(["salary_value"=>$salaryValue]);
    }

    public function getAllEmployeeBySearchReport($information, $companyId)
    {
        return $this->_EmployeeModels->orderBy("id","DESC")->where("full_name","like","%$information%")->where("company_id",$companyId)->where("status",0)->get();
    }


}
