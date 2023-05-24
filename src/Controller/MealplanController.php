<?php

namespace App\Controller;

use App\Model\MealplanManager;

class MealplanController extends AbstractController
{
    public function index(): string
    {
        $mealplanManager = new MealplanManager();
        $mealplans = $mealplanManager->selectAll();
        if (!$_SESSION['isLogin']) {
            header('Location:/forbidden');
        }
        return $this->twig->render('Mealplan/index.html.twig', ['mealplans' => $mealplans]);
    }
    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $mealplanManager = new MealplanManager();
        $mealplan = $mealplanManager->selectOneById($id);

        return $this->twig->render('Mealplan/show.html.twig', ['mealplan' => $mealplan]);
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): ?string
    {
        $mealplanManager = new MealplanManager();
        $mealplan = $mealplanManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $mealplan = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
/*
            $this->errors = $this->validate($room);
            if (!empty($this->errors)) {
                return $this->twig->render('Room/edit.html.twig', ['errors' => $this->errors]);
            }
*/
            $mealplanManager->update($mealplan);

            header('Location: /mealplans/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Mealplan/edit.html.twig', [
            'mealplan' => $mealplan,
        ]);
    }

    /**
     * Add a new item
     */
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $mealplan = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
/*
            $this->errors = $this->validate($room);

            if (!empty($this->errors)) {
                return $this->twig->render('Room/add.html.twig', ['errors' => $this->errors]);
            }
*/
            $mealplanManager = new MealplanManager();
            $id = $mealplanManager->insert($mealplan);

            header('Location:/mealplans/show?id=' . $id);
            return null;
        }

        return $this->twig->render('Mealplan/add.html.twig');
    }

    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $mealplanManager = new MealplanManager();
            $mealplanManager->delete((int)$id);

            header('Location:/mealplans');
        }
    }
}
