<?php

/**
 * Description of users
 *
 * @author indy
 */
class Smsmodel extends CI_Model
{

    public function getReportByClass($class, $semester, $year)
    {
        $sqlReport = '
        select 
            c.id class_id, comp.id comp_id, s.phone, s.nisn, s.fullname, pel.fullname course, comp.code, 
            r.is_sent, r.sent_date, pel.min_grade, pel.max_grade, avg(r.knowledge) summary,
            CASE
                WHEN avg(r.knowledge) >= pel.max_grade then "F"
                WHEN avg(r.knowledge) <= pel.min_grade then "E"
            end r
        from student s 
        inner join classroom c on c.id = s.cur_class
        inner join subject pel on pel.classroom_id=c.id
        inner join comp on comp.subject_id = pel.id
        inner join report r on r.comp_id = comp.id and r.nisn = s.nisn
        where 1=1
            and c.name = "' . $class . '"
            and c.semester = ' . $semester . '
            and c.`year` = "' . $year . '"
        group by s.nisn, pel.id, comp.id
        having AVG(r.knowledge) >= pel.max_grade || AVG(r.knowledge) <= pel.min_grade
        order by s.fullname, pel.fullname, comp.code;
        ';

        return $this->db->query($sqlReport)->result();
    }

    public function setSmsIsSent($class_id, $nisn, $comp_id)
    {
        $in_nisn = substr_replace($nisn, "", -1);
        $in_comp_id = substr_replace($comp_id, "", -1);

        $sqlUpdate = '
        update report set 
            is_sent=true,
            sent_date=now()
        where 
            class = ' . $class_id . '
            and nisn in (' . $in_nisn . ')
            and comp_id in (' . $in_comp_id . ')
            and (is_sent = false or is_sent is null);
        ';

        return $this->db->query($sqlUpdate);
    }
}
