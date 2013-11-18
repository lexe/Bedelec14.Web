<?php

function sec_session_start() {
    $session_name = 'bedelec14';
    $secure = false; // true for https
    $httponly = true; // this stops javescript being able to access the session id
    
    ini_set('session.use_only_cookies', 1); // forces sessions to only use cookies
    $cookieParams = session_get_cookie_params(); // gets current cookies params
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    session_name($session_name);
    session_start();
    session_regenerate_id(); // regenerated the session, delete the old one
}

function login($userName, $password, $mysqli) {
    $stmt = $mysqli->prepare("SELECT ID FROM Users WHERE Name=? AND Password=?");
    if ($stmt) {
        $stmt->bind_param('ss', $userName, $password);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($user_id);
        $stmt->fetch();

        if ($stmt->num_rows == 1 && $user_id > 0) {
            $_SESSION['user_name'] = $userName;
            $_SESSION['user_id'] = $user_id;
            return true;
        }
        else { 
            return false;
        }
    }
    else {
        return false;
    }
}

function login_check($mysqli) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        
        $stmt = $mysqli->prepare("SELECT ID, Name FROM Users WHERE ID=?");
        if ($stmt) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            
            if ($stmt->num_rows == 1) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }
    else {
        return false;
    }
}