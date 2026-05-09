<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Annual Leave',   'default_days' => 15, 'description' => 'Yearly paid leave entitlement'],
            ['name' => 'Sick Leave',     'default_days' => 10, 'description' => 'Leave for illness or medical appointments'],
            ['name' => 'Personal Leave', 'default_days' => 3,  'description' => 'Personal matters and emergencies'],
            ['name' => 'Unpaid Leave',   'default_days' => 30, 'description' => 'Leave without pay'],
            ['name' => 'Maternity Leave','default_days' => 10, 'description' => 'Leave for new mothers'],
        ];

        foreach ($types as $type) {
            LeaveType::firstOrCreate(['name' => $type['name']], $type);
        }
    }
}
