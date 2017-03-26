<?php
/**
 * Created by IntelliJ IDEA.
 * User: RoYaL
 * Date: 11/24/2016
 * Time: 9:43 PM
 */

namespace SoftUni\Services;


use SoftUni\Models\Binding\Categories\CategoryAddBindingModel;

interface CategoryServiceInterface
{
    public function add(CategoryAddBindingModel $model): bool;

    public function findAll();
}