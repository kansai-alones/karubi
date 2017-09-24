<?php
require("ToDo.php");
require("Conf.php");

$db = new PDO(Conf::DB_DNS, Conf::DB_USERNAME, Conf::DB_PASSWORD);

if (!empty($_GET['method'])) {
    $method = $_GET['method'];
    $todo = new Todo($db);

    if ($method == 'getall') {
        $res = $todo->getAll();
        echo json_encode($res);
    }

    switch ($method) {
        case 'create':
            if (!empty($_POST['text'])) {
                $text = $_POST['text'];
                echo $text;
                $todo->create($text);
            } else {
                echo 'textないよ';
            }
            break;
        case 'update':
            if (!empty($_POST['id'])) {
                $text = $_POST['id'];
                $todo->update($text);
            } else {
                echo 'idないよ';
            }
            break;
        case 'edit':
            if (!empty($_POST['id']) && !empty($_POST['text'])) {
                $id = $_POST['id'];
                $text = $_POST['text'];
                $todo->edit($id, $text);
            } else {
                echo 'idとtextどっちかないよ';
            }
            break;
        case 'delete':
            if (!empty($_POST['id'])) {
                $id = $_POST['id'];
                $todo->delete($id);
            } else {
                echo 'idないよ';
            }
            break;

        default:
            # code...
            break;
    }
} else {
    echo 'methodないよ';
}
