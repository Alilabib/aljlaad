<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class Adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'name'=>'Admin',
            'email'=>'admin@site.com',
            'password'=>'123456'
        ]);
    }
}
