<?php

use PHPUnit\Framework\TestCase;

class UserCreationTest extends TestCase
{
    private const FULL_INFO_ARRAY = ['1', 'username', 'firstName', 'lastName', 'email', 'password', 'type'];
    private const ERROR_INFO_ARRAY = [null, 'username', 'firstName', 'lastName', 'email', 'password', 'type'];

    public function testWHEN_user_is_created_correctly_RETURN_true()
    {
        // Arrange
        $userDB = new \DBUserMock();
        $user = new \User($userDB, self::FULL_INFO_ARRAY);
        $user->create();

        // Act
        $validation = $user->validateCompletion();

        // Assert
        self::assertTrue($validation);
    }

    public function testWHEN_user_is_created_wrong_RETURN_Exception()
    {
        // Arrange
        $userDB = new \DBUserMock();
        $user = new \User($userDB, self::ERROR_INFO_ARRAY);
        $user->create();

        // Act
        try {
            $user->validateCompletion();

            // Assert
            self::fail();
        } catch (InvalidArgumentException $e) {
            if ($e->getMessage() === 'Should not be null !') {
                self::assertTrue(true);
            } else {
                self::fail();
            }
        }
    }

    public function testWHEN_user_is_deleted_correctly_RETURN_true()
    {
        // Arrange
        $userDB = new \DBUserMock();
        $user = new \User($userDB, self::FULL_INFO_ARRAY);
        $user->create();
        $user->delete();

        // Act
        $validation = $user->validateDeletion();

        // Assert
        self::assertTrue($validation);
    }

    public function testWHEN_user_is_deleted_wrong_RETURN_Exception()
    {
        // Arrange
        $userDB = new \DBUserMock(null);
        $user = new \User($userDB, self::FULL_INFO_ARRAY);
        $user->create();

        // Act
        try {
            $user->validateDeletion();

            // Assert
            self::fail();
        } catch (InvalidArgumentException $e) {
            var_dump($e->getMessage());
            if ($e->getMessage() === 'Should be null !') {
                self::assertTrue(true);
            } else {
                self::fail();
            }
        }
    }
}
