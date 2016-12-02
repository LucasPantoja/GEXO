<?php

use Illuminate\Database\Seeder;

class InvitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invites')->insert([
        	'key' => '098765432109876543210987654321'
        	]);
    }
}
