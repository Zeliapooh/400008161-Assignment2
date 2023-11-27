<?php
namespace COMP3385;
class ErrorHandler extends AbstractErrorHandler {
public function handleError($errno, $errstr, $errfile, $errline) {
// Custom error handling logic goes here
// You can log the error, display a friendly error message, etc.

$errorLog = "Error: $errstr in $errfile on line $errline\n";
error_log($errorLog, 3, 'error_log.txt');

}

public function handleException($exception) {
    // Handle exceptions
    // You can customize this method to suit your needs
    
    // Example: Log exceptions to a file
    $exceptionLog = "Exception: {$exception->getMessage()} in {$exception->getFile()} on line {$exception->getLine()}\n";
   // echo $exceptionLog;
    error_log($exceptionLog, 3, 'exception_log.txt');
    
    // Display a user-friendly error message or redirect to an error page (optional)
}
}