<?php


namespace app\lib\AnswerOptions\Model;


class AnswerOptionsModel implements \JsonSerializable
{
    /** @var integer */
    private $id;

    /** @var integer */
    private $questionId;

    /** @var string */
    private $text;

    /** @var bool */
    private $nextQuestion;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

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
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return bool
     */
    public function isNextQuestion(): bool
    {
        return $this->nextQuestion;
    }

    /**
     * @param bool $nextQuestion
     */
    public function setNextQuestion(?bool $nextQuestion)
    {
        $this->nextQuestion = $nextQuestion;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function setMap(array $data): self
    {
        $o = new self;
        $o->setId($data['id']);
        $o->setQuestionId($data['question_id']);
        $o->setText($data['text']);
        $o->setNextQuestion($data['next_question']);

        return $o;
    }
}