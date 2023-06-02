<?php

namespace Afaqy\Integration\Database\Seeders;

use Laravel\Passport\Client;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class IntegrationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Client::firstOrCreate([
            'id'                       => 2,
            'name'                     => 'zk',
            'secret'                   => '0RRgJPLaRcNXg5qygD0K1BoK3v3dWPVjoA133Cx6',
            'redirect'                 => '',
            'personal_access_client'   => 0,
            'password_client'          => 0,
            'revoked'                  => 0,
        ]);
    }
}
