<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['HomeController', 'index',],
    'items' => ['ItemController', 'index',],
    'items/edit' => ['ItemController', 'edit', ['id']],
    'items/show' => ['ItemController', 'show', ['id']],
    'items/add' => ['ItemController', 'add',],
    'items/delete' => ['ItemController', 'delete',],
    'bedroom' => ['BedroomController', 'bedroom',['id']],
    'legalnotice' => ['LegalnoticeController', 'legalnotice',],
    'contact' => ['ContactController', 'Index',],
    'confirmation' => ['ConfirmationController', 'confirmation',],
    'confirmation/show' => ['ConfirmationController', 'confirmation', ['id']],
    'chambre' => ['ChambreController', 'chambre',],
    'reservation' => ['ChambreController', 'chambre',],
    'login' => ['SecurityController', 'login',],
    'logout' => ['SecurityController', 'logout',],
    'forbidden' => ['SecurityController', 'forbidden',],
    'dashboard' => ['DashboardController', 'index',],
    'rooms' => ['RoomController', 'index',],
    'rooms/show' => ['RoomController', 'show', ['id']],
    'rooms/edit' => ['RoomController', 'edit', ['id']],
    'rooms/add' => ['RoomController', 'add'],
    'rooms/delete' => ['RoomController', 'delete'],
    'users' => ['UserController', 'index',],
    'users/show' => ['UserController', 'show', ['id']],
    'users/edit' => ['UserController', 'edit', ['id']],
    'users/add' => ['UserController', 'add'],
    'users/delete' => ['UserController', 'delete'],
    'mealplans' => ['MealplanController', 'index',],
    'mealplans/show' => ['MealplanController', 'show', ['id']],
    'mealplans/edit' => ['MealplanController', 'edit', ['id']],
    'mealplans/add' => ['MealplanController', 'add'],
    'mealplans/delete' => ['MealplanController', 'delete'],
    'reservations' => ['ReservationController', 'index',],
    'reservations/show' => ['ReservationController', 'show', ['id']],
    'reservations/edit' => ['ReservationController', 'edit', ['id']],
    'reservations/add' => ['ReservationController', 'add'],
    'reservations/delete' => ['ReservationController', 'delete'],
];
