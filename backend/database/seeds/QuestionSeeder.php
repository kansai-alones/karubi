<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Check;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'title' => 'ToDoアプリを実装する',
                'description' => 'PHPとMySQL, jQueryを使ったシンプルなToDoアプリを実装する.',
                'level' => 3,
                'checks' => [
                    [
                        'title'         => 'ToDoクラスが実装されている',
                        'description'   => 'ToDoクラスがある'
                    ], [
                        'title'         => 'Createメソッドが実装されている',
                        'description'   => 'ToDoを登録するCreateメソッドが実装されている'
                    ], [
                        'title'         => 'getAllメソッドが実装されている',
                        'description'   => 'ToDoを登録するCreateメソッドが実装されている'
                    ], [
                        'title'         => 'UpDateメソッドが実装されている',
                        'description'   => 'ToDoの完了状態を更新するUpDateメソッドが実装されている'
                    ], [
                        'title'         => 'editメソッドが実装されている',
                        'description'   => 'ToDoの内容を更新するeditメソッドが実装されている'
                    ], [
                        'title'         => 'deleteメソッドが実装されている',
                        'description'   => 'ToDoを削除できるdeleteメソッドが実装されている'
                    ], [
                        'title'         => 'getAllメソッドが実装されている',
                        'description'   => 'getAllメソッドをアルファベット順に取得できる'
                    ],
                ],
            ]
        ];

        foreach ($items as $key => $item) {
            $q = Question::create([
                'title' => $item['title'],
                'description' => $item['description'],
                'level' => $item['level'],
            ]);
            foreach ($item['checks'] as $check) {
                Check::create([
                    'question_id' => $q->id,
                    'title'       => $check['title'],
                    'description' => $check['description'],
                ]);
            }
        }
    }
}
