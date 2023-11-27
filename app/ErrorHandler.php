<?php
namespace COMP3385;

class ErrorHandler extends AbstractErrorHandler
{
    public function handleError($errno, $errstr, $errfile, $errline)
    {

        $errorLog = "Error: $errstr in $errfile on line $errline\n";
        error_log($errorLog, 3, 'error_log.txt');

    }

    public function handleException($exception)
    {

        $exceptionLog = "Exception: {$exception->getMessage()} in {$exception->getFile()} on line {$exception->getLine()}\n";
        error_log($exceptionLog, 3, 'exception_log.txt');

    }
}