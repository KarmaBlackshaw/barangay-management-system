<?php

function imgSrc($src)
{
	return preg_match("/data:image/i", $src) ? $src : "assets/uploads/" . $src;
}
