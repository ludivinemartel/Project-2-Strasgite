<?php

namespace App\Model;

use PDO;
use DateTime;

class ConfirmationManager extends AbstractManager
{
    public const TABLE = 'reservation';

    /**
     * Inserer nouvelle réservation dans la BDD
     */
    public function insert(array $confirmation): int
    {
        // Récupérer l'id mealplan
        $mealplanQuery = "SELECT id FROM mealplan WHERE type = :mealplan";
        $mealplanStatement = $this->pdo->prepare($mealplanQuery);
        $mealplanStatement->bindValue('mealplan', $confirmation['mealplan'], PDO::PARAM_STR);
        $mealplanStatement->execute();
        $idMealplan = $mealplanStatement->fetchColumn();

        // Insérer la réservation avec l'id mealplan récupéré
        $query = "INSERT INTO " . self::TABLE . " (datestart, dateend, nbpersonnes, id_room, id_mealplan)
            VALUES (:datestart, :dateend, :nbpersonnes, :id, :id_mealplan)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('datestart', $confirmation['datestart'], PDO::PARAM_STR);
        $statement->bindValue('dateend', $confirmation['dateend'], PDO::PARAM_STR);
        $statement->bindValue('nbpersonnes', $confirmation['nbPersonnes'], PDO::PARAM_STR);
        $statement->bindValue('id', $confirmation['id'], PDO::PARAM_STR);
        $statement->bindValue('id_mealplan', $idMealplan, PDO::PARAM_INT);
        $statement->execute();

        return (int) $this->pdo->lastInsertId();
    }

    public function calculatePrice($dateArrivee, $dateDepart, $nbPersonnes, $optionsSupp, $id)
    {
        // Récupération des informations de la chambre
        $roomQuery = "SELECT price FROM room WHERE id = :id";
        $roomStatement = $this->pdo->prepare($roomQuery);
        $roomStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $roomStatement->execute();
        $roomPrice = $roomStatement->fetchColumn();

        // Calcul du prix total en fonction des dates
        $date1 = new DateTime($dateArrivee);
        $date2 = new DateTime($dateDepart);
        $diff = $date2->diff($date1)->format("%a");
        /** @phpstan-ignore-next-line */
        $totalPrice = $roomPrice * $diff;

    // Calcul du prix total en fonction des options de restauration ajoutées
        $mealplanPrice = 0;
        foreach ($optionsSupp as $option) {
            $mealplanQuery = "SELECT price FROM mealplan WHERE type = :type";
            $mealplanStatement = $this->pdo->prepare($mealplanQuery);
            $mealplanStatement->bindValue(':type', $option, PDO::PARAM_STR);
            $mealplanStatement->execute();
            $mealplanPrice += $mealplanStatement->fetchColumn();
        }
        /** @phpstan-ignore-next-line */
        $totalPrice += $mealplanPrice * $nbPersonnes * $diff;

        return $totalPrice;
    }
    public function getPDO(): PDO
    {
        return parent::getPDO();
    }
}
