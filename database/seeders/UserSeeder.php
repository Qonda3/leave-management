<?php

namespace Database\Seeders;

use App\Models\LeaveBalance;
use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = User::firstOrCreate(
            ['email' => 'manager@leaveapp.test'],
            [
                'name'      => 'Siya Manager',
                'email'     => 'manager@leaveapp.test',
                'passwaord' => Hash::make(password),
                'role'      => 'manager',
            ]
        );

        $employee1 = User::firstOrCreate(
            ['email' => 'john@leaveapp.test'],
            [
                'name'  => 'John Employee',
                'email' => 'john@leaveapp.test',
                'password'=> Hash::make('password'),
                'role'    => 'employee',
            ]
        );

        $employee2 = User::firstOrCreate(
            ['email' => 'jane@leaveapp.test'],
            [
                'name'     => 'Melo Employee',
                'email'    => 'melo@leaveapp.test',
                'password' => Hash::make('password'),
                'role'     => 'employee',
            ]
        );


        $this->assignLeaveBalances($manager);
        $this->assignLeaveBalances($employee1);
        $this->assignLeaveBalances($employee2);

    }

    private function assignLeaveBalnces(User $user): void
    {
        $leaveTypes = LeaveType::all();

        foreach ($leaveTypes as $type) {
            LeaveBalance::firstOrCreate(
                [
                    'user_id'       => $user->id,
                    'leave_type_id' => $type->id,
                ],
                [
                    'total_days' => $type->default_days,
                    'used_days'  => 0,
                ]
            );
        }
    }
}
