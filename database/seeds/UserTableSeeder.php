<?php
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('email', 'yanpainglin154@gmail.com')->first();


        if(!$users){
            User::create([
                'name'=>'Yan Paing Linn',
                'email' => 'yanpainglin154@gmail.com',
                'role'=> 'admin',
                'password'=> Hash::make('paing3746')
            ]);
        }
    }
}
