<?php

use Illuminate\Database\Seeder;
use App\Model\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries      = file_exists(public_path("countries.json"))? 
                        file_get_contents(public_path("countries.json")): [];
        $country_arr    = json_decode($countries, 1);

        foreach ($country_arr as $countys) {
            foreach($countys as $data)
			    Country::create($data);
		}
    }
}
