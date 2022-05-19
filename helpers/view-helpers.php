<?php

function imgSrc($src, $default = "")
{
	if (empty($src)) {
		if (!empty($default)) {
			return "assets/" . $default;
		}

		return null;
	}

	return preg_match("/data:image/i", $src) ? $src : "assets/uploads/" . $src;
}

function ifThen($condition, $then)
{
	return $condition ? $then : null;
}

function fullname($row)
{
	$fname = $row["firstname"];
	$mname = $row["middlename"];
	$lname = $row["lastname"];

	return ucwords("$fname $mname $lname");
}
