<?php

use Illuminate\Database\Seeder;
use App\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->username="syafrin12";
        $admin->name="syafrin ibrahim";
        $admin->email="syafrinibrahim12@gmail.com";
        $admin->roles=json_encode(["ADMIN"]);
        $admin->password= \Hash::make("pakatuan12");
        $admin->avatar= "pakatuan12.png";
        $admin->address= "jl panjaitan";
        $admin->phone= "082197215585";
        $admin->save();
        $this->command->info("Admin Berhasil Di Insert");

    }
}
