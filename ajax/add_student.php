<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/tsi/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/tsi/lib/Student.php';

$data = json_decode(file_get_contents('php://input'), true);
$response = array();
foreach ($data as $key => $item):
    if (empty($item)):
        $response['Error'] = 'Error filling field';
    endif;
endforeach;
if (empty($response['Error'])):
    $student = new Student($dbHost, $dbUsername, $dbPassword, $dbName);
    $data = array(
        'last_name' => $data['lastName'],
        'first_name' => $data['firstName'],
        'groups' => $data['group']
    );
    $recordId = $student->addUser($data);
    if ($recordId) {
        $response['Ok'] = "Студент успешно добавлена. ID студента: $recordId";
    } else {
        $response['Ok'] = "Ошибка при добавлении студента.";
    }
endif;
header('Content-Type: application/json');
echo json_encode($response);
