<?php

namespace user\API;

class Link extends \Restful {
	public function post_add () {
		if (! isset ($_POST['user'])) return $this->error ('Missing parameter: user');
		if (! isset ($_POST['service'])) return $this->error ('Missing parameter: service');
		if (! isset ($_POST['handle'])) return $this->error ('Missing parameter: handle');
		
		$link = new user\Link (array (
			'user_id' => $_POST['user']
			'service' => $_POST['service'],
			'handle' => $_POST['handle']
		));
		if (! $link->put ()) {
			error_log ($link->error);
			return $this->error ('An unexpected error occurred.');
		}
		return $link->orig ();
	}
	
	public function post_delete () {
		if (! isset ($_POST['id'])) return $this->error ('Missing parameter: id');
		
		$link = new user\Link ($_POST['id']);
		if ($link->error) {
			error_log ($link->error);
			return $this->error ('An unexpected error occurred.');
		}
		
		if (! $link->remove ()) {
			error_log ($link->error);
			return $this->error ('An unexpected error occurred.');
		}
		return true;
	}
}

?>