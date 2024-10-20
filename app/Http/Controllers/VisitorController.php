<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Cases\CreateVisitorCase;
use App\Cases\DeleteVisitorCase;
use App\Cases\GetVisitorCase;
use App\Cases\UpdateVisitorCase;
use App\Exceptions\CountryByPhoneApiException;
use App\Forms\CreateVisitorForm;
use App\Forms\UpdateVisitorForm;
use App\Http\Requests\CreateVisitorRequest;
use App\Http\Requests\DeleteVisitorRequest;
use App\Http\Requests\GetVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class VisitorController extends Controller
{
    /**
     * @throws GuzzleException
     * @throws CountryByPhoneApiException
     * @throws \JsonException
     */
    public function create(CreateVisitorRequest $request, CreateVisitorCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $createVisitorForm = new CreateVisitorForm($requestData);
        $visitorId = $case->handle($createVisitorForm);

        return response()->json(['visitor_id' => $visitorId], 200, ['Content-Type' => 'string']);
    }

    /**
     * @param UpdateVisitorRequest $request
     * @param UpdateVisitorCase $case
     * @return JsonResponse
     */
    public function update(UpdateVisitorRequest $request, UpdateVisitorCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $updateVisitorForm = new UpdateVisitorForm($requestData);
        $case->handle($updateVisitorForm);

        return response()->json(['message' => 'success'], 200, ['Content-Type' => 'string']);
    }

    /**
     * @param GetVisitorRequest $request
     * @param GetVisitorCase $case
     * @return JsonResponse
     */
    public function get(GetVisitorRequest $request, GetVisitorCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $visitorId = (int)$requestData['id'];
        $visitor = $case->handle($visitorId);

        return response()->json(['visitor' => $visitor], 200, ['Content-Type' => 'string']);
    }

    /**
     * @param DeleteVisitorRequest $request
     * @param DeleteVisitorCase $case
     * @return JsonResponse
     */
    public function delete(DeleteVisitorRequest $request, DeleteVisitorCase $case): JsonResponse
    {
        $requestData = $request->validated();
        $visitorId = (int)$requestData['id'];
        $case->handle($visitorId);

        return response()->json([['message' => 'success']], 200, ['Content-Type' => 'string']);
    }
}
