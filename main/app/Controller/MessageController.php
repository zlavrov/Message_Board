<?php

namespace App\Controller;

use App\Model\MessageModel;
use App\Service\Attribute\Route;

class MessageController {

    #[Route(url: '/message/create', method: 'POST')]
    public function createMessage() {

        $response = ['status' => true, 'message' => []];

        $body = json_decode(file_get_contents('php://input'), true);
        header('Content-type: application/json');
        if($body == null || ($body['title'] == "" || $body['content'] == "")) {
            echo json_encode(["status" => false, "message" => "Request body is empty"]);
            return;
        }
        $result = (new MessageModel())->MessageCreate($body['title'], $body['content']);

        $response['message'] = $result;
        echo json_encode($response);
    }

    #[Route(url: '/message/update/{id}', method: 'PATCH')]
    public function updateMessage($id) {

        $response = ['status' => true, 'message' => []];

        $body = json_decode(file_get_contents('php://input'), true);
        header('Content-type: application/json');
        if($body == null || ($body['title'] == "" || $body['content'] == "")) {
            echo json_encode(["status" => false, "message" => "Request body is empty"]);
            return;
        }
        $result = (new MessageModel())->MessageUpdate($id, $body['title'], $body['content']);
        foreach($result as $row){
            array_push($response['message'], ['id' => $row['id'], 'title' => $row['title'], 'content' => $row['content'], 'created' => $row['created']]);
        }
        echo json_encode($response);
    }

    #[Route(url: '/message/get/{id}', method: 'GET')]
    public function getMessageById($id) {

        $response = ['status' => true, 'message' => []];

        $result = (new MessageModel())->MessageById($id);

        foreach($result as $row){
            array_push($response['message'], ['id' => $row['id'], 'title' => $row['title'], 'content' => $row['content'], 'created' => $row['created']]);
        }
        header('Content-type: application/json');
        echo json_encode($response);
    }

    #[Route(url: '/message/list', method: 'GET')]
    public function getMessageList() {

        $response = ['status' => true, 'message' => []];

        $result = (new MessageModel())->MessageList();

        foreach($result as $row){
            array_push($response['message'], ['id' => $row['id'], 'title' => $row['title'], 'content' => $row['content'], 'created' => $row['created']]);
        }
        header('Content-type: application/json');
        echo json_encode($response);
    }

    #[Route(url: '/message/delete/{id}', method: 'DELETE')]
    public function deleteMessage($id) {

        $response = ['status' => true, 'message' => []];

        $result = (new MessageModel())->MessageDelete($id);

        array_push($response['message'], ['id' => $id, 'count_delete_message' => $result]);
        header('Content-type: application/json');
        echo json_encode($response);
    }
}
