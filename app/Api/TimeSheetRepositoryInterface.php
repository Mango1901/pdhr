<?php

namespace App\Api;

use App\Models\TimeSheet;

Interface TimeSheetRepositoryInterface
{
    /**
     * @param int $companyId
     * @return TimeSheet
     */
    public function getAllTimeSheet($companyId);

    /**
     * @param int $id
     * @param string $inDate
     * @param string $outDate
     * @param int $companyId
     * @return TimeSheet
     */
    public function UpdateDateTimeSheet($id,$inDate,$outDate,$companyId);

    /**
     * @param string $date
     * @param int $companyId
     * @return TimeSheet
     */
    public function getTimeSheetByDate($date,$companyId);

    /**
     * @param string $searchAccount
     * @param int $companyId
     * @return TimeSheet
     */
    public function getTimeSheetByEmployeeNameAndEmail($searchAccount,$companyId);
}
