<?php

use Illuminate\Database\Seeder;

class CommercialAuctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\CommercialAuction::class, 15)->create();
    }
}
