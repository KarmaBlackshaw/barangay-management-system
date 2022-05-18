<?php

function array_any(array $array, callable $fn)
{
	foreach ($array as $value) {
		if ($fn($value)) {
			return true;
		}
	}
	return false;
}

function array_find_key(array $array, callable $fn)
{
	foreach ($array as $key => $value) {
		if ($fn($value)) {
			return $key;
		}
	}
}
