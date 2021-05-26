<?php
    session_start();
    include 'utils/middleware.php';
    if(isset($_GET['route'])){
        $route = $_GET['route'];
        switch ($route) {
            case '/':
                include 'app/web/index.php';
                break;
            case 'init-admin':
                include 'business/services/UserService.php';
                createAdmin();
                break;
            case 'login':
                $token = isLoginGetToken();
                if($token!=null){
                    header('location: ?route=admin');
                }
                include 'app/web/login.php';
                break;
            case 'admin':
                if(!isLoginGetToken()){
                    header("location: ?route=login");
                    return;
                }
                if(!isAdmin()){
                    header("location: ?route=/");
                }
                include 'app/web/admin/admin.php';
                break;
            case 'admin/items': 
                if(!isLoginGetToken()){
                    header("location: ?route=login");
                    return;
                }
                if(!isAdmin()){
                    header("location: ?route=/");
                }
                include 'app/web/admin/items.php';
                break;
            case 'admin/items/categories':
                if(!isLoginGetToken()){
                    header("location: ?route=login");
                    return;
                }
                if(!isAdmin()){
                    header("location: ?route=/");
                }
                include 'app/web/admin/items-categories.php';
                break;
            case 'logout':
                include 'business/services/Auth.php';
                logout();
                break;
            case 'admin/admins': 
                if(!isLoginGetToken()){
                    header("location: ?route=login");
                    return;
                }
                if(!isAdmin()){
                    header("location: ?route=/");
                }
                include 'app/web/admin/admins.php';
                break;
            default:
                include 'app/web/404page.html';
                break;
        }
    }else{
        include 'app/web/index.php';
    }
?>