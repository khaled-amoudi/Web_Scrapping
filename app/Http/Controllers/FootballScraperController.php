<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Goutte;

class FootballScraperController extends Controller
{
    public function __invoke()
    {
        $date = Carbon::now()->format('Y-m-d');
        $crawler = Goutte::request('GET', 'https://www.filgoal.com/matches/?date=' . $date);

        $champions_names = [];
        $matches = [];

        $crawler->filter('#match-list-viewer')->each(function ($node) use (&$champions_names, &$matches) {
            $champions_names = $node->filter('h6')->each(function ($node) {
                return $node->text();
            });

            $matches = $node->filter('.mc-block')->each(function ($node) {
                return $clubs = $node->filter('.c-i-next')->each(function ($node) {
                    $first_team = $node->filter('.f a')->each(function ($node) {
                        return $node->text();
                    });
                    $first_team_score = $node->filter('.f b')->each(function ($node) {
                        return $node->text();
                    });
                    $second_team = $node->filter('.s a')->each(function ($node) {
                        return $node->text();
                    });
                    $second_team_score = $node->filter('.s b')->each(function ($node) {
                        return $node->text();
                    });
                    $status = $node->filter('.m')->each(function ($node) {
                        return $node->text();
                    });
                    return [
                        'first_team' => [
                            'name' => $first_team,
                            'score' => $first_team_score
                        ],
                        'second_team' => [
                            'name' => $second_team,
                            'score' => $second_team_score
                        ],
                        'status' => $status
                    ];
                });
            });
        });

        return view('welcome', compact('champions_names', 'matches'));
    }






    // function() {
    //     $date = Carbon::now()->format('Y-m-d');
    //     $crawler = Goutte::request('GET', 'https://www.filgoal.com/matches/?date=' . $date);
    //     $crawler->filter('#match-list-viewer')->each(function ($node) {
    //         $champions_names = $node->filter('h6')->each(function ($node) {
    //             return $node->text();
    //         });

    //         $matches = $node->filter('.mc-block')->each(function ($node) use ($champions_names) {
    //             $champions_name = reset($champions_names);
    //             return $clubs = $node->filter('.c-i-next')-> each(function ($node) use ($champions_name) {
    //                 $first_team = $node->filter('.f')->each(function ($node) {
    //                     $name = $node->filter('a')->each(function ($node) {
    //                         return $node->text();
    //                     });
    //                     $score = $node->filter('b')->each(function ($node) {
    //                         return $node->text();
    //                     });
    //                     return [
    //                         'name' => $name,
    //                         'score' => $score
    //                     ];
    //                 });
    //                 $second_team = $node->filter('.s')->each(function ($node) {
    //                     $name = $node->filter('a')->each(function ($node) {
    //                         return $node->text();
    //                     });
    //                     $score = $node->filter('b')->each(function ($node) {
    //                         return $node->text();
    //                     });
    //                     return [
    //                         'name' => $name,
    //                         'score' => $score
    //                     ];
    //                 });


    //                 $status = $node->filter('.m')->each(function ($node) {
    //                     return $node->text();
    //                 });


    //                 return [
    //                     'champions_name' => $champions_name,
    //                     'first_team' => $first_team,
    //                     'second_team' => $second_team,
    //                     'status' => $status
    //                 ];
    //             });
    //         });
    //         dd($champions_names, $matches);
    //     });

    //     // return view('football-scraper', compact('champions_names', 'matches'));
    // }
}
