<?php


namespace app\lib\Repository\AnswerOptions;

use app\lib\Repository\AnswerOptions\Model\AnswerOptionsModel;
use app\lib\Repository\Main;
use app\lib\Repository\Question\Model\QuestionModel;

class AnswerOptions extends Main
{
    /**
     * @param int $questionId
     * @return AnswerOptionsModel[]
     */
    public function getAnswerOptions(int $questionId): array
    {
        $result = [];

        $sth = $this->db->prepare(
            "SELECT * FROM `answer_options`
                    WHERE question_id = :question_id"
        );
        $sth->execute(['question_id' => $questionId]);
        while ($field = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $result[] = AnswerOptionsModel::setMap($field);
        }

        return $result;
    }

    /**
     * @return QuestionModel[];
     */
    public function getAllAnswerAndQuestion(): array
    {
        $sth = $this->db->prepare(
            "SELECT *, ao.id FROM `answer_options` ao
                    JOIN `question` q ON q.id = ao.question_id"
        );

        $sth->execute();

        $items = [];
        while ($field = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $items[$field['question_id']]['id'] = $field['question_id'];
            $items[$field['question_id']]['name'] = $field['name'];
            $items[$field['question_id']]['sort'] = $field['sort'];
            $items[$field['question_id']]['multiple'] = $field['multiple'];
            $items[$field['question_id']]['answer'][$field['id']] = [
                'id' => $field['id'],
                'text' => $field['text'],
                'question_id' => $field['question_id'],
                'next_question' => $field['next_question']
            ];
        }

        $result = [];
        foreach ($items as $key => $item) {
            $result[$key] = QuestionModel::setMap($item);

            $answerResult = [];
            foreach ($item['answer'] as $answer) {
                $answerResult[$answer['id']] = AnswerOptionsModel::setMap($answer);
            }

            $result[$key]->setAnswer($answerResult);
        }

        return $result;
    }
}