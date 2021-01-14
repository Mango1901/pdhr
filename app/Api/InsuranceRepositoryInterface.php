<?php
namespace App\Api;

use App\Models\Insurance;

Interface InsuranceRepositoryInterface
{
    /**
     * @param int $companyId
     * @return Insurance
     */
    public function getInsurance($companyId);

    /**
     * @param int $userId
     * @param int $percent
     * @param string $date
     * @param int $companyId
     * @return Insurance
     */
    public function createInsurance($userId,$percent,$date,$companyId);

    /**
     * @param int $id
     * @return Insurance
     */
    public function getInsuranceById($id);

    /**
     * @param int $id
     * @param int $percent
     * @param string $date
     * @return Insurance
     */
    public function UpdateInsurance($id,$percent,$date);

    /**
     * @param int $id
     * @param int $companyId
     * @return Insurance
     */
    public function DeleteInsurance($id,$companyId);

    /**
     * @param int $id
     * @param int $companyId
     * @return Insurance
     */
    public function getEditInsurance($id,$companyId);
}
