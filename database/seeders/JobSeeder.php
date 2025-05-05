<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        $jobs = [
            ['name' => 'orga',       'label' => 'Orga'],
            ['name' => 'management', 'label' => 'Management'],
            ['name' => 'dj',         'label' => 'DJ'],
            ['name' => 'lj',         'label' => 'LJ'],
            ['name' => 'ton',        'label' => 'Tontechnik'],
        ];

        foreach ($jobs as $data) {
            Job::updateOrCreate(
                ['name' => $data['name']],
                ['label' => $data['label']]
            );
        }
    }
}
