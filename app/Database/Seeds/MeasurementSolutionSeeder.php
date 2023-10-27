<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MeasurementSolutionSeeder extends Seeder
{
    public function run()
    {
        $msDescription        = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, morbi quis tempor odio.';
        $msNames              = ['Medidores Residenciales', 'Medidores Industriales', 'Medición Remota', 'Medidores Residenciales'];
        $measurementSolutions = [];

        foreach ($msNames as $msName) {
            $measurementSolutions[] = [
                'msName'        => $msName,
                'msIconId'      => 2,
                'msImageId'     => 1,
                'msDescription' => $msDescription,
            ];
        }

        $this->db->table('measurement_solutions')->insertBatch($measurementSolutions);
    }
}
