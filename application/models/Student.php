<?php

/**
 * Description of users
 *
 * @author indy
 */
class Student extends CI_Model
{

    public function getAllStudents($filters = array())
    {
        $cond = '';
        if ($filters) {
            foreach ($filters as $key => $val) {
                $cond .= ' and ' . $key . ' = ' . $val;
            }
        }
        $sql = 'select 
        std.nisn as id, 
        cr.name as classroom_name,
        std.fullname,
        std.parent_fullname,
        std.phone,
        std.pob as birth_place,
        std.dob as birth_day,
        cr.semester
    from student as std INNER JOIN classroom
        as cr WHERE std.cur_class = cr.id AND std.is_deleted = 0
        ' . $cond;
        return $this->db->query($sql)->result();
    }

    public function allByClass($classid, $filters = array())
    {
        $cond = '';
        if ($filters) {
            foreach ($filters as $key => $val) {
                $cond .= ' and ' . $key . ' = ' . $val;
            }
        }

        $sql = 'select 
            std.nisn as id,
            std.fullname,
            std.parent_fullname,
            std.phone,
            std.pob as birth_place,
            std.dob as birth_day
        from student as std
        WHERE std.cur_class = ' . $classid . ' and std.is_deleted = 0
        ' . $cond;
        return $this->db->query($sql)->result();
    }

    public function getStudentByID($nisn)
    {
        return $this->db->query('select 
        std.nisn as id, 
        cr.name as classroom_name,
        cr.id as classroom_id,
        std.fullname,
        std.parent_fullname,
        std.phone,
        std.pob as birth_place,
        std.dob as birth_day,
        cr.semester
    from student as std INNER JOIN classroom
        as cr WHERE std.cur_class = cr.id AND std.is_deleted = 0 and std.nisn = "' . $nisn . '"')->row();
    }
    public function addStudent($nisn, $fullname, $parent, $phone, $pob, $dob, $cur_class)
    {
        return $this->db->query('insert into student(`nisn`, `fullname`, parent_fullname, phone, pob, dob, cur_class)' . 'values (' . '"' . $nisn . '", ' . '"' . $fullname . '", ' . '"' . $parent . '", ' . '"' . $phone . '", ' . '"' . $pob . '", ' . '"'   . $dob . '"' . ', ' . $cur_class . ')');
    }
    public function updateStudent($nisn, $fullname, $parent, $phone, $pob, $dob, $cur_class)
    {
        return $this->db->query('UPDATE student set parent_fullname=' . '"' . $parent . '"' . ', `fullname`=' . '"' . $fullname . '"' . ', phone=' . '"' . $phone . '"' . ', pob=' . '"' . $pob . '"' . ', dob=' . '"' . $dob . '"' . ', cur_class=' . $cur_class  . ' WHERE nisn = ' . '"' . $nisn . '"');
    }
    public function deleteStudent($nisn)
    {
        return $this->db->query('UPDATE student set is_deleted=1 where nisn=' . '"' . $nisn . '"');
    }
}
