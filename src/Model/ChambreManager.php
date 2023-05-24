<?php

namespace App\Model;

class ChambreManager extends AbstractManager
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
}
