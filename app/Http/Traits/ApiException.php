<?php

namespace App\Http\Traits;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;
use Throwable;


trait ApiException{
    protected function getJsonException($e, $request)
    {
        if($request->is('api/*')){
            if($e instanceof NotFoundHttpException){
                return $this->notFoundException();
            }
            if($e instanceof HttpException){
                return $this->httpException($e);
            }
            return $this->genericExceptions();
        }
    }

    protected function notFoundException()
    {
        return $this->getResponse(
            "Recurso não Encontrado",
            "01",
            404
        );
    }

    protected function genericExceptions()
    {
        return $this->getResponse(
            "Erro interno no Servidor",
            "02",
            500
        );
    }

    protected function httpException($e)
    {

        $messages = [
            403 => [
                "code" => "03",
                "message" => "Acesso não permitido"
            ],
            405 => [
                "code" => "04",
                "message" => "Verbo Http não permitido"
            ]
            ];

        return $this->getResponse(
            $messages[$e->getStatusCode()]["message"],
            $messages[$e->getStatusCode()]["code"],
            $e->getStatusCode(),
        );
    }

    protected function getResponse($message, $code, $status)
    {
        return response()->json([
            "errors" => [
                "status" => $status,
                "code" => $code,
                "message" => $message
            ]
            ], $status);
    }
}
