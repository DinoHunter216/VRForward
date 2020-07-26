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

    /**
     * @param userDB: The user database class
     * @param infoArray: All the information in an array
     * @return exception if the infoArray is missing data
     */
    public function __construct($userDB, $infoArray)
    {
        if (count($infoArray) == 7) {
            $this->userDB = $userDB;
            $this->id = intval($infoArray[0]);
            $this->username = $infoArray[1];
            $this->firstName = $infoArray[2];
            $this->lastName = $infoArray[3];
            $this->email = $infoArray[4];
            $this->password = $infoArray[5];
            $this->type = $infoArray[6];

            self::hashPassword();
        } else {
            throw new InvalidArgumentException('Missing information');
        }
    }

    /**
     * Creates the user in the database
     */
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
            throw new InvalidArgumentException('Should not be null !');
        }
        if ($this->userDB->username == null) {
            throw new InvalidArgumentException('Should not be null !');
        }
        if ($this->userDB->firstName == null) {
            throw new InvalidArgumentException('Should not be null !');
        }
        if ($this->userDB->lastName == null) {
            throw new InvalidArgumentException('Should not be null !');
        }
        if ($this->userDB->email == null) {
            throw new InvalidArgumentException('Should not be null !');
        }
        if ($this->userDB->password == null) {
            throw new InvalidArgumentException('Should not be null !');
        }
        if ($this->userDB->type == null) {
            throw new InvalidArgumentException('Should not be null !');
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
        if ($this->id != null && $this->userDB->id != null) {
            throw new InvalidArgumentException('Should be null !');
        }
        if ($this->username != null && $this->userDB->username != null) {
            throw new InvalidArgumentException('Should be null !');
        }
        if ($this->firstName != null && $this->userDB->firstName != null) {
            throw new InvalidArgumentException('Should be null !');
        }
        if ($this->lastName != null && $this->userDB->lastName != null) {
            throw new InvalidArgumentException('Should be null !');
        }
        if ($this->email != null && $this->userDB->email != null) {
            throw new InvalidArgumentException('Should be null !');
        }
        if ($this->password != null && $this->userDB->password != null) {
            throw new InvalidArgumentException('Should be null !');
        }
        if ($this->type != null && $this->userDB->type != null) {
            throw new InvalidArgumentException('Should be null !');
        }
        return true;
    }

    /**
     * Hash the password for security
     */
    private function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    /**
     * @return password: a copy of the hashed password
     */
    public function getPassword()
    {
        return $password = $this->password;
    }

    /**
     * Changes the password
     */
    public function changePassword($newPassword)
    {
        $this->password = $newPassword;
        self::hashPassword();
        $this->userDB->password = $this->password;
        $this->userDB->Save();

        if (!password_verify($newPassword, $this->userDB->password)) {
            throw new InvalidArgumentException('Password hasn\'nt been changed');
        }
    }

    /**
     * @param password: the password received to check with the actual password
     * @return exception if the password is wrong
     */
    public function verifyPassword($password)
    {
        if (password_verify($password, $this->password)) {
            return true;
        } else {
            throw new InvalidArgumentException('Wrong password');
        }
    }
}
