<?php

use App\Models\User;

function abort($status = 404)
{
    require "./../views/errors/$status.php";
    exit();
}

function dd($data)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
    die();
}

function auth()
{
    $user = new User();
    return $user->get(session_get('userData')['email']);
}

function view($view, $data = null, $isDashbaord = true)
{
    if ($data && count($data)) {
        extract($data);
    }
    if ($isDashbaord) {
        require "../views/layouts/master.php";
    } else {
        require "../views/" . str_replace('.', '/', $view) . '.php';
    }
}

function asset($path = '')
{
    return APP_URL . '/' . trim($path, '/');
}
function storage($path = '')
{
    return APP_URL . '/storage/users/' . session_get('userData')['id'] . '/' . trim($path, '/');
}
function storage_dir($path = '')
{
    return __DIR__ . '/../storage/' . trim($path, '/');
}
function url($path = '')
{
    return APP_URL . '/' . trim($path, '/');
}
function template_assets($template_id, $icon)
{
    return APP_URL . '/storage/assets/template/template_' . $template_id . '/' . $icon;
}
function font($font)
{
    return APP_URL . '/storage/fonts/' . $font;
}
function getPhoto($photo = '')
{
    if (!$photo) {
        return APP_URL . '/storage/users/no-photo.webp';
    }
    return APP_URL . '/storage/users/' . session_get('userData')['id'] . '/photo/' . $photo;
}
function getThumbnail($cv_id)
{
    return APP_URL . '/storage/users/' . session_get('userData')['id'] . '/files/' . $cv_id . '/thumb.jpeg';
}
function redirect($url = '')
{
    if ($url) {
        $location = APP_URL . '/' . trim($url, '/');
        header("location: $location");
        die();
    }
}

function session_set($key = '', $value = '')
{
    if ($key && $value) {
        $_SESSION[$key] = $value;
    }
}
function session_get($key)
{
    if ($key && isset($_SESSION[$key])) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
    }
}
function session_has($key)
{
    return isset($_SESSION[$key]);
}

function session_del($key = '')
{
    if ($key && isset($_SESSION[$key])) {
        unset($_SESSION[$key]);
    }
}

function post_request()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}
