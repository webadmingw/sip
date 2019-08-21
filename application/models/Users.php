<?php

/**
 * Description of users
 *
 * @author indy
 */
class Users extends CI_Model
{

    public $roles = array(
        'K' => 'Kepala Sekolah',
        'G' => 'Guru',
        'A' => 'Administrator'
    );

    public function getUser($username)
    {
        return $this->db->query('select * from users where username=? and is_deleted=0', array($username))->row();
    }

    public function getMasters()
    {
        return $this->db->query('select * from users where role = "G" and is_deleted=0')->result();
    }

    public function getUsers($condition = null, $orderby = null)
    {
        return $this->db->query('select * from users where is_deleted=0' . $condition . $orderby)->result();
    }

    public function getUserById($userid)
    {
        return $this->db->query('select * from users where id=? and is_deleted=0', array($userid))->row();
    }

    public function doLogin($username, $password)
    {
        $model = $this->getUser($username);
        if ($model && md5($password) === $model->password_hash) {
            $this->setSession($model);
            return true;
        }

        return false;
    }

    public function updateProfile($username, $fullname, $avatar = '', $role = '')
    {
        $set = 'username = "' . $username . '", fullname = "' . $fullname . '"';
        if ($role !== '') {
            $set .= ', role = "' . $role . '"';
        } elseif ($avatar !== '') {
            $set .= ', avatar = "' . $avatar . '"';
        }

        $result = $this->db->query('update users set ' . $set . ' where id=' . $this->session->userdata('id'));
        if (!$result) {
            return false;
        }

        $this->setSession($this->getUserById($this->session->userdata('id')));
        return true;
    }

    public function add($username, $fullname, $role)
    {
        return $this->db->query('insert into users (`username`, `fullname`, `role`, `password_hash`) values ("' . $username . '", "' . $fullname . '", "' . $role . '", md5("user123"))');
    }

    public function updateUser($username, $fullname, $role, $userid)
    {
        $set = 'username = "' . $username . '", fullname = "' . $fullname . '", role = "' . $role . '"';
        return $this->db->query('update users set ' . $set . ' where id=' . $userid);
    }

    public function updateUserAtrribute($fullname, $role, $userid)
    {
        $set = 'fullname = "' . $fullname . '"';
        if ($role !== '') {
            $set .= ', role = ' . $role;
        }
        return $this->db->query('update users set ' . $set . ' where id=' . $userid);
    }

    public function resetPassword($userid)
    {
        return $this->db->query('update users set password_hash=md5("user123") where id=' . $userid);
    }

    public function changePassword($userid, $new_password)
    {
        return $this->db->query('update users set password_hash=md5("' . $new_password . '") where id=' . $userid);
    }

    public function deleteUser($userid)
    {
        return $this->db->query('update users set is_deleted=1 where id=' . $userid);
    }

    public function setSession($model)
    {
        $this->session->set_userdata(array(
            'id' => $model->id,
            'username' => $model->username,
            'fullname' => $model->fullname,
            'avatar' => $model->avatar,
            'role' => $model->role,
            'is_logged' => true
        ));
    }
}
