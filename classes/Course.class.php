<?php

class Course {
    
   public function __construct() {
    //$this->db = new mysqli('localhost', 'root', '', 'php-rest-api');
      
    if($this->db->connect_errno > 0) {
        die('SQL query error [' . $this->db->connect_error . ']');
      }
    }
    
    //Get courses
    public function getCourses() {
        $sql = "SELECT * FROM crud";
        if(!$result = $this->db->query($sql)){
            die('SQL query error [' . $db->error . ']');
        }
        $results = [];
        // Run through the result (all rows returned by the SQL query) 
        while($row = $result->fetch_assoc()){
            $results[] = $row;
        }
        return $results;
    }

    // Add a new course 
    public function addCourse($course_code, $course_name, $course_progression, $course_link) {

        $sql = "INSERT INTO crud (
        	course_code,course_name,course_progression,course_link
            ) VALUES 
             ('$course_code', '$course_name', '$course_progression', '$course_link');";
        
        return $result = $this->db->query($sql);
    }
// Delete Course
   public function deleteCourse($id) {
        $sql = "DELETE FROM crud WHERE id=$id;";
    
        $result = $this->db->query($sql);

        return $result;
    }


// Uppdatera Course
   public function updateCourse($id, $course_code, $course_name, $course_progression, $course_link) 
   {


    $sql = "UPDATE crud SET course_code= '$course_code', course_name='$course_name', course_progression='$course_progression', course_link='$course_link' WHERE id=$id;";
    $result = $this->db->query($sql);

    if(!$result = $this->db->query($sql)){
        die('Fel vid SQL-fråga [' . $this->db->error . ']');
    }

    return $result;
  }

}

?>
