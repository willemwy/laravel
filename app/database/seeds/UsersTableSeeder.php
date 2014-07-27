<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
			User::create(array(
                "name" => 'Willem',
                "surname" => 'Wyk',
                "email" => 'willem@ordercloud.co.za',
                "fb_id" => '10153023968789552',
                '10153023968789552.jpg'
            ));
    }

}
