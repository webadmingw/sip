<?php

/**
 * Description of users
 *
 * @author indy
 */
class Rooms extends CI_Model
{

    public function getAll($filters = array())
    {
        $cond = '';
        if ($filters) {
            foreach ($filters as $key => $val) {
                $cond .= ' and ' . $key . ' = ' . $val;
            }
        }

        $sql = '
            select 
                    r.*, u.fullname
            from classroom r
            inner join `users` u on u.id = r.teacher_id
            where
                r.is_deleted = 0
                ' . $cond . '
            order by `year` desc, `class` asc, `semester` desc
        ';
        return $this->db->query($sql)->result();
    }

    public function getCurrentClassByTeacher($teacher_id, $year, $semester)
    {
        $sql = "
        select 
            c.*, t.fullname
        from classroom c 
        inner join users t on t.id = c.teacher_id and t.is_deleted = 0
        where 
            c.is_deleted=0
            and c.teacher_id = " . $teacher_id . "
            and c.`year`='" . $year . "'
            and c.semester = " . $semester . "
        order by c.name;
        ";
        return $this->db->query($sql)->result();
    }

    public function add($name, $classroom, $year, $semester, $role)
    {
        return $this->db->query('insert into classroom (`name`, `class`, `year`, `semester`, `teacher_id`, `created_at`) values ("' . $name . '", "' . $classroom . '", "' . $year . '", "' . $semester . '", ' . $role . ', now())');
    }
    public function getClassByID($id)
    {
        return $this->db->query('SELECT * from classroom WHERE id = ' . $id)->row();
    }
    public function updateClass($id, $name, $year, $semester, $teacher_id, $classroom)
    {
        return $this->db->query('UPDATE classroom set name=' . '"' . $name . '"' . ', `year`=' . $year . ', semester=' . $semester . ', teacher_id=' . $teacher_id . ', class=' . $classroom . ' WHERE id = ' . $id);
    }
    public function deleteClass($id)
    {
        return $this->db->query('update classroom set is_deleted=1 where id=' . $id);
    }
}
