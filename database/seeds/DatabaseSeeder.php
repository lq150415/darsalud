<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Darsalud\User;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('ClientesTableSeeder');
        $this->command->info('User table seeded!');


        Model::reguard();
    }
}
class ClientesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'NOM_USU' => 'Luis',
            'APA_USU' => 'Quisbert',
            'AMA_USU' => 'Quispe',
            'EST_USU' => 'Dar salud 20 de octubre',
            'ARE_USU' => 'Medico',
            'TEL_USU' => '0',
            'NIC_USU' => 'lquisbert',
            'NIV_USU' => '1',
            'password' => bcrypt('123456'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon:: now()
        ]);

    }

}
