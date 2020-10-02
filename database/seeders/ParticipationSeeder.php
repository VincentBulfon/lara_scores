<?php

namespace Database\Seeders;

use App\Models\Participation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParticipationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * define is a team is playing at home or not
         * @param array $slugs
         * @param string $slug
         * @return bool
         */
        function isHome($slugs, $slug)
        {
            if ($slug === $slugs[0]) {
                return true;
            }

            return  false;
        };

        foreach (DB::table('matches')->get() as $match) {
            $slugs = str_split($match->slug, 3);
            foreach ($slugs as $slug) {
                $is_home = isHome($slugs, $slug);
                Participation::create(['match_id' => $match->id, 'team_id' => DB::table('teams')->where('slug', '=', $slug)->first()->id, 'is_home' => $is_home, 'goals' => rand(0, 10)]);
            }
        }
    }
}
