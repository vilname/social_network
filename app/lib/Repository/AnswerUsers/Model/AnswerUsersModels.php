<?php


namespace app\lib\AnswerUsers\Model;


class AnswerUsersModels
{
    /** @var integer */
    private $id;

    /** @var integer */
    private $answerOptionsId;

    /** @var integer */
    private $questionId;

    /** @var integer */
    private $userId;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getAnswerOptionsId(): int
    {
        return $this->answerOptionsId;
    }

    /**
     * @param int $answerOptionsId
     */
    public function setAnswerOptionsId(int $answerOptionsId)
    {
        $this->answerOptionsId = $answerOptionsId;
    }

    /**
     * @return int
     */
    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    /**
     * @param int $questionId
     */
    public function setQuestionId(int $questionId)
    {
        $this->questionId = $questionId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function setMap(array $data): self
    {
        $o = new self;
        $o->setId($data['id']);
        $o->setAnswerOptionsId($data['answer_options_id']);
        $o->setQuestionId($data['question_id']);
        $o->setUserId($data['user_id']);

        return $o;
    }
}