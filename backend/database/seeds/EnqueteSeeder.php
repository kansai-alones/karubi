<?php

use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;
use App\Enquete;
use App\Choice;

class EnqueteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = Yaml::parse(file_get_contents(__DIR__ . '/enquete.yml'));
        foreach ($items as $item) {
            $enquete = Enquete::create([
                'title' => $item['title'],
                'level' => $item['level'],
            ]);
            foreach ($item['choices'] as $value) {
                Choice::create([
                    'enquete_id' => $enquete->id,
                    'text'       => $value,
                ]);
            }
        }
    }
}
