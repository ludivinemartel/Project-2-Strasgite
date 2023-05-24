<?php

namespace App\Controller;

use App\Model\RoomManager;

class RoomController extends AbstractController
{
    public function index(): string
    {
        $roomManager = new RoomManager();
        $rooms = $roomManager->selectAll();
        if (!$_SESSION['isLogin']) {
            header('Location:/forbidden');
        }
        return $this->twig->render('Room/index.html.twig', ['rooms' => $rooms]);
    }
    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById($id);

        return $this->twig->render('Room/show.html.twig', ['room' => $room]);
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): ?string
    {
        $roomManager = new RoomManager();
        $room = $roomManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $room = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
/*
            $this->errors = $this->validate($room);
            if (!empty($this->errors)) {
                return $this->twig->render('Room/edit.html.twig', ['errors' => $this->errors]);
            }
*/
            $roomManager->update($room);

            header('Location: /rooms/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Room/edit.html.twig', [
            'room' => $room,
        ]);
    }

    /**
     * Add a new item
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $room = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
/*
            $this->errors = $this->validate($room);

            if (!empty($this->errors)) {
                return $this->twig->render('Room/add.html.twig', ['errors' => $this->errors]);
            }
*/
            $roomManager = new RoomManager();
            $id = $roomManager->insert($room);

            header('Location:/rooms/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Room/add.html.twig');
    }

    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $roomManager = new RoomManager();
            $roomManager->delete((int)$id);

            header('Location:/rooms');
        }
    }
}
