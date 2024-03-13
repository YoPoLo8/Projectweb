<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "ananh");

$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to UTF-8
mysqli_set_charset($conn, "utf8");

// Function to execute queries
function executeQuery($sql) {
    global $conn;
    return mysqli_query($conn, $sql);
}

// Function to fetch all rows from a result set as an associative array
function fetchAll($result) {
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to fetch a single row from a result set as an associative array
function fetchOne($result) {
    return mysqli_fetch_assoc($result);
}

// Example function to get all admin records
function getAllAdmins() {
    $sql = "SELECT * FROM admin";
    $result = executeQuery($sql);
    return fetchAll($result);
}

// Example function to get all categories
function getAllCategories() {
    $sql = "SELECT * FROM category";
    $result = executeQuery($sql);
    return fetchAll($result);
}

// Example function to get all products
function getAllProducts() {
    $sql = "SELECT * FROM product";
    $result = executeQuery($sql);
    return fetchAll($result);
}

// Example function to get all customers
function getAllCustomers() {
    $sql = "SELECT * FROM customer";
    $result = executeQuery($sql);
    return fetchAll($result);
}


function find_category(){
   
        global $conn;
      
        $sql = "SELECT * FROM category";
      
        $result = mysqli_query($conn, $sql);
        return $result;
}

?>
