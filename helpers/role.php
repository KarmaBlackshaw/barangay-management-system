<?php

function _userRoleTransformer($role)
{
	return isset($_SESSION["role"]) && $_SESSION["role"] === $role;
}

function isAuthenticated()
{
	return isset($_SESSION["role"]);
}

function isAdmin()
{
	return _userRoleTransformer("administrator");
}

function isStaff()
{
	return _userRoleTransformer("staff");
}

function isUser()
{
	return _userRoleTransformer("user");
}

function role(array $roles)
{
	if (!isset($_SESSION["role"])) {
		return false;
	}

	return in_array($_SESSION["role"], $roles);
}
