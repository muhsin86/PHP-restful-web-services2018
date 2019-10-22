<?php
    // Include the config php file 
    include('includes/config.php');
    // Send header information
    header("Access-Control-Allow-Origin: *"); 
    header("Access-Control-Allow-Credentials:", true);
    header("Content-Type: application/json; charset=UTF-8"); 

    // Get HTTP method and input of the request
     $method = $_SERVER['REQUEST_METHOD'];
     // Convert to JSON-format
     $input = json_decode(file_get_contents('php://input'),true);
     
     $course = new Course();
    


    // HTTP method implementations of GET and POST
    switch ($method){ 

        case "GET": // Retrieve course 

        $response = $course->getCourses(); 
        
        if(sizeof($response) > 0 ) { 
        http_response_code(200); // Course was found
        } else 
        { http_response_code(404); // Not found 
            $response = array("message" => "Sorry, no courses where found!"); //Show error message 
        } 
        break; 

        case "POST": // Add course
        if($course->addCourse($input['course_code'], $input['course_name'], 
            $input['course_progression'], $input['course_link'])) { 
            http_response_code(201); // Course was successfully added 
            $response = array("message" => "Course added." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no course was added!"); // Show error message 
        } 
        break; 
        case "DELETE": // Add course
        if($course->deleteCourse($request[1])) { 
            http_response_code(201); // Course was successfully added 
            $response = array("message" => "Course deleted." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no course was deleted!"); // Show error message 
        } 
        break;
        case "PUT": // Add course
        if($course->updateCourse($request[1], $input['course_code'], $input['course_name'], 
            $input['course_progression'], $input['course_link'])) { 
            http_response_code(201); // Course was successfully added 
            $response = array("message" => "Course updated." ); 

        } else { http_response_code(503); // Server error 

            $response = array("message" => "Sorry, no course was updated!"); // Show error message 
        } 
        break;
}
    // Return the result in JSON format
    echo json_encode($response);
?>