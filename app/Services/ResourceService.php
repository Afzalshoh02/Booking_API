<?php

namespace App\Services;

use App\Repositories\ResourceRepository;

class ResourceService {
    protected $repository;
    public function __construct(ResourceRepository $repository)
    {
        $this->repository = $repository;
    }
    public function create(array $data)
    {
        return $this->repository->create($data);
    }
}
