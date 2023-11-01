<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MainTestSeeder extends Seeder
{
    public function run()
    {
        $this->call('FileSeeder');

        $this->call('CategorySeeder');

        $this->call('CategoryTagSeeder');

        $this->call('CertificateSeeder');

        $this->call('MeasurementSolutionSeeder');

        $this->call('HomePageSeeder');

        $this->call('ProductSeeder');

        $this->call('ProductFileSeeder');

        $this->call('ProductTagSeeder');

        $this->call('ProductCategoryTagSeeder');

        $this->call('EmailTypeSeeder');

        $this->call('UserSeeder');
    }
}
