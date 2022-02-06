<?php


namespace app\lib\Repository\User\Model;


use app\lib\Repository\Friends\Model\FriendsModel;

class UsersModel
{
    private ?int $id;

    private string $created;

    private ?string $updated;

    private string $login;

    private ?string $password;

    private ?string $first_name;

    private ?string $sur_name;

    private ?int $age;

    private ?string $city;

    private ?string $interest;

    private ?FriendsModel $friends;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCreated(): string
    {
        return $this->created;
    }

    /**
     * @param string $created
     */
    public function setCreated(string $created): void
    {
        $this->created = $created;
    }

    /**
     * @return string|null
     */
    public function getUpdated(): ?string
    {
        return $this->updated;
    }

    /**
     * @param string|null $updated
     */
    public function setUpdated(?string $updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string|null $first_name
     */
    public function setFirstName(?string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string|null
     */
    public function getSurName(): ?string
    {
        return $this->sur_name;
    }

    /**
     * @param string|null $sur_name
     */
    public function setSurName(?string $sur_name): void
    {
        $this->sur_name = $sur_name;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     */
    public function setAge(?int $age): void
    {
        $this->age = $age;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getInterest(): ?string
    {
        return $this->interest;
    }

    /**
     * @param string|null $interest
     */
    public function setInterest(?string $interest): void
    {
        $this->interest = $interest;
    }

    /**
     * @return FriendsModel|null
     */
    public function getFriends(): ?FriendsModel
    {
        return $this->friends;
    }

    /**
     * @param FriendsModel|null $friends
     */
    public function setFriends(?FriendsModel $friends): void
    {
        $this->friends = $friends;
    }

    public static function setMap(array $data): self
    {
        $o = new self();

        $o->setId($data['id']);
        $o->setLogin($data['login']);
        $o->setPassword($data['password']);
        $o->setFirstName($data['first_name']);
        $o->setSurName($data['sur_name']);
        $o->setAge($data['age']);
        $o->setCity($data['city']);
        $o->setInterest($data['interest']);
        $o->setFriends($data['friends']);

        return $o;
    }

    public static function setMapArray(UsersModel $data): array
    {
        return [
            'id' => $data->getId(),
            'login' => $data->getLogin(),
            'password' => $data->getPassword(),
            'first_name' => $data->getFirstName(),
            'sur_name' => $data->getSurName(),
            'age' => $data->getAge(),
            'city' => $data->getCity(),
            'interest' => $data->getInterest(),
        ];
    }
}