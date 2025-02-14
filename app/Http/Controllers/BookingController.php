<?php

namespace App\Http\Controllers;

use App\Exceptions\BookingNotFoundException;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Repositories\BookingRepository;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/bookings",
     *     summary="Создать бронирование",
     *     tags={"Bookings"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 required={"resource_id", "user_id", "start_time", "end_time"},
     *                 @OA\Property(property="resource_id", type="integer"),
     *                 @OA\Property(property="user_id", type="integer"),
     *                 @OA\Property(property="start_time", type="string", format="date"),
     *                 @OA\Property(property="end_time", type="string", format="date")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Успешное создание бронирования",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=20),
     *                 @OA\Property(property="resource_id", type="integer", example=1),
     *                 @OA\Property(property="user_id", type="integer", example=5),
     *                 @OA\Property(property="start_time", type="string", format="date", example="2025-02-14"),
     *                 @OA\Property(property="end_time", type="string", format="date", example="2025-02-20"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-02-14T12:00:00Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-02-14T12:00:00Z")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=400, description="Некорректные данные")
     * )
     */

    public function store(StoreBookingRequest $request, BookingService $service) {
        $data = $request->validated();
        return new BookingResource($service->create($data)->load('resource'));
    }

    /**
     * @OA\Get(
     *     path="/api/resources/{id}/bookings",
     *     summary="Получить все бронирования для ресурса",
     *     tags={"Bookings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Список бронирований для ресурса")
     * )
     */

    public function index($id, BookingRepository $repository) {
        return BookingResource::collection($repository->getByResourceId($id)->load(['resource', 'user']));
    }

    /**
     * @OA\Delete(
     *     path="/api/bookings/{id}",
     *     summary="Отмена бронирования",
     *     tags={"Bookings"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Бронирование отменено")
     * )
     */
    public function destroy($id, BookingService $service): JsonResponse
    {
        try {
            $service->cancel($id);
            return response()->json(['message' => 'Booking canceled successfully.']);
        } catch (BookingNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        } catch (\Exception $e) {
            return response()->json(['message' => 'Something went wrong.'], 500);
        }
    }
}
