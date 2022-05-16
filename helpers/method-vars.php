<?php

function getBody ($key, $body) {
  return array_key_exists($key, $body)
    ? $body[$key]
    : null;
}