<?php

namespace App\Services;

use App\Repositories\ProductsRepository;
use App\Factories\ProductsFactory;

class ProductsService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProductsRepository();
    }

    public function getAllProducts(): array
    {
        $rows = $this->repository->findAll();
        $products = [];

        foreach ($rows as $row) {
            $products[] = ProductsFactory::createFromArray($row);
        }

        return $products;
    }

    public function getCourseBySlug(string $slug)
    {
        $data = $this->repository->findBySlug($slug);
        return $data ? ProductsFactory::createFromArray($data) : null;
    }
}
