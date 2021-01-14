<?php

namespace App\Api;

Interface CompanyRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getCompanyById($id);
}
