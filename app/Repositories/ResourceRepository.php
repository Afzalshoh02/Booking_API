<?php

namespace App\Repositories;

use App\Models\Resource;

class ResourceRepository {
    public function all()
    {
        return Resource::orderByDesc('id')->get();
    }
    public function create(array $data)
    {
        return Resource::create($data);
    }
}
