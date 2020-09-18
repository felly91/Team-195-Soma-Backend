<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Course;
use App\Http\Controllers\Controller;
use App\Lesson;
use Illuminate\Http\Request;

class ManageEntries extends Controller{
    //class to manage(add,update) the entries

    protected $message=null;

    public function __construct()
    {
        
    }

    public function manCategory(Request $req)
    {
        //Function to manage the lessons(add,update)
            $id=$req->input('id');$category=null;
        if($id==null){
            //if not exists add the category
            $category=Category::create(
            [
                'name'=>$req->input('name'),
                'code'=>$req->input('code'),
            ]
            );
            $message="category added Successfully!";
        }else
        {   //if exists update the category
            $message="category updated Successfully!";
            $category=Category::find($id);
            $category->name=$req->input('name');
            $category->code=$req->input('code');
            
            $category->save();
        }
        
        return response()->json(["message"=>$message,"category_id"=>$category->id]);
    }

    public function manCourse(Request $req)
    {
        //Function to manage the courses(add,update)
        $id=$req->input('id');$cours=null;
        if($id==null){
            //if not exists add the course
            $course=Course::create(
            [
                'name'=>$req->input('name'),
                'lesson_number'=>$req->input('description'),
            ]
            );
            $message="Course added Successfully!";
        }else
        {   //if exists update the course
            $message="Course updated Successfully!";

            $course=Course::find($id);
            $course->name=$req->input('name');
            $course->description=$req->input('description');
            $course->save();
        }
        
        return response()->json(["message"=>$message,"course_id"=>$course->id]);
    }

    public function manLesson(Request $req)
    {
        //Function to manage the lessons(add,update)
            $id=$req->input('id');$lesson=null;
        if($id==null){
            //if not exists add the lesson
            $lesson=Lesson::create(
            [
                'name'=>$req->input('name'),
                'lesson_number'=>$req->input('lesson_number'),
                'writing_explanation'=>$req->input('writing_explanation')
            ]
            );
            $message="Lesson added Successfully!";
        }else
        {   //if exists update the lesson
            $message="Lesson updated Successfully!";
            $lesson=Lesson::find($id);
            $lesson->course()->dissociate();
            $lesson->name=$req->input('name');
            $lesson->lesson_number=$req->input('lesson_number');
            $lesson->writing_explanation=$req->input('writing_explanation');
            $lesson->save();
        }
        $course=Course::find($req->input('course_id'));
        $lesson->course()->associate($course);
        $lesson->save();
        return response()->json(["message"=>$message,"lesson_id"=>$lesson->id]);
    }
}

?>