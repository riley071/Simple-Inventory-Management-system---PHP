<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
// This script acts as a controller for handling various actions requested by a user through the $_GET['action'] parameter.
// It initializes output buffering and includes the admin_class.php file, which contains the Action class definition.
// Based on the value of the action parameter received via the GET method, the script executes different methods of the Action class,
// echoing the return value of each method for further processing.
// Overall, this script serves as a central hub for interpreting user actions and delegating them to appropriate methods within the Action class for execution.

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}
if($action == "delete_category"){
	$save = $crud->delete_category();
	if($save)
		echo $save;
}
if($action == "save_type"){
	$save = $crud->save_type();
	if($save)
		echo $save;
}
if($action == "delete_type"){
	$save = $crud->delete_type();
	if($save)
		echo $save;
}

if($action == "save_supplier"){
	$save = $crud->save_supplier();
	if($save)
		echo $save;
}
if($action == "delete_supplier"){
	$save = $crud->delete_supplier();
	if($save)
		echo $save;
}
if($action == "save_product"){
	$save = $crud->save_product();
	if($save)
		echo $save;
}
if($action == "delete_product"){
	$save = $crud->delete_product();
	if($save)
		echo $save;
}
if($action == "save_receiving"){
	$save = $crud->save_receiving();
	if($save)
		echo $save;
}
if($action == "delete_receiving"){
	$save = $crud->delete_receiving();
	if($save)
		echo $save;
}
if($action == "save_customer"){
	$save = $crud->save_customer();
	if($save)
		echo $save;
}
if($action == "delete_customer"){
	$save = $crud->delete_customer();
	if($save)
		echo $save;
}

if($action == "chk_prod_availability"){
	$save = $crud->chk_prod_availability();
	if($save)
		echo $save;
}

if($action == "save_sales"){
	$save = $crud->save_sales();
	if($save)
		echo $save;
}

if($action == "delete_sales"){
	$save = $crud->delete_sales();
	if($save)
		echo $save;
}

if($action == "save_expired"){
	$save = $crud->save_expired();
	if($save)
		echo $save;
}

if($action == "delete_expired"){
	$save = $crud->delete_expired();
	if($save)
		echo $save;
}