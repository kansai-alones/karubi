<?php

namespace Tests\Unit;

use Tests\TestCase;
use Tests\Unit\ToDo;
use Tests\Unit\Conf;
use App\Todo as TodoModel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThirdTest extends TestCase
{
    private static $res = [];
    /** @test **/
    public function クラスあるかないか()
    {
        try {
            $db = \DB::connection()->getPdo();
            $mock = null;
            $mock = new ToDo($db);
            $result = $this->assertNotNull($mock);
            if (is_null($result)) {
                self::$res[0] = true;
            }
        } catch (\Exception $e) {
            self::$res[0] = false;
        }
    }

    /** @test **/
    public function createメソッドで追加されるか()
    {
        try {
            $db = \DB::connection()->getPdo();
            $mock = new ToDo($db);
            $mock->create("人参を買う。");
            $result = $this->assertDatabaseHas('todo', [
                "text" => "人参を買う。"
            ]);
            if ($result !== false) {
                self::$res[1] = true;
            }

        } catch (\Exception $e) {
            self::$res[1] = false;
        }
    }

    /** @test **/
    public function getallメソッドで一覧を取得できる()
    {
        try {
            $db = \DB::connection()->getPdo();
            $mock = new ToDo($db);
            for ($i = 0; $i < 3; $i++) {
                TodoModel::create([
                    "text" => "ほげ".$i,
                    "status" => 0
                ]);
            }
            $todos = $mock->getAll();
            $texts = array_pluck($todos, 'text');
            $result = $this->assertEquals($texts, ["ほげ0", "ほげ1", "ほげ2"]);
            if ($result !== false) {
                self::$res[2] = true;
            }
        } catch (\Exception $e) {
            self::$res[2] = false;
        }
    }

    /** @test **/
    public function todoを完了状態にできる()
    {
        try {
            $db = \DB::connection()->getPdo();
            $mock = new ToDo($db);
            TodoModel::create([
                "text" => "ほげ1",
                "status" => 0
            ]);
            $todo = TodoModel::where("text", "ほげ1")->first();
            $mock->update($todo->id);

            $test = TodoModel::where("text", "ほげ1")->first();
            $result = $this->assertEquals($test["status"], 1);
            if ($result !== false) {
                self::$res[3] = true;
            }
        } catch (\Exception $e) {
            self::$res[3] = false;
        }
    }

    /** @test **/
    public function todoの内容を変更できるeditメソッドのテスト()
    {
        try {
            $db = \DB::connection()->getPdo();
            $mock = new ToDo($db);
            TodoModel::create([
                "text" => "ほげ1",
                "status" => 0
            ]);
            $todo = TodoModel::where("text", "ほげ1")->first();
            $mock->edit($todo->id, "ほげ2");

            $test = TodoModel::where("text", "ほげ2")->first();
            $result = $this->assertNotNull($test);
            if ($result !== false) {
                self::$res[4] = true;
            }
        } catch (\Exception $e) {
            self::$res[4] = false;
        }
    }

    /** @test **/
    public function todoを削除するdeleteメソッドのテスト()
    {
        try {
            $db = \DB::connection()->getPdo();
            $mock = new ToDo($db);
            TodoModel::create([
                "text" => "ほげ1",
                "status" => 0
            ]);
            $todo = TodoModel::where("text", "ほげ1")->first();
            $mock->delete($todo->id);

            $test = TodoModel::where("text", "ほげ1")->first();
            $result = $this->assertNull($test);
            if ($result !== false) {
                self::$res[5] = true;
            }
        } catch (\Exception $e) {
            self::$res[5] = false;
        }
    }

    /** @test **/
    public function getAllメソッドにアルファベット順が実装できている()
    {
        try {
            $db = \DB::connection()->getPdo();
            $mock = new ToDo($db);
            $list = ["いあ", "あえ", "ほこ"];
            foreach ($list as $key => $value) {
                TodoModel::create([
                    "text" => $value,
                    "status" => 0
                ]);
            }
            $todos = $mock->getAll();
            $texts = array_pluck($todos, 'text');
            $result = $this->assertEquals($texts, ["あえ", "いあ", "ほこ"]);
            if ($result !== false) {
                self::$res[6] = true;
            }
        } catch (\Exception $e) {
            self::$res[6] = false;
        }
    }


    public function tearDown()
    {
        TodoModel::truncate();
    }

    public static function tearDownAfterClass()
    {
        $bytes_written = \File::put("result.json", json_encode(self::$res));
    }
}
