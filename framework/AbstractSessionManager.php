<?php
namespace COMP3385;

abstract class AbstractSessionManager {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    abstract public function set($key, $value) ;

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function delete($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public function destroy() {
        session_destroy();
    }

    // Other methods can be added as needed
}
