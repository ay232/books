<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class APIBaseController extends Controller
{
    /**
     * @var array
     */
    private $templateResponse = [
        'status'=>true,
        'message'=>"OK",
        'errors'=>null,
        'debugData'=>null,
    ];
    //
    /**
     * success response method.
     *
     * @param $result
     * @param $message
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public function sendResponse($result, $message='ok', $httpStatusCode = JsonResponse::HTTP_OK): JsonResponse
    {
        $this->templateResponse['message'] = $message;

        # pagination fix
        if ($result instanceof AnonymousResourceCollection) {
            $this->templateResponse = array_merge($this->templateResponse, $result->response()->getData(true));
        } else {
            $this->templateResponse['data'] = $result;
        }

        return new JsonResponse($this->templateResponse, $httpStatusCode);
    }

    /**
     * return error response.
     *
     * @param null $errors
     * @param string $message
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public function sendError($errors = null, $message = '', $httpStatusCode = JsonResponse::HTTP_NOT_FOUND): JsonResponse
    {
        $this->templateResponse = array_merge($this->templateResponse,[
            'status' => false,
            'data'    => null,
            'message' => $message,
            'errors'  => $errors,
        ]);

        return new JsonResponse($this->templateResponse, $httpStatusCode);
    }

    /**
     * return error OAuth response.
     *
     * @param $message
     * @param string $errorType
     * @param int $httpStatusCode
     * @return JsonResponse
     */
    public function sendOAuthError($message, $errorType = '', $httpStatusCode = JsonResponse::HTTP_BAD_REQUEST): JsonResponse
    {
        $this->templateResponse = array_merge($this->templateResponse,
            ['error'             => $errorType,
            'error_description' => $message,
            'message'           => $message,
        ]);

        return new JsonResponse($this->templateResponse, $httpStatusCode);
    }
}
