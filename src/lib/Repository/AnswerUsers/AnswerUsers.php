<?php


namespace app\lib\Repository\AnswerUsers;

use app\lib\Repository\AnswerUsers\Model\AnswerUsersModels;
use app\lib\Repository\Main;

class AnswerUsers extends Main
{
    public function saveAnswerUsers($answerTest): array
    {
        $result = [];

        foreach ($answerTest['answerIds'] as $answerId) {
            $sth = $this->db->prepare("INSERT INTO `answer_users` SET 
            `answer_options_id` = :answer_options_id,
            `question_id` = :question_id,
            `user_id` = :user_id
        ");

            $sth->execute([
                'answer_options_id' => $answerId,
                'question_id' => $answerTest['questionId'],
                'user_id' => $answerTest['userId'],
            ]);

            $result[] = $this->db->lastInsertId();
        }

        // Получаем id вставленной записи
        return $result;
    }

    /**
     * @return AnswerUsersModels[]
     */
    public function getAnswerUsers():array
    {
        $sth = $this->db->prepare(
            "SELECT * FROM `answer_users` ORDER BY question_id ASC");
        $sth->execute();

        $result = [];
        while ($field = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = AnswerUsersModels::setMap($field);
        }

        return $result;
    }
}