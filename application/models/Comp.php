<?php

/**
 * Description of users
 *
 * @author indy
 */
class Comp extends CI_Model {
    
    public function getCompBySubject($id){
        return $this->db->query('select 
        competence.id, 
        competence.code, 
        competence.`desc`, 
        competence.subject_id, 
        sbj.fullname, 
        sbj.`desc` as subject_desc
        from comp as competence 
        INNER join subject as sbj 
        WHERE competence.subject_id = sbj.id and competence.is_deleted = 0 and competence.subject_id = '. $id)->result();
    }
    public function getCompByID($id) {
        return $this->db->query('select 
        competence.id, 
        competence.code, 
        competence.`desc`, 
        competence.subject_id, 
        sbj.fullname, 
        sbj.`desc` as subject_desc
        from comp as competence 
        INNER join subject as sbj 
        WHERE competence.subject_id = sbj.id and competence.is_deleted = 0 and competence.id = '. $id)->row();
    }
    public function addComp($code, $desc, $id_subject){
        return $this->db->query('insert into comp(`code`, `desc`, `subject_id`, `is_deleted`) ' . 'values( "'.$code. '", '. '"'. $desc . '", '. $id_subject . ', 0)' );
    }
    public function editComp($id, $code, $desc) {
        return $this->db->query('update comp set `code`="'. $code. '", '. '`desc`="'. $desc. '"' .' where id=' . $id);
    }
    public function deleteComp($id){
        return $this->db->query('update comp set is_deleted=1 where id=' . $id);
    }
    
}
