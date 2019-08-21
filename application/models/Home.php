<?php

/**
 * Description of users
 *
 * @author indy
 */
class Home extends CI_Model
{
    public function getDataByIDStudent($nisn)
    {
        $query = '
        select courses, avg(knowledge) knowledge, avg(skill) skill  from (
            select 
                s.*, 
                (select knowledge from report where comp_id = s.id and nisn=s.nisn and skill=0) knowledge,
                (select knowledge from report where comp_id = s.id and nisn=s.nisn and skill=1) skill
            from (
                select 
                    s.nisn, s.fullname sname, pel.fullname courses, comp.id, comp.code
                from student as s 
                inner join classroom as c on c.id = s.cur_class
                inner join subject as pel on pel.classroom_id=c.id
                inner join comp on comp.subject_id = pel.id
                where s.nisn =  "' . $nisn . '"
                order by pel.fullname, comp.id
            ) s
        ) results
        group by courses;
        ';

        return $this->db->query($query)->result();
    }
}
