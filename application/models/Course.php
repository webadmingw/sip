<?php

/**
 * Description of users
 *
 * @author indy
 */
class Course extends CI_Model {
    
    public function getCourseByIDRoom($id){
        return $this->db->query('SELECT * from subject WHERE classroom_id = ' . $id. ' AND is_deleted = 0')->result();
    }
    public function getCourseByID($id){
        return $this->db->query('SELECT * from subject WHERE id = ' . $id)->row();
    }
    public function addCourse($id, $subject, $description, $min, $max) {
        return $this->db->query('insert into subject(`fullname`, `desc`, min_grade, max_grade, classroom_id)'. 'values ('. '"'.$subject.'", ' . '"' . $description.'", ' . $min.', ' . $max . ', '.$id  .')');
    }
    public function updateCourse($id, $subject, $description, $min, $max) {
        return $this->db->query('UPDATE subject set `fullname`='. '"' .$subject. '"' .', `desc`='. '"' .$description. '"' .', min_grade='.$min.', max_grade='.$max.' WHERE id = '.$id);
    }
    public function deleteCourse($id) {
        return $this->db->query('update subject set is_deleted=1 where id=' . $id);
    }
    public function getTeacherByID($id) {
        return $this->db->query('SELECT * from users WHERE id = '.$id)->row();
    }
    
}
