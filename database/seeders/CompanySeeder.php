<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->getCompanyData();
        foreach($data as $key => $value){
            Company::create($value);
        }
    }
    private function getCompanyData(){
        return [
            [
                'company_name' => 'Công ty phương đông',
                'email'=>'congtyphuongdong@gmail.com',
                'phone_number'=>'123456789',
                'active'=>"1",
            ],
            [
                'company_name' => 'Công ty phương đông 2',
                'email'=>'congtyphuongdong2@gmail.com',
                'phone_number'=>'123456789123',
                'active'=>"1",
            ],
        ];
    }
}
