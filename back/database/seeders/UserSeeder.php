<?php
    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\User;
    use Hash;

    class UserSeeder extends Seeder {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run() {
            $users = [
                [
                    'name' => 'demo',
                    'email'  => 'demo@demo.com',
                    'role'   => 1,
                    'password'  => 'demo'
                ]
            ];

            foreach ($users as $user) {
                $user['password'] = Hash::make($user['password']);
                $user = User::create($user);
            }
        }
    }
