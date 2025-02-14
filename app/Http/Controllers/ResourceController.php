<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Resources\ResourceResource;
use App\Repositories\ResourceRepository;
use App\Services\ResourceService;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/resources",
     *     summary="Получить список ресурсов",
     *     tags={"Resources"},
     *     @OA\Response(response=200, description="Список ресурсов")
     * )
     */

    public function index(ResourceRepository $repository) {
        return ResourceResource::collection($repository->all());
    }

    /**
     * @OA\Post(
     *     path="/api/resources",
     *     summary="Создать ресурс",
     *     tags={"Resources"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"name", "type"},
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="type", type="string"),
     *                 @OA\Property(property="description", type="string", nullable=true)
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Успешное создание ресурса")
     * )
     */

    public function store(StoreResourceRequest $request, ResourceService $service) {
        $data = $request->validated();
        return new ResourceResource($service->create($data));
    }
}
