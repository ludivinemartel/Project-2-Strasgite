<?php

namespace App\Model;

class UserManager extends AbstractManagerAdmin
{
    public const TABLE = 'user';

     /**
     * Get one row from database by login and password.
     */

    public function selectOneByAccount(string $user, string $password): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE user=:user AND password=:password");
        $statement->bindValue('user', $user, \PDO::PARAM_STR);
        $statement->bindValue('password', $password, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function insert(array $user): int
    {
        $query = "INSERT INTO " . self::TABLE .
            " (`user`, `statut`, `password`, `firstname`, `lastname`, `phonenb`, `mail`)
        VALUES (:user, :statut, :password, :firstname, :lastname, :phonenb, :mail)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':user', $user['user'], \PDO::PARAM_STR);
        $statement->bindValue(':statut', $user['statut'], \PDO::PARAM_STR);
        $statement->bindValue(':password', $user['password'], \PDO::PARAM_STR);
        $statement->bindValue(':firstname', $user['firstname'], \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $user['lastname'], \PDO::PARAM_STR);
        $statement->bindValue(':phonenb', $user['phonenb'], \PDO::PARAM_STR);
        $statement->bindValue(':mail', $user['mail'], \PDO::PARAM_STR);
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $user): bool
    {
        $query = "UPDATE " . self::TABLE . " SET `user` = :user, `statut` = :statut, `password` = :password,
        `firstname` = :firstname, `lastname` = :lastname, `phonenb` = :phonenb, `mail`= :mail WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $user['id'], \PDO::PARAM_INT);
        $statement->bindValue('user', $user['user'], \PDO::PARAM_INT);
        $statement->bindValue('statut', $user['statut'], \PDO::PARAM_INT);
        $statement->bindValue('password', $user['password'], \PDO::PARAM_INT);
        $statement->bindValue('firstname', $user['firstname'], \PDO::PARAM_INT);
        $statement->bindValue('lastname', $user['lastname'], \PDO::PARAM_INT);
        $statement->bindValue('phonenb', $user['phonenb'], \PDO::PARAM_INT);
        $statement->bindValue('mail', $user['mail'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
