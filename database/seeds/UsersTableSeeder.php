<?php

use Illuminate\Database\Seeder;
use App\Model\User;
//use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create admin
        $user = User::firstOrCreate([
            'name'          => 'admin',
            'username'      => 'admin',
            'password'      => Hash::make('qwezxc'),
            'roles_id'      => User::ADMIN,
        ]);

    }
}
