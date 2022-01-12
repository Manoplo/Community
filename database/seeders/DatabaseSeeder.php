<?php

namespace Database\Seeders;

use App\Models\CommunityLink;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::delete('delete from community_links');
        CommunityLink::factory()->count(50)->create();
    }
}
