<?php

/**
 * Description of users
 *
 * @author indy
 */
class Reports extends CI_Model
{

    public function getCurrentClass($teacher_id, $year, $semester)
    {
        $sql = "
        select 
            c.id classid, c.name class_name
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

    public function getCurrentCourse($teacher_id, $year, $semester, $classid)
    {
        $sql = "
        select 
            c.id classid, c.name class_name, pel.id, pel.fullname
        from classroom c 
        inner join users t on t.id = c.teacher_id and t.is_deleted = 0
        inner join subject pel on pel.classroom_id = c.id and pel.is_deleted = 0
        where 
            c.is_deleted=0
            and c.teacher_id = " . $teacher_id . "
            and c.`year`='" . $year . "'
            and c.semester = " . $semester . "
            and c.id = " . $classid . "
        order by pel.fullname;
        ";
        return $this->db->query($sql)->result();
    }

    public function getClassDetailCurrent($teacher_id, $year, $semester, $classid, $subject_id)
    {
        $sql = "
        select 
            c.id classid, c.name, c.`year`, c.class, c.semester, c.teacher_id, t.fullname teacher, 
            pel.id, pel.fullname, pel.min_grade, pel.max_grade, comp.id comp_id, comp.code, comp.`desc`
        from classroom c 
        inner join users t on t.id = c.teacher_id and t.is_deleted = 0
        inner join subject pel on pel.classroom_id = c.id and pel.is_deleted = 0
        inner join comp on comp.subject_id=pel.id and comp.is_deleted = 0
        where 
            c.is_deleted=0
            and c.teacher_id = " . $teacher_id . "
            and c.`year`='" . $year . "'
            and c.semester = " . $semester . "
            and c.id = " . $classid . "
            and pel.id=" . $subject_id . ";
        ";
        return $this->db->query($sql)->result();
    }

    public function getStudentByDetailCurrent($classid)
    {
        return $this->db->query("select nisn, fullname from student where cur_class = " . $classid . " and is_deleted=0 order by fullname;")->result();
    }

    public function getResults($classid)
    {
        $sql = "
        select 
            s.nisn, comp.id compid, r.knowledge
        from student s 
        inner join classroom c on c.id = s.cur_class
        inner join subject pel on pel.classroom_id=c.id
        inner join comp on comp.subject_id = pel.id
        left join report r on r.comp_id = comp.id and r.nisn = s.nisn
        where c.id = " . $classid . ";
        ";
        $result = $this->db->query($sql)->result();
        $return = array();

        foreach ($result as $item) {
            $return[$item->nisn][$item->compid] = $item->knowledge;
        }

        return $return;
    }

    public function insertResult($classid, $year, $semester, $arrResult)
    {
        $insert = 'insert into report (class, year, semester, nisn, comp_id, knowledge) values';
        $i = 0;
        foreach ($arrResult as $nisn => $item) {
            foreach ($item as $comp_id => $r) {
                if ($r !== null && $r !== '') {
                    $insert .= ' (' . $classid . ', "' . $year . '", ' . $semester . ', "' . $nisn . '", ' . $comp_id . ', ' . ($r ? $r : "null") . '),';
                    $i++;
                }
            }
        }
        $insert = substr_replace($insert, "", -1);
        if ($i > 0) {
            return $this->db->query($insert);
        }
        return true;
    }

    public function deleteResultByClass($classid)
    {
        $sql = "delete from report where class = " . $classid;
        return $this->db->query($sql);
    }
}
