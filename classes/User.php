<?php

class User
{
    private $userDB;

    private $id;
    private $username;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $type;

    public function __construct($userDB, $infoArray)
    {
        $this->userDB = $userDB;
        $this->id = intval($infoArray[0]);
        $this->username = $infoArray[1];
        $this->firstName = $infoArray[2];
        $this->lastName = $infoArray[3];
        $this->email = $infoArray[4];
        $this->password = $infoArray[5];
        $this->type = $infoArray[6];
    }

    public function create()
    {
        $this->userDB->id = $this->id;
        $this->userDB->username = $this->username;
        $this->userDB->firstName = $this->firstName;
        $this->userDB->lastName = $this->lastName;
        $this->userDB->email = $this->email;
        $this->userDB->password = $this->password;
        $this->userDB->type = $this->type;
        $this->userDB->Create();
    }

    /**
     * Validates the creation of the user
     * @return exceptions if it did not work properly
     */
    public function validateCompletion()
    {
        if ($this->userDB->id == null) {
            throw new InvalidArgumentException();
        }
        if ($this->userDB->username == null) {
            throw new InvalidArgumentException();
        }
        if ($this->userDB->firstName == null) {
            throw new InvalidArgumentException();
        }
        if ($this->userDB->lastName == null) {
            throw new InvalidArgumentException();
        }
        if ($this->userDB->email == null) {
            throw new InvalidArgumentException();
        }
        if ($this->userDB->password == null) {
            throw new InvalidArgumentException();
        }
        if ($this->userDB->type == null) {
            throw new InvalidArgumentException();
        }
        return true;
    }

    /**
     * Deletes the user in the database
     */
    public function delete()
    {
        $this->userDB->Delete();
        $this->emptyProperties();
    }

    /**
     * Empties the properties of the class
     */
    private function emptyProperties()
    {
        $this->id = null;
        $this->username = null;
        $this->firstName = null;
        $this->lastName = null;
        $this->email = null;
        $this->password = null;
        $this->type = null;
    }

    /**
     * Validates the deletion of the user
     * @return exceptions if it did not work properly
     */
    public function validateDeletion()
    {
        if ($this->id != null && $this->userDB->id) {
            throw new InvalidArgumentException();
        }
        if ($this->username != null && $this->userDB->username) {
            throw new InvalidArgumentException();
        }
        if ($this->firstName != null && $this->userDB->firstName) {
            throw new InvalidArgumentException();
        }
        if ($this->lastName != null && $this->userDB->lastName) {
            throw new InvalidArgumentException();
        }
        if ($this->email != null && $this->userDB->email) {
            throw new InvalidArgumentException();
        }
        if ($this->password != null && $this->userDB->password) {
            throw new InvalidArgumentException();
        }
        if ($this->type != null && $this->userDB->type) {
            throw new InvalidArgumentException();
        }
        return true;
    }
}
