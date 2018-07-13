<?php

namespace App\Console\Commands;

use App\Voter;
use Illuminate\Console\Command;

class UpdateVoterPropensity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tools:update-voter-propensity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Voter::chunk(1000, function($voters) {
            foreach ($voters as $voter) {
                $republicanCount = 0;
                $democratCount = 0;
                $totalVotes = 0;
    
                foreach (config('voters.current_elections') as $election) {
                    if (! empty($voter->$election)) {
                        if (in_array( $voter->$election, config('voters.party_map.republican'))) {
                            $republicanCount++;
                        } else {
                            $democratCount++;
                        }
                        
                        $totalVotes++;
                    }
                }
                
                if ($totalVotes >= 1) {
                    $republicanPercentage = $republicanCount/$totalVotes*100;
                    $democratPercentage = $democratCount/$totalVotes*100;
                    
                    $voter->republican_count = $republicanCount;
                    $voter->percent_republican = $republicanPercentage;
                    $voter->democrat_count = $democratCount;
                    $voter->percent_democrat = $democratPercentage;
                    $voter->total_votes = $totalVotes;
                    
                    if ($totalVotes == 1 && ($republicanPercentage > $democratPercentage)) {
                        $voter->propensity = 'New Republican';
                    } elseif ($totalVotes == 1 && ($democratPercentage > $republicanPercentage)) {
                        $voter->propensity = 'New Democrat';
                    } elseif ($republicanPercentage >= 51) {
                        $voter->propensity = 'Hard Republican';
                    } elseif ($democratPercentage >= 51) {
                        $voter->propensity = 'Hard Democrat';
                    } elseif ($republicanPercentage == 50 && $democratPercentage == 50) {
                        $voter->propensity = 'Balanced';
                    } elseif ($republicanPercentage > $democratPercentage) {
                        $voter->propensity = 'Soft Republican';
                    } elseif ($democratPercentage > $republicanPercentage) {
                        $voter->propensity = 'Soft Democrat';
                    } else {
                        $voter->propensity = "Undetermined";
                    }
                } else {
                    $voter->propensity = 'Non-Voter';
                }
                
                $voter->save();
           }
        });
    }
}
