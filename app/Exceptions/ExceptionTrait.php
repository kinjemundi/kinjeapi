<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
/**
 * for hadling exception
 */
trait ExceptionTrait
{
    public function apiException($request,$e)
    {
        if ($this->isModel($e)) {
            return $this->ModelResponse();
         }

        if ($this->isHttp($e)) {
            return $this->HttpResponse();
         }

         return parent::render($request, $exception);
    }

    protected function isModel($e)
    {
        return $e instanceOf ModelNotFoundException;
    }

    protected function isHttp($e)
    {
        return $e instanceOf NotFoundHttpException;
    }

    protected function ModelResponse()
    {
        return response()->json([
            'errors' => 'Product Model not Found'
        ],Response::HTTP_NOT_FOUND);
    }

    protected function HttpResponse()
    {
        return response()->json([
            'errors' => 'Incorrect Route'
        ],Response::HTTP_NOT_FOUND);
    }
}
