<?php

namespace App\Model;

use PDO;

class RoomManager extends AbstractManagerAdmin
{
    public const TABLE = 'room';

    /**
     * Insert new item in database
     */
    public function insert(array $room): int
    {
        $query = "INSERT INTO " . self::TABLE .
            " (`name`, `nameFront`, `nbpersons`, `price`, `pricesp`,`description`, `resume`, `address`, `image`)
        VALUES (:name, :nameFront, :nbpersons, :price, :pricesp, :description, :resume, :address, :image)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $room['name'], \PDO::PARAM_STR);
        $statement->bindValue(':nameFront', $room['nameFront'], \PDO::PARAM_STR);
        $statement->bindValue(':nbpersons', $room['nbpersons'], \PDO::PARAM_STR);
        $statement->bindValue(':price', $room['price'], \PDO::PARAM_STR);
        $statement->bindValue(':pricesp', $room['pricesp'], \PDO::PARAM_STR);
        $statement->bindValue(':description', $room['description'], \PDO::PARAM_STR);
        $statement->bindValue(':resume', $room['resume'], \PDO::PARAM_STR);
        $statement->bindValue(':address', $room['address'], \PDO::PARAM_STR);
        $statement->bindValue(':image', $room['image'], \PDO::PARAM_STR);
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $room): bool
    {
        $query = "UPDATE " . self::TABLE . " SET `name` = :name, `nameFront` = :nameFront, 
        `nbpersons` = :nbpersons, `price` = :price,
        `pricesp` = :pricesp, `description` = :description, `resume`=:resume, 
        `address` = :address, `image` = :image  WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $room['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $room['name'], \PDO::PARAM_STR);
        $statement->bindValue('nameFront', $room['nameFront'], \PDO::PARAM_STR);
        $statement->bindValue('nbpersons', $room['nbpersons'], \PDO::PARAM_STR);
        $statement->bindValue('price', $room['price'], \PDO::PARAM_STR);
        $statement->bindValue('pricesp', $room['pricesp'], \PDO::PARAM_STR);
        $statement->bindValue('description', $room['description'], \PDO::PARAM_STR);
        $statement->bindValue('resume', $room['resume'], \PDO::PARAM_STR);
        $statement->bindValue('address', $room['address'], \PDO::PARAM_STR);
        $statement->bindValue('image', $room['image'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    /**
     * Check for errors (input)
     */
/*
     public function validate(array $room): array
     {
         $room['description'] = filter_var($room['description'], FILTER_SANITIZE_ENCODED);
         $room['name'] = filter_var($room['name'], FILTER_SANITIZE_ENCODED);
         $this->checkInputValues($room, 'nbpersons', 4);
         $this->checkInputValues($room, 'price', 1000);
         $this->checkInputValues($room, 'pricesp', 100);
         if (strlen($room['description']) > 1000) {
             $this->errors[] = 'C\'est trop long, 1000 caractères MAX';
         }
         if (strlen($room['name']) > 15) {
            $this->errors[] = 'C\'est trop long, 15 caractères MAX';
        }
         if (
             filter_var(
                 $room['nbpersons'],
                 FILTER_VALIDATE_INT,
                 array("options" => array("min_range" => 2, "max_range" => 8))
             ) === false
         ) {
             $this->errors[] = 'La capacité doit être comprise entre 2 et 8 personnes';
         }
         if (
             filter_var(
                 $room['price'],
                 FILTER_VALIDATE_FLOAT,
                 array("options" => array("min_range" => 50, "max_range" => 400))
             ) === false
         ) {
             $this->errors[] = 'Le prix n\'est pas correct (doit être compris entre 50 et 400 d\'euros';
         }
         if (
            filter_var(
                $room['pricesp'],
                FILTER_VALIDATE_FLOAT,
                array("options" => array("min_range" => 50, "max_range" => 400))
            ) === false
        ) {
            $this->errors[] = 'Le prix n\'est pas correct (doit être compris entre 50 et 400 d\'euros';
        }
         return $this->errors ?? [];
     }
     public function checkInputValues(array $room, string $field, int $maxLength)
     {
         if (!isset($room[$field]) || empty($room[$field])) {
             $this->errors[] = "Ce champ est aussi vide que ma chambre";
         }
         if (strlen($room[$field]) > $maxLength) {
             $this->errors[] = "C'est trop long, $maxLength caractères MAX";
         }
    }
  */
}
