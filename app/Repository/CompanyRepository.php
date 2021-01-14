<?php

namespace App\Repository;

use App\Api\CompanyRepositoryInterface;
use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    protected $_CompanyModels;

    public function __construct(Company $company)
    {
        $this->_CompanyModels = $company;
    }

    public function getCompanyById($id)
    {
        return $this->_CompanyModels->where("id",$id)->where("status",0)->first();
    }


}
