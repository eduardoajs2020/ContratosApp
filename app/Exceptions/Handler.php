<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            $e = 'Erro Genérico';
            if ($e instanceof QueryException) {
                $e = 'Erro ao acessar o banco de dados';
                }
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                    $e = 'Erro de validação';
                }
        });
    }

     public function render($request, Throwable $exception)
{
    // Verifica se é uma QueryException
    if ($exception instanceof \Illuminate\Database\QueryException) {
        // Mensagem de erro personalizada para QueryException
        $errorMessage = "Ocorreu um erro no banco de dados. Por favor, verifique os dados inseridos e tente novamente! Detalhes do erro: " . $exception->getMessage();
        // Retorna uma resposta com o código de status 500
        return response()->json(['error' => $errorMessage], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    return parent::render($request, $exception);
    }
}
