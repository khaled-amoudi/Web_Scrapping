<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Goutte;

class FootballScraper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FootballScraper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Route::get('/football-scraper', function() {
            $date = Carbon::now()->format('Y-m-d');
            $crawler = Goutte::request('GET', 'https://www.filgoal.com/matches/?date=' . $date);
            $crawler->filter('#match-list-viewer')->each(function ($node) {
                $champions_names = $node->filter('h6')->each(function ($node) {
                    return $node->text();
                });

                $matches = $node->filter('.mc-block')->each(function ($node) {
                    return $clubs = $node->filter('.c-i-next')-> each(function ($node) {
                        $first_team = $node->filter('.f')->each(function ($node) {
                            return $node->text();
                        });
                        $second_team = $node->filter('.s')->each(function ($node) {
                            return $node->text();
                        });
                        $status = $node->filter('.m')->each(function ($node) {
                            return $node->text();
                        });
                        return [
                            'first_team' => $first_team,
                            'second_team' => $second_team,
                            'status' => $status
                        ];
                    });
                });
                dd($champions_names, $matches);
            });
            // return view('football-scraper', compact('champions_names', 'matches'));
        });
    }
}
