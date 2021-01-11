<?php 

function active(string $url, string $res = 'active', $group = false): String
{
	$active = $group ? request()->is($url) || request()->is($url.'/*') : request()->is($url);
	
	return $active ? $res : '';
}

function localDate(string $date): String
{
	return date('d M Y', strtotime($date));
}

function badge(array $replace): String
{
	$subject = '<span class="badge badge-color">text</span>';
	$search = ['color', 'text'];

	return str_replace($search, $replace, $subject);
}

function setting(string $key)
{
	return cache('setting')->$key;
}

 ?>