<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \DB::table('organizations')->delete();
        
        \DB::table('organizations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Michael E. Quinn',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Riverside',
                'state' => 'California',
                'partner_type' => 'Partner',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'IdeaMaker',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Nevada',
                'state' => 'Henderson',
                'partner_type' => 'Integrator',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Flutter',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Tampa',
                'state' => 'Florida',
                'partner_type' => 'Partner',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'React',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Miami',
                'state' => 'Florida',
                'partner_type' => 'Integrator',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Vue',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Atlanta',
                'state' => 'Georgia',
                'partner_type' => 'Partner',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Python',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Mesa',
                'state' => 'Arizona',
                'partner_type' => 'Integrator',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'PHP',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Denver',
                'state' => 'Colorado',
                'partner_type' => 'Customer',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'C++',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Seattle',
                'state' => 'Washington',
                'partner_type' => 'Partner',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'JSP',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Austin',
                'state' => 'Texas',
                'partner_type' => 'Integrator',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Java',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'Phoenix',
                'state' => 'Arizona',
                'partner_type' => 'Customer',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'IOS',
                'address1' => '300 Robert street',
                'address2' => '',
                'city' => 'San Jose',
                'state' => 'California',
                'partner_type' => 'Partner',
            ),
        ));
    }
}
