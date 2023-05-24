<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function index(): string
    {
        $userManager = new UserManager();
        $users = $userManager->selectAll();
        if (!$_SESSION['isLogin']) {
            header('Location:/forbidden');
        }
        return $this->twig->render('User/index.html.twig', ['users' => $users]);
    }
    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $userManager = new UserManager();
        $user = $userManager->selectOneById($id);

        return $this->twig->render('User/show.html.twig', ['user' => $user]);
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): ?string
    {
        $userManager = new UserManager();
        $user = $userManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $user = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
/*
            $this->errors = $this->validate($room);
            if (!empty($this->errors)) {
                return $this->twig->render('Room/edit.html.twig', ['errors' => $this->errors]);
            }
*/
            $userManager->update($user);

            header('Location: /users/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('User/edit.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * Add a new item
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $user = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
/*
            $this->errors = $this->validate($room);

            if (!empty($this->errors)) {
                return $this->twig->render('Room/add.html.twig', ['errors' => $this->errors]);
            }
*/
            $userManager = new UserManager();
            $id = $userManager->insert($user);

            header('Location:/users/show?id=' . $id);
            return null;
        }

        return $this->twig->render('User/add.html.twig');
    }

    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $userManager = new UserManager();
            $userManager->delete((int)$id);

            header('Location:/users');
        }
    }
}
