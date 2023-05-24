<?php

namespace App\Controller;

use App\Model\ReservationManager;

class ReservationController extends AbstractController
{
    public function index(): string
    {
        $reservationManager = new ReservationManager();
        $reservations = $reservationManager->selectAll();
        if (!$_SESSION['isLogin']) {
            header('Location:/forbidden');
        }
        return $this->twig->render('Reservation/index.html.twig', ['reservations' => $reservations]);
    }
    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $reservationManager = new ReservationManager();
        $reservation = $reservationManager->selectOneById($id);

        return $this->twig->render('Reservation/show.html.twig', ['reservation' => $reservation]);
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): ?string
    {
        $reservationManager = new ReservationManager();
        $reservation = $reservationManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $reservation = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
/*
            $this->errors = $this->validate($room);
            if (!empty($this->errors)) {
                return $this->twig->render('Room/edit.html.twig', ['errors' => $this->errors]);
            }
*/
            $reservationManager->update($reservation);

            header('Location: /reservations/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Reservation/edit.html.twig', [
            'reservation' => $reservation,
        ]);
    }

    /**
     * Add a new item
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $reservation = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
/*
            $this->errors = $this->validate($room);

            if (!empty($this->errors)) {
                return $this->twig->render('Room/add.html.twig', ['errors' => $this->errors]);
            }
*/
            $reservationManager = new ReservationManager();
            $id = $reservationManager->insert($reservation);

            header('Location:/reservations/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Reservation/add.html.twig');
    }

    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $reservationManager = new ReservationManager();
            $reservationManager->delete((int)$id);

            header('Location:/reservations');
        }
    }
}
