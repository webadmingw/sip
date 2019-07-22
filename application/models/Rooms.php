<?php

/**
 * Description of users
 *
 * @author indy
 */
class Rooms extends CI_Model {
    
    public function getAll($filters = array()){
        $cond = '';
        if($filters){
            foreach($filters as $key => $val){
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
                '. $cond . '
            order by `year` desc, `class` asc, `semester` desc
        ';
        return $this->db->query($sql)->result();
    }
    
}
