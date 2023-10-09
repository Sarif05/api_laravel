<?php

namespace Database\Seeders;

use App\Models\TourActivities;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TourActivitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TourActivities::create([
            'title' => 'satu',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '100000'
        ]);
        TourActivities::create([
            'title' => 'dua',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '200000'
        ]);
        TourActivities::create([
            'title' => 'tiga',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '300000'
        ]);
        TourActivities::create([
            'title' => 'empat',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '400000'
        ]);
        TourActivities::create([
            'title' => 'lima',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '500000'
        ]);
        TourActivities::create([
            'title' => 'enam',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '600000'
        ]);
        TourActivities::create([
            'title' => 'tujuh',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '700000'
        ]);
        TourActivities::create([
            'title' => 'delapan',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '800000'
        ]);
        TourActivities::create([
            'title' => 'sembilan',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '900000'
        ]);
        TourActivities::create([
            'title' => 'sepuluh',
            'descriptions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis accusantium hic, sunt commodi voluptas cupiditate obcaecati non omnis odio! Sint!',
            'price' => '1000000'
        ]);
    }
}
