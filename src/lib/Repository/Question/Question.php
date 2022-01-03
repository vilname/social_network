<?php


namespace app\lib\Repository\Question;

use app\lib\Repository\Main;
use app\lib\Repository\Question\Model\QuestionModel;

class Question extends Main
{
    /**
     * @param int $sort
     * @return QuestionModel
     */
    public function getQuestions(int $sort = 0): QuestionModel
    {
        $sth = $this->db->prepare(
            "SELECT * FROM `question`
                    WHERE sort > :sort
                    ORDER BY sort ASC 
                    LIMIT 1");
        $sth->execute(['sort' => $sort]);
        $array = $sth->fetch(\PDO::FETCH_ASSOC);

        return QuestionModel::setMap($array);
    }
}