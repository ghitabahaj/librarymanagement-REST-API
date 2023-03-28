<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            ['name'=>'cud livre'],
            ['name'=>'cud genre'],
            ['name'=>'filter livre'],
            ['name'=>'show livre'],
            ['name'=>'assign role'],



        ];
        foreach($permissions as $per){
            Permission::create($per);
        }
    }
}
