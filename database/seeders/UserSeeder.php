<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
        {
            $data = $this->getUserData();
            foreach($data as $key => $value){
                User::create($value);
            }
        }
        private function getUserData(){
        return [
            [
                'username' => 'Shirley',
                'email'=> 'congtyphuongdong@gmail.com',
                'password'=> bcrypt('Congtyphuongdong1'),
                'roles'=>1,
                "company_id"=>1,
                "active"=>1,
            ],
            [
                'username' => 'huyenbon99',
                'email'=> 'huyenbon99@gmail.com',
                'password'=> bcrypt('Congtyphuongdong1'),
                'roles'=>1,
                "company_id"=>2,
                "active"=>1,
            ],
        ];
    }
}
