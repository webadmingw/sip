<?php

/**
 * Description of users
 *
 * @author indy
 */
class Home extends CI_Model {
    public function getDataByIDStudent ($nisn) {
        $query = '
            select 
                s.nisn, s.fullname, c.name, c.name, c.semester, pel.fullname, comp.code, r.knowledge
            from student as s 
            inner join classroom as c on c.id = s.cur_class
            inner join subject as pel on pel.classroom_id=c.id
            inner join comp on comp.subject_id = pel.id
            left join report as r on r.comp_id = comp.id
            where s.nisn = "' . $nisn .'"';
        return $this->db->query($query)->result();
    }
    
}
