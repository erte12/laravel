<?php

use App\Friends;

function friendship($user_id, $friend_id)
{
	$query = Friends::where([
		'user_id' => $user_id,
		'friend_id' => $friend_id,
		])->orWhere([
		'user_id' => $friend_id,
		'friend_id' => $user_id,
		])->first();

	$result = new stdClass();

	if($query) {
		$result->exists = true;
		$result->accepted = $query->accepted;
	} else {
		$result->exists = false;
		$result->accepted = false;
	}

	return $result;
}

function is_sender($user_id, $friend_id)
{
	$query = Friends::where([
		'user_id' => $user_id,
		'friend_id' => $friend_id,
		])->first();

	if($query) {
		return true;
	}

	return false;
}
