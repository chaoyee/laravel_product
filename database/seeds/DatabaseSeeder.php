<?php

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
        // $this->call(UsersTableSeeder::class);
    	  // 
    $arrayOfSeed = [
      ['id' => 1, 'prod_name' => 'A1000', 'prod_desc' => '26\"x21\" MTB Orange', 'prod_price' => 12000 , 'prod_qty' => 22],  
      ['id' => 2, 'prod_name' => 'A1100', 'prod_desc' => '26\"x19\" MTB Silver', 'prod_price' => 12300 , 'prod_qty' => 21],
      ['id' => 3, 'prod_name' => 'A1200', 'prod_desc' => '26\"x17\" MTB Black', 'prod_price' => 13000 , 'prod_qty' => 5],
      ['id' => 4, 'prod_name' => 'A1300', 'prod_desc' => '26\"x22\" MTB Red', 'prod_price' => 12300 , 'prod_qty' => 8],
      ['id' => 5, 'prod_name' => 'A1400', 'prod_desc' => '26\"x23\" MTB Blue/White', 'prod_price' => 13000 , 'prod_qty' => 6],
      ['id' => 6, 'prod_name' => 'A1500', 'prod_desc' => '26\"x23\" MTB Purple/White', 'prod_price' => 13000 , 'prod_qty' => 12],
      ['id' => 7, 'prod_name' => 'A1600', 'prod_desc' => '26\"x23\" MTB Black/White', 'prod_price' => 13000 , 'prod_qty' => 8],
      ['id' => 8, 'prod_name' => 'A1700', 'prod_desc' => '26\"x23\" MTB Gray/Black', 'prod_price' => 13000 , 'prod_qty' => 4],
      ['id' => 9, 'prod_name' => 'A1800', 'prod_desc' => '26\"x24\" MTB Yellow', 'prod_price' => 13000 , 'prod_qty' => 5],
      ['id' => 10, 'prod_name' => 'A1900', 'prod_desc' => '26\"x24\" MTB Black', 'prod_price' => 13000 , 'prod_qty' => 12],
      ['id' => 11, 'prod_name' => 'A2000', 'prod_desc' => '26\"x21\" MTB lady Orange', 'prod_price' => 12000 , 'prod_qty' => 10],
      ['id' => 12, 'prod_name' => 'A2100', 'prod_desc' => '26\"x19\" MTB lady Silver', 'prod_price' => 12300 , 'prod_qty' => 11]  
    ];
    DB::table('products')->insert($arrayOfSeed);
    }
}
