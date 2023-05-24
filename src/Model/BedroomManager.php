<?php

namespace App\Model;

class BedroomManager extends AbstractManager
{
    public const TABLE = 'room';
    /**
     * Get all row from database.
     */
    public function selectAll()
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        return $this->pdo->query($query)->fetchAll();
    }

    public function selectOneById(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
