<?php
namespace COMP3385;

 class SessionManager extends AbstractSessionManager {

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    public function deleteAll() {
        if (session_status() != PHP_SESSION_NONE) {
            session_unset();
        }
    }
    // Other methods can be added as needed
}
