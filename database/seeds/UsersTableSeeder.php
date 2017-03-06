<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = factory(User::class)->times(250)->make();
        User::insert($users->toArray());

        $user = User::find(1);
        $user->name = 'Admin';
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('adminpassword');
        $user->is_admin = true;
        $user->save();

        DB::table('users')
                    ->where('id', '<>', 1)
                    ->update(['password' => bcrypt('secret')]);
    }
}
