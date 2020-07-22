<?php

use Illuminate\Database\Seeder;
use App\Model\State;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states      = file_exists(public_path("states.json"))? 
                        file_get_contents(public_path("states.json")): [];
        $states_arr    = json_decode($states, 1);

        foreach ($states_arr as $stats) {
            if(is_array($stats)){
                foreach($stats as $data)
                    State::create($data);    
            }    
		}
    }
}
