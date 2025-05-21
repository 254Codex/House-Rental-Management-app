<?php
ob_start();
include 'admin_class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null; // Sanitize input
$crud = new Action();

$response = null; // Initialize response variable

switch ($action) {
    case 'login':
        $response = $crud->login();
        break;

    case 'login2':
        $response = $crud->login2();
        break;

    case 'logout':
        $response = $crud->logout();
        break;

    case 'logout2':
        $response = $crud->logout2();
        break;

    case 'save_user':
        $response = $crud->save_user();
        break;

    case 'delete_user':
        $response = $crud->delete_user();
        break;

    case 'signup':
        $response = $crud->signup();
        break;

    case 'update_account':
        $response = $crud->update_account();
        break;

    case 'save_settings':
        $response = $crud->save_settings();
        break;

    case 'save_category':
        $response = $crud->save_category();
        break;

    case 'delete_category':
        $response = $crud->delete_category();
        break;

    case 'save_house':
        $response = $crud->save_house();
        break;

    case 'delete_house':
        $response = $crud->delete_house();
        break;

    case 'save_tenant':
        $response = $crud->save_tenant();
        break;

    case 'delete_tenant':
        $response = $crud->delete_tenant();
        break;

    case 'get_tdetails':
        $response = $crud->get_tdetails();
        break;

    case 'save_payment':
        $response = $crud->save_payment();
        break;

    case 'delete_payment':
        $response = $crud->delete_payment();
        break;

    default:
        $response = json_encode(['status' => 'error', 'message' => 'Invalid action']);
        break;
}

if ($response) {
    header('Content-Type: application/json'); // Set the content type to JSON
    echo $response; // Output the response
}

ob_end_flush();
?>