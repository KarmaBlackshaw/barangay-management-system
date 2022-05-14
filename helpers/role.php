<?php

function userRoleTransformer($role)
{
  return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

function isAdmin()
{
  return userRoleTransformer('administrator');
}


function isStaff()
{
  return userRoleTransformer('staff');
}


function isUser()
{
  return userRoleTransformer('user');
}
