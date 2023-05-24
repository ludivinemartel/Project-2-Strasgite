<?php

namespace App\Model;

use PDO;

class ReservationManager extends AbstractManagerAdmin
{
    public const TABLE = 'reservation';

    /**
     * Insert new item in database
     */
    public function insert(array $reservation): int
    {
        $query = "INSERT INTO " . self::TABLE .
            " (`id`,`datestart`, `dateend`, `nbpersonnes`, `id_room`, `id_mealplan`)
        VALUES (:id, :datestart, :dateend, :nbpersonnes, :id_room, :id_mealplan)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $reservation['id'], \PDO::PARAM_STR);
        $statement->bindValue(':datestart', $reservation['datestart'], \PDO::PARAM_STR);
        $statement->bindValue(':dateend', $reservation['dateend'], \PDO::PARAM_STR);
        $statement->bindValue(':nbpersonnes', $reservation['nbpersonnes'], \PDO::PARAM_STR);
        $statement->bindValue(':id_room', $reservation['id_room'], \PDO::PARAM_STR);
        $statement->bindValue(':id_mealplan', $reservation['id_mealplan'], \PDO::PARAM_STR);
        $statement->execute();

        return (int)$this->pdo->lastInsertId();
    }

    /**
     * Update item in database
     */
    public function update(array $reservation): bool
    {
        $query = "UPDATE " . self::TABLE . " SET `datestart` = :datestart, `dateend` = :dateend, 
        `nbpersonnes` = :nbpersonnes, `id_room` = :id_room,
        `id_mealplan` = :id_mealplan  WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('id', $reservation['id'], \PDO::PARAM_INT);
        $statement->bindValue('datestart', $reservation['datestart'], \PDO::PARAM_STR);
        $statement->bindValue('dateend', $reservation['dateend'], \PDO::PARAM_STR);
        $statement->bindValue('nbpersonnes', $reservation['nbpersonnes'], \PDO::PARAM_STR);
        $statement->bindValue('id_room', $reservation['id_room'], \PDO::PARAM_STR);
        $statement->bindValue('id_mealplan', $reservation['id_mealplan'], \PDO::PARAM_STR);

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
