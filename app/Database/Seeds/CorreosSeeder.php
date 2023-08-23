<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class correoSeeder extends Seeder{
    public function run(){
        $faker = Factory::create();
        $data = [];
        
        for ($i = 0; $i < 2; $i++) {
            $contenidoCorreo = [
                "nombre" => $faker->name(),
                "telefono"=> $faker->phoneNumber(),
                "email"=>$faker->email()
            ];
            $data[] = [
                "tipoCorreo" => $faker->numberBetween(1,2),
                "contenidoCorreo"=> json_encode()
            ];
        }
        // Using Query Builder
        $this->db->table("Correos")->insertBatch($data);
    }
}

?>