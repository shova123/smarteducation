<?php
class RawImpersonate{
    // CodeIgniter 2.1.3 - http://ellislab.com/codeigniter 
// Ion Auth 2:       - http://github.com/benedmunds/CodeIgniter-Ion-Auth 
// ------------------------------------------------------------------------
// This would go in a controller, but you could put the logic in a model
// and tuck it away. It also assumes you've already loaded the ion_auth
// library, and have assigned the original logged-in admin user details
// to $this->the_user

public function ditto($new_id = NULL)
{
	if ( $new_id && is_numeric($new_id))
	{
		// Need to currently be an admin user, or had started the session as one.
		if ($this->ion_auth->is_admin() || $this->session->userdata('can_hijack'))
		{
			// If there is no 'can_hijack' session var set, set it with the current
			// user ID. This user ID has to be an admin account or we'd have never
			// got to this point.
			if ($this->session->userdata('can_hijack') === FALSE)
			{
				$this->session->set_userdata('can_hijack', $this->the_user->id);
			}
			// Hardcore forking action... sort of.
			$this->session->set_userdata('user_id', $new_id);
		}
	}
	else
	{
		// No $new_id was supplied, so either it's a mistyped URL or an attempt
		// to revert back to the original user.
		$original_id = $this->session->userdata('can_hijack');

		if ($original_id !== FALSE)
		{
			if ($this->ion_auth->is_admin($original_id))
			{
				$this->session->set_userdata('user_id', $original_id);
				$this->session->unset_userdata('can_hijack');
			}
		}
	}
	redirect();
}
}
?>