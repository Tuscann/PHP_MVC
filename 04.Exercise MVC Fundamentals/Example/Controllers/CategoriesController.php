<?php
/**
 * Created by IntelliJ IDEA.
 * User: RoYaL
 * Date: 11/24/2016
 * Time: 9:38 PM
 */

namespace SoftUni\Controllers;


use SoftUni\Core\ViewInterface;
use SoftUni\Models\Binding\Categories\CategoryAddBindingModel;
use SoftUni\Services\CategoryServiceInterface;
use SoftUni\Services\ResponseServiceInterface;

class CategoriesController
{
    private $view;
    private $categoryService;
    private $responseService;

    public function __construct(ViewInterface $view,
                                CategoryServiceInterface $categoryService,
                                ResponseServiceInterface $responseService)
    {
        $this->view = $view;
        $this->categoryService = $categoryService;
        $this->responseService = $responseService;
    }


    public function add()
    {
        $this->view->render();
    }

    public function addPost(CategoryAddBindingModel $bindingModel)
    {
        $this->categoryService->add($bindingModel);
        $this->responseService->redirect("categories", "view");
    }

    public function view()
    {
        $categories = $this->categoryService->findAll();
        $this->view->render($categories);
    }

    public function topics()
    {
        // todo
    }
}