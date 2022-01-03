<?php


namespace app\lib\Repository\Question\Model;


class QuestionModel implements \JsonSerializable
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $sort;

    /** @var bool */
    private $multiple;

    /** @var array */
    private $answer;

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSort(): string
    {
        return $this->sort;
    }

    /**
     * @param string $sort
     */
    public function setSort(string $sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * @param bool $multiple
     */
    public function setMultiple(?bool $multiple)
    {
        $this->multiple = $multiple;
    }

    /**
     * @return array
     */
    public function getAnswer(): array
    {
        return $this->answer;
    }

    /**
     * @param array|null $answer
     */
    public function setAnswer(?array $answer): void
    {
        $this->answer = $answer;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function setMap(array $data): self
    {
        $o = new self;
        $o->setId($data['id']);
        $o->setName($data['name']);
        $o->setSort($data['sort']);
        $o->setMultiple($data['multiple']);

        return $o;
    }
}