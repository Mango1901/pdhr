<?php

namespace App\Repository;

use App\Api\InsuranceRepositoryInterface;
use App\Models\Insurance;

class InsuranceRepository implements  InsuranceRepositoryInterface
{
    protected $_InsuranceModels;

    /**
     * InsuranceRepository constructor.
     * @param Insurance $insurance
     */
    public function __construct(Insurance $insurance)
    {
        $this->_InsuranceModels = $insurance;
    }

    /**
     * @param int $companyId
     * @return Insurance
     */
    public function getInsurance($companyId)
    {
       return $this->_InsuranceModels->orderBy("id","DESC")->where("company_id",$companyId)->where("status",0)->get();
    }

    public function createInsurance($userId, $percent, $date, $companyId)
    {
       return $this->_InsuranceModels->create([
          "user_id"=>$userId,"percent"=>$percent,"date"=>$date,"company_id"=>$companyId
       ]);
    }

    /**
     * @param int $id
     * @return Insurance
     */
    public function getInsuranceById($id)
    {
        return $this->_InsuranceModels->where("id",$id)->where("status",0)->first();
    }

    public function UpdateInsurance($id, $percent, $date)
    {
      return $this->_InsuranceModels->where("id",$id)->update([
         "percent"=>$percent,"date"=>$date
      ]);
    }

    /**
     * @param int $id
     * @param int $companyId
     * @return Insurance
     */
    public function DeleteInsurance($id, $companyId)
    {
       return $this->_InsuranceModels->where("id",$id)->where("company_id",$companyId)->update(["status"=>1]);
    }

    public function getEditInsurance($id, $companyId)
    {
      return $this->_InsuranceModels->orderBy("id","DESC")->where("company_id",$companyId)->whereNotIn("id",[$id])->get();
    }


}
