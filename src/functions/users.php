<?php
require_once '../database.php';

// Obtener todos los usuarios
function getUsers()
{
  return supabaseRequest("users", "GET");
}

// Obtener un usuario por ID
function getUserById($id)
{
  return supabaseRequest("users?id=eq.$id", "GET")[0] ?? null;
}

// Crear un nuevo usuario
function createUser($name, $image_url, $points)
{
  $data = ["name" => $name, "image_url" => $image_url, "points" => $points];
  return supabaseRequest("users", "POST", $data);
}

// Actualizar un usuario
function updateUser($id, $name, $image_url, $points)
{
  $data = ["name" => $name, "image_url" => $image_url, "points" => $points];
  return supabaseRequest("users?id=eq.$id", "PATCH", $data);
}

// Eliminar un usuario
function deleteUser($id)
{
  return supabaseRequest("users?id=eq.$id", "DELETE");
}
