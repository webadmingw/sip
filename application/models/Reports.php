<?php

/**
 * Description of users
 *
 * @author indy
 */
class Reports extends CI_Model
{

    #SKILL = 0 { PENGETAHUAN } ELSE { KETERAMPILAN } 

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

    public function getResults($classid, $skill = 0)
    {
        $sql = "
        select 
            s.nisn, comp.id compid, r.knowledge
        from student s 
        inner join classroom c on c.id = s.cur_class
        inner join subject pel on pel.classroom_id=c.id
        inner join comp on comp.subject_id = pel.id
        left join report r on r.comp_id = comp.id and r.nisn = s.nisn and skill = " . $skill . "
        where c.id = " . $classid . ";
        ";
        $result = $this->db->query($sql)->result();
        $return = array();

        foreach ($result as $item) {
            $return[$item->nisn][$item->compid] = $item->knowledge;
        }

        return $return;
    }

    public function insertResult($classid, $year, $semester, $arrResult, $skill = 0)
    {
        $insert = 'insert into report (class, year, semester, nisn, comp_id, knowledge, skill) values';
        $i = 0;
        foreach ($arrResult as $nisn => $item) {
            foreach ($item as $comp_id => $r) {
                if ($r !== null && $r !== '') {
                    $insert .= ' (' . $classid . ', "' . $year . '", ' . $semester . ', "' . $nisn . '", ' . $comp_id . ', ' . ($r ? $r : "null") . ', ' . $skill . '),';
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



    public function deleteResultByClass($classid, $subject_id, $skill = 0)
    {
        $sql = "delete from report where comp_id in (
            select
                comp.id
            from classroom c 
            inner join subject s on s.classroom_id=c.id
            inner join comp on comp.subject_id = s.id
            where c.id=" . $classid . " and s.id=" . $subject_id . "
        ) and report.skill = " . $skill . ";";
        return $this->db->query($sql);
    }


    public function getListStudentByClass($classname, $semester, $year)
    {
        $sql = "select 
            c.id, c.class, c.name class_name, c.semester, c.`year`,
            s.nisn, s.fullname
        from classroom c
        inner join student s on s.cur_class = c.id
        where 1=1
            and c.`year`='" . $year . "'
            and c.semester = " . $semester . "
            and c.name like '%" . $classname . "%'
        order by s.fullname;";

        return $this->db->query($sql)->result();
    }

    public function getListSubjectByClass($classname, $semester, $year)
    {
        $sql = "select 
            pel.fullname subject
        from classroom c
        inner join subject pel on pel.classroom_id=c.id
        where 1=1
            and c.`year`='" . $year . "'
            and c.semester = " . $semester . "
            and c.name like '%" . $classname . "%'
        order by pel.id;";
        return $this->db->query($sql)->result();
    }


    public function getResultSummaryByClass($classname, $semester, $year)
    {
        $sql = "
        select 
            s.nisn, s.fullname, pel.id subject_id, pel.fullname subject, avg(rknow.knowledge) knowledge, avg(rskill.knowledge) skill
        from classroom c
        inner join student s on s.cur_class = c.id
        inner join subject pel on pel.classroom_id=c.id
        inner join comp on comp.subject_id = pel.id
        left join report rknow on rknow.comp_id = comp.id and rknow.nisn = s.nisn and rknow.skill=0
        left join report rskill on rskill.comp_id = comp.id and rskill.nisn = s.nisn and rskill.skill=1
        where 1=1
        and c.`year`='" . $year . "'
        and c.semester = " . $semester . "
        and c.name like '%" . $classname . "%'
        group by s.nisn, pel.id	
        order by s.fullname, pel.id;
        ";

        $return = array();
        $result = $this->db->query($sql)->result();

        foreach ($result as $item) {
            $return[$item->nisn][$item->subject_id] = $item;
        }

        return $return;
    }

    public function getAttitude($classname, $semester, $year)
    {
        $sql = "
        select 
            c.id class_id, s.phone, s.nisn, s.fullname, r.status 
        from student s 
        inner join classroom c on c.id = s.cur_class
        left join report_attitude r on r.classroom_id = c.id and r.nisn = s.nisn and r.status = true
        where 1=1 
            and c.`year`='" . $year . "'
            and c.semester = " . $semester . "
            and c.name = '" . $classname . "'
        group by s.fullname;
        ";

        return $this->db->query($sql)->result();
    }

    public function getAttitudeById($class_id, $semester, $year)
    {
        $sql = "
        select 
            c.id class_id, s.phone, s.nisn, s.fullname, r.status 
        from student s 
        inner join classroom c on c.id = s.cur_class
        left join report_attitude r on r.classroom_id = c.id and r.nisn = s.nisn and r.status = true
        where 1=1 
            and c.`year`='" . $year . "'
            and c.semester = " . $semester . "
            and c.id = '" . $class_id . "'
        group by s.fullname;
        ";

        return $this->db->query($sql)->result();
    }

    public function getMaxmin($classname, $semester, $year)
    {
        $sql = "
        select 
            s.nisn, s.fullname, pel.fullname subject, avg(rknow.knowledge) knowledge
        from classroom c
        inner join student s on s.cur_class = c.id
        inner join subject pel on pel.classroom_id=c.id
        inner join comp on comp.subject_id = pel.id
        inner join report rknow on rknow.comp_id = comp.id and rknow.nisn = s.nisn
        where 1=1
            and c.`year`='" . $year . "'
            and c.semester = " . $semester . "
            and c.name = '" . $classname . "'
        group by s.nisn, pel.id	
        order by pel.id, avg(rknow.knowledge) desc;
        ";

        $return = [];
        $result = $this->db->query($sql)->result();

        if (count($result) > 0) {
            $subject = '';
            foreach ($result  as $item) {
                if ($subject !== $item->subject) {
                    $return[$item->subject]['max'] = array(
                        'nisn' => $item->nisn,
                        'fullname' => $item->fullname,
                        'knowledge' => $item->knowledge
                    );
                    $subject = $item->subject;
                } else {
                    $return[$item->subject]['min'] = array(
                        'nisn' => $item->nisn,
                        'fullname' => $item->fullname,
                        'knowledge' => $item->knowledge
                    );
                }
            }
        }

        return $return;
    }

    public function addAtt($nisn, $class_id)
    {
        $sql = "
        insert into report_attitude (classroom_id, `desc`, status, created_at, nisn) values (" . (int) $class_id . ", '', true, " . time() . ", '" . $nisn . "');
        ";

        return $this->db->query($sql);
    }

    public function removeAtt($nisn, $class_id)
    {
        $sql = "
        delete from report_attitude where status = 1 and nisn = '" . $nisn . "' and classroom_id = " . (int) $class_id . ";
        ";

        return $this->db->query($sql);
    }
}
