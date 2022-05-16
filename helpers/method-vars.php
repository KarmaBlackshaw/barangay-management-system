<?php

function getPost ($key) {
  return array_key_exists($key, $_POST)
    ? $_POST[$key]
    : null;
}