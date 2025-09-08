<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MtMenuSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // --- Parent: Master ---
        $masterId = DB::table('mt_menu')->updateOrInsert(
            ['name' => 'Master', 'parent_id' => null],
            [
                'url'        => '#',
                'icon'       => 'folder',
                'order'      => 1,
                'is_active'  => true,
                'pic_input'  => 'system',
                'input_time' => $now,
            ]
        );

        // Ambil ID Master
        $masterId = DB::table('mt_menu')->where('name', 'Master')->value('menu_id');

        // --- Child: Master Salary ---
        DB::table('mt_menu')->updateOrInsert(
            ['name' => 'Master Salary', 'parent_id' => $masterId],
            [
                'url'        => '/master/salary',
                'icon'       => 'file',
                'order'      => 1,
                'is_active'  => true,
                'pic_input'  => 'system',
                'input_time' => $now,
            ]
        );

        // --- Child: Master Config Allowance ---
        DB::table('mt_menu')->updateOrInsert(
            ['name' => 'Master Config Allowance', 'parent_id' => $masterId],
            [
                'url'        => '/master/config-allowance',
                'icon'       => 'file',
                'order'      => 2,
                'is_active'  => true,
                'pic_input'  => 'system',
                'input_time' => $now,
            ]
        );

        // --- Parent: Transaction ---
        DB::table('mt_menu')->updateOrInsert(
            ['name' => 'Transaction', 'parent_id' => null],
            [
                'url'        => '#',
                'icon'       => 'folder',
                'order'      => 2,
                'is_active'  => true,
                'pic_input'  => 'system',
                'input_time' => $now,
            ]
        );

        // Ambil ID Transaction
        $transactionId = DB::table('mt_menu')->where('name', 'Transaction')->value('menu_id');

        // --- Child: Payroll Process ---
        DB::table('mt_menu')->updateOrInsert(
            ['name' => 'Payroll Process', 'parent_id' => $transactionId],
            [
                'url'        => '/transaction/payroll-process',
                'icon'       => 'file',
                'order'      => 1,
                'is_active'  => true,
                'pic_input'  => 'system',
                'input_time' => $now,
            ]
        );
    }
}
