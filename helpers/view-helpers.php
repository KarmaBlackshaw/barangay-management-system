<?php

function imgSrc($src)
{
	if (empty($src)) {
		return null;
	}

	return preg_match("/data:image/i", $src) ? $src : "assets/uploads/" . $src;
}
