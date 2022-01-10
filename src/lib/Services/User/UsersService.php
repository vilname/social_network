<?php

namespace app\lib\Services\User;

use app\lib\Repository\AnswerOptions\AnswerOptions;
use app\lib\Repository\AnswerOptions\Model\AnswerOptionsModel;
use app\lib\Repository\AnswerUsers\AnswerUsers;
use app\lib\Repository\User\Model\UserModel;
use app\lib\Repository\User\UsersRepository;
use League\Route\Http\Exception\NotFoundException;

class UsersService
{
    public function getUserByLogin(string $login): ?UserModel
    {
//        echo '<pre>';
//        print_r($_SESSION);
//        echo '</pre>';
//        die();

        try {
            $user = (new UsersRepository())->getUserByLogin($login);
        } catch (\Exception $e) {
            $user = null;
        }

        return $user;
    }

    public function saveUser(UserModel $user): int
    {
        return (new UsersRepository())->saveUser($user);
    }

    public function authUser(UserModel $user): array
    {
        return (new UsersRepository())->authUser($user);
    }

    public function getResultTest(): array
    {
        $answerUsers = (new AnswerUsers())->getAnswerUsers();
        $question = (new AnswerOptions())->getAllAnswerAndQuestion();

        $answerRes = [
            'answer' => [],
            'countAnswer' => []
        ];
        foreach ($answerUsers as $answer) {
            $answerRes['answer'][$answer->getQuestionId()][$answer->getAnswerOptionsId()] += 1;
            $answerRes['countAnswer'][$answer->getQuestionId()] += 1;
        }

        $questionRes = [];
        foreach ($question as $key => $item) {
            $questionRes[]['name'] = $item->getName();

            /** @var AnswerOptionsModel $answer */
            foreach ($item->getAnswer() as $k => $answer) {
                $questionRes[] = [
                    'name' => $answer->getText(),
                    'count' => $answerRes['answer'][$key][$k],
                    'share' => round($answerRes['answer'][$key][$k] * 100 / $answerRes['countAnswer'][$key]) . '%',
                ];
            }
        }

        return $questionRes;
    }
}