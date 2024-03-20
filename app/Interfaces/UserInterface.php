<?php

namespace App\Interfaces;

interface UserInterface
{
    public function findById($id, $withRelations = [], $method = 'findOrFail');
    public function findByIdHash($id, $withRelations = [], $method = 'firstOrFail');
    public function findUserLogin($username, $password);
}
