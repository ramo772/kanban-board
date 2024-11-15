<?php

namespace App\Http\Controllers\WebService\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WebService\Api\MemberCard\CreateMemberCardRequest;
use App\Http\Requests\WebService\Api\MemberCard\UpdateStatusMemberCardRequest;
use App\Http\Services\MemberCardService;
use App\Models\MemberCard;
use Illuminate\Http\Request;

class MemberCardController extends Controller
{

    public function __construct(protected MemberCardService $memberCardService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = $this->memberCardService->getAll();
        return  $this->setCode($response['code'])->setMessages($response['messages'])->setData($response['data'])->customResponse();
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMemberCardRequest $request)
    {
        $response = $this->memberCardService->create($request->validated());
        return  $this->setCode($response['code'])->setMessages($response['messages'])->setData($response['data'])->customResponse();
    }

    public function updateStatus(UpdateStatusMemberCardRequest $request, string $id)
    {
        $response = $this->memberCardService->updateStatus($request->validated(), $id);
        return  $this->setCode($response['code'])->setMessages($response['messages'])->setData($response['data'])->customResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $response = $this->memberCardService->delete($id);
        return  $this->setCode($response['code'])->setMessages($response['messages'])->setData($response['data'])->customResponse();
    }
}
