<?php

namespace Infoball\util\PHP\User;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

/**
 * Class User
 *
 * Represents a user entity with username, password, and email attributes.
 */
class User
{
    /**
     * @var string The username of the user.
     */
    protected string $username;

    /**
     * @var string The password of the user.
     */
    protected string $pwd;

    /**
     * @var string The email of the user.
     */
    protected string $email;

    /**
     * @var int The id of the user.
     */
    protected int $id;

    /**
     * Get the username of the user.
     *
     * @return string The username of the user.
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the username of the user.
     *
     * @param string $username The username of the user.
     * @return self
     */
    public function setUsername($username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the password of the user.
     *
     * @return string The password of the user.
     */
    public function getPwd(): string
    {
        return $this->pwd;
    }

    /**
     * Set the password of the user.
     *
     * @param string $pwd The password of the user.
     * @return self
     */
    public function setPwd($pwd): self
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get the email of the user.
     *
     * @return string The email of the user.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the email of the user.
     *
     * @param string $email The email of the user.
     * @return self
     */
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the id of the user.
     *
     * @return int The id of the user.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the id of the user.
     *
     * @param int $id The id of the user.
     * @return self
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}
