<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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


        $this->assignLeaveBalances($manager);

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
