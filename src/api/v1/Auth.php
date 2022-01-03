<?php

namespace app\api\v1;

use app\lib\Repository\User\Model\UserModel;
use app\lib\Services\User\UsersService;
use League\Route\Http\Exception\NotFoundException;
use Psr\Http\Message\ServerRequestInterface;

class Auth
{
    public function authUser(): array
    {
        $params = json_decode(file_get_contents('php://input'), true);
        $userItems = UserModel::setMap($params['form']);
        $userService = new UsersService();

        $userService->authUser($userItems);

        return [1];
    }

    public function registration(): ?array
    {
        $params = json_decode(file_get_contents('php://input'), true);
        $userItems = UserModel::setMap($params['form']);
        $userService = new UsersService();
        $user = $userService->getUserByLogin($userItems);

        if ($user) {
            return [
                "error" => "Пользователь с таким логином '{$user->getLogin()}' уже существует"
            ];
        }

        if ($userService->saveUser($userItems)) {
            return [
                "success" => "Пользователь '{$userItems->getLogin()}' успешно зарегистрирован"
            ];
        }
    }

//    public function getQuestion(ServerRequestInterface $request): ResponseInterface
//    {
//        $params = $request->getQueryParams();
//
//        $question = (new Question())->getQuestions($params['sort']);
//        $answer = (new AnswerOptions())->getAnswerOptions($question->getId());
//
//        $response = new Response();
//        $response->getBody()->write(json_encode([
//            'question' => $question,
//            'answer' => $answer
//        ]));
//        return $response->withAddedHeader('content-type', 'application/json')->withStatus(200);
//
//    }
//
//    public function saveUser(ServerRequestInterface $request): ResponseInterface
//    {
//        $response = new Response();
//        $data = json_decode($request->getBody()->getContents(), true);
//        $id = (new UsersService())->saveUser($data['fio']);
//
//        $response->getBody()->write(json_encode(['userId' => $id]));
//        return $response->withAddedHeader('content-type', 'application/json')->withStatus(200);
//    }
//
//    public function saveTest(ServerRequestInterface $request): ResponseInterface
//    {
//        $response = new Response();
//        $data = json_decode($request->getBody()->getContents(), true);
//        $id = (new AnswerUsers())->saveAnswerUsers($data);
//
//        $response->getBody()->write(json_encode(['answerUserId' => $id]));
//        return $response->withAddedHeader('content-type', 'application/json')->withStatus(200);
//    }
//
//    public function getResultTest(): ResponseInterface
//    {
//        $response = new Response();
//        $resultTest = (new UsersService())->getResultTest();
//
//        $response->getBody()->write(json_encode(['resultTest' => $resultTest]));
//        return $response->withAddedHeader('content-type', 'application/json')->withStatus(200);
//    }
}