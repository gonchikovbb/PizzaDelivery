<?php

namespace App\Http\Controllers\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\AddressCreateRequest;
use App\Http\Requests\Address\AddressUpdateRequest;
use App\Http\Resources\Address\AddressResource;
use App\Models\Address\Address;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AddressController extends Controller
{
    /**
     * Показать все Адреса
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     * @apiResourceCollection App\Http\Resources\Address\AddressResource
     * @apiResourceModel App\Models\Address\Address
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $models = Address::query()
            ->paginate($request->get('per_page') ?? 25);
        return AddressResource::collection($models);
    }

    /**
     * Создать Адрес
     *
     * @param AddressCreateRequest $request
     * @apiResource App\Http\Resources\Address\AddressResource
     * @apiResourceModel App\Models\Address\Address
     */
    public function store(AddressCreateRequest $request): AddressResource
    {
        return new AddressResource(Address::create($request->validated()));
    }

    /**
     * Показать Адрес
     *
     * @param Address $address
     * @return AddressResource
     * @apiResource App\Http\Resources\Address\AddressResource
     * @apiResourceModel App\Models\Address\Address
     */
    public function show(Address $address): AddressResource
    {
        return new AddressResource($address);
    }

    /**
     * Обновить Адрес
     *
     * @param AddressUpdateRequest $request
     * @param Address $address
     * @return AddressResource
     */
    public function update(AddressUpdateRequest $request, Address $address): AddressResource
    {
        $address->update($request->validated());
        return new AddressResource($address);
    }

    /**
     * Удалить Адрес
     *
     * @param Address $address
     * @return JsonResponse
     */
    public function destroy(Address $address): JsonResponse
    {
        $address->delete();

        return response()->json(['message' => 'Адрес успешно удален.'], 204);
    }
}
