<?php

namespace App\Controller;

use App\Model\ConfirmationManager;
use DateTime;
use PDO;

class ConfirmationController extends AbstractController
{
    /**
     * Display confirmation page
     */
    public function confirmation()
    {
        $confirmation = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nettoyage des données $_POST
            $confirmation = array_map('trim', $_POST);
            // Si la validation est OK, insertion et redirection
            $confirmationManager = new ConfirmationManager();
            $confirmationManager->insert($confirmation);

            // Stockage des informations dans une variable de session
            $_SESSION['confirmation'] = [
            'dateArrivee' => $_POST['datestart'],
            'dateDepart' => $_POST['dateend'],
            'nbPersonnes' => $_POST['nbPersonnes'],
            'optionsSupp' => $_POST['mealplan'],
            'id' => $_POST['id']
            ];
         // Appel de la méthode confirmationAction() avec les informations de réservation en paramètres
            return $this->confirmationAction($_SESSION['confirmation']);
        }
    }

    public function confirmationAction($reservation)
    {
        $dateArrivee = $reservation['dateArrivee'];
        $dateDepart = $reservation['dateDepart'];
        $nbPersonnes = $reservation['nbPersonnes'];
        $optionsSupp = $reservation['optionsSupp'];
        $id = $reservation['id'];

    // Validation des données ici

        $confirmationManager = new ConfirmationManager();
        $totalPrice = $this->calculatePrice(
            $dateArrivee,
            $dateDepart,
            $nbPersonnes,
            $optionsSupp,
            $id,
            $confirmationManager->getPDO()
        );

    // Envoi des données à la vue confirmation.html.twig
        return $this->twig->render('Confirmation/confirmation.html.twig', [
        'dateArrivee' => $dateArrivee,
        'dateDepart' => $dateDepart,
        'nbPersonnes' => $nbPersonnes,
        'optionsSupp' => $optionsSupp,
        'totalPrice' => $totalPrice,
        // Ajout de toutes les informations dans la vue
        'reservation' => $reservation,
        ]);
    }
    /**
     * Calculate the total price of a reservation
     */
    public function calculatePrice($dateArrivee, $dateDepart, $nbPersonnes, $optionsSupp, $id, PDO $pdo)
    {
    // Récupération des informations de la chambre
        $roomQuery = "SELECT price FROM room WHERE id = :id";
        $roomStatement = $pdo->prepare($roomQuery);
        $roomStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $roomStatement->execute();
        $roomPrice = $roomStatement->fetchColumn();

    // Calcul du prix total en fonction des dates
        $date1 = new DateTime($dateArrivee);
        $date2 = new DateTime($dateDepart);
        $diff = $date2->diff($date1)->format("%a");
        /** @phpstan-ignore-next-line */
        $totalPrice = $roomPrice * $diff;

    // Vérification si $optionsSupp est vide
        if (empty($optionsSupp)) {
            // Si c'est le cas, on met un tableau vide pour éviter une erreur
            $optionsSupp = [];
        }

    // Conversion de $optionsSupp en tableau si besoin
        if (!is_array($optionsSupp)) {
            $optionsSupp = explode(',', $optionsSupp);
        }

    // Calcul du prix total en fonction des options de restauration ajoutées
        $mealplanPrice = 0;
        foreach ($optionsSupp as $option) {
            $mealplanQuery = "SELECT price FROM mealplan WHERE type = :type";
            $mealplanStatement = $pdo->prepare($mealplanQuery);
            $mealplanStatement->bindValue(':type', $option, PDO::PARAM_STR);
            $mealplanStatement->execute();
            $mealplanPrice += $mealplanStatement->fetchColumn();
        }
           /** @phpstan-ignore-next-line */
        $totalPrice += $mealplanPrice * $nbPersonnes * $diff;

        return $totalPrice;
    }
}
