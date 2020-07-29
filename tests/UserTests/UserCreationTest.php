<?php

use PHPUnit\Framework\TestCase;

class UserCreationTest extends TestCase
{
    private const FULL_INFO_ARRAY = ['1', 'username', 'firstName', 'lastName', 'email', 'password', 'type'];
    private const ERROR_INFO_ARRAY = [null, 'username', 'firstName', 'lastName', 'email', 'password', 'type'];
    private const SMALL_INFO_ARRAY = ['1', 'username', 'firstName'];

    public function testUserCanBeCreatedCorrectly()
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

    public function testUserCreationExceptions()
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

    public function testUserCreationWithTooSmallInfoArray()
    {
        // Arrange
        $userDB = new \DBUserMock();

        // Act
        try {
            $user = new \User($userDB, self::SMALL_INFO_ARRAY);

            // Assert
            self::fail();
        } catch (InvalidArgumentException $e) {
            if ($e->getMessage() === 'Missing information') {
                self::assertTrue(true);
            } else {
                self::fail();
            }
        }
    }

    public function testUserCanBeDeletedCorrectly()
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

    public function testUserDeletionExceptions()
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
            if ($e->getMessage() === 'Should be null !') {
                self::assertTrue(true);
            } else {
                self::fail();
            }
        }
    }
}
