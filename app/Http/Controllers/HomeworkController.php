<?php

namespace App\Http\Controllers;
use App\Models\ClassModel;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use App\Models\HomeworkModel;
use App\Models\AssignClassTeacherModel;
use App\Models\HomeworkSubmitModel;
use App\Models\User;
use Auth;
use Str;


use Illuminate\Http\Request;

class HomeworkController extends Controller
{

    public function HomeWorkReport()
    {
        $data['getRecord'] = HomeworkSubmitModel::getHomeworkReport();
        $data['header_title'] = 'Homework Report';
        return view('admin.homework.report', $data);
    }

    public function HomeWork()
    {
        $data['getRecord'] = HomeworkModel::getRecord();
        $data['header_title'] = 'Homework';
        return view('admin.homework.list', $data);
    }

    public function AddHomeWork()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Add New Homework';
        return view('admin.homework.add', $data);
    }

    public function Insert(Request $request)
    {
        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('admin/homework/home_work')->with('success', 'Homework Successfully Created');

    }

    public function ajax_get_subject(Request $request)
    {
        $class_id = $request->class_id;
        $getSubject = ClassSubjectModel::MySubject($class_id);
        $html = '';
        $html .= '<option value="">Select Subject</option>';
        foreach ($getSubject as $value)
        {
            $html .= '<option value=" '.$value->subject_id.' ">'.$value->subject_name.'</option>';
        }

        $json['success'] = $html;
        echo json_encode($json);
    }

    public function EditHomework($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Edit Homework';
        return view('admin.homework.edit', $data);
    }

    public function UpdateHomework(Request $request, $id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('admin/homework/home_work')->with('success', 'Homework Successfully Updated');

    }

    public function DeleteHomework($id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->is_delete = 1;
        $homework->save();

        return redirect()->back()->with('success', 'Homework Successfully Deleted');

    }

    public function Submitted($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);
        if(!empty($homework))
        {
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = 'Submitted Homework';
            return view('admin.homework.submitted', $data);
        }
        else
        {
            abort(404);
        }

    }

    // teacher side work

    public function HomeWorkTeacher()
    {
        $class_ids = array();
        $getClass = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        foreach($getClass as $class)
        {
            $class_ids[] = $class->class_id;
        }
        $data['getRecord'] = HomeworkModel::getRecordTeacher($class_ids);
        $data['header_title'] = 'Homework';
        return view('teacher.homework.list', $data);
    }

    public function AddHomeWorkTeacher()
    {
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = 'Add New Homework';
        return view('teacher.homework.add', $data);
    }

    public function InsertTeacher(Request $request)
    {
        $homework = new HomeworkModel;
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);
        $homework->created_by = Auth::user()->id;

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('teacher/homework/home_work')->with('success', 'Homework Successfully Created');

    }

    public function EditHomeworkTeacher($id)
    {
        $getRecord = HomeworkModel::getSingle($id);
        $data['getRecord'] = $getRecord;
        $data['getSubject'] = ClassSubjectModel::MySubject($getRecord->class_id);
        $data['getClass'] = AssignClassTeacherModel::getMyClassSubjectGroup(Auth::user()->id);
        $data['header_title'] = 'Edit Homework';
        return view('teacher.homework.edit', $data);
    }

    public function UpdateHomeworkTeacher(Request $request, $id)
    {
        $homework = HomeworkModel::getSingle($id);
        $homework->class_id = trim($request->class_id);
        $homework->subject_id = trim($request->subject_id);
        $homework->homework_date = trim($request->homework_date);
        $homework->submission_date = trim($request->submission_date);
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('teacher/homework/home_work')->with('success', 'Homework Successfully Updated');

    }

    public function SubmittedTeacher($homework_id)
    {
        $homework = HomeworkModel::getSingle($homework_id);
        if(!empty($homework))
        {
            $data['homework_id'] = $homework_id;
            $data['getRecord'] = HomeworkSubmitModel::getRecord($homework_id);
            $data['header_title'] = 'Submitted Homework';
            return view('teacher.homework.submitted', $data);
        }
        else
        {
            abort(404);
        }
    }

    // student side work
    public function HomeworkStudent()
    {
        $data['getRecord'] = HomeworkModel::getRecordStudent(Auth::user()->class_id, Auth::user()->id);
        $data['header_title'] = 'My Homework';
        return view('student.homework.list', $data);
    }

    public function SubmitHomework($homework_id)
    {
        $data['getRecord'] = HomeworkModel::getSingle($homework_id);
        $data['header_title'] = 'Submit My Homework';
        return view('student.homework.submit', $data);
    }

    public function SubmitHomeworkInsert($homework_id, Request $request)
    {
        $homework = new HomeworkSubmitModel;
        $homework->homework_id = $homework_id;
        $homework->student_id = Auth::user()->id;
        $homework->description = trim($request->description);

        if(!empty($request->file('document_file')))
        {
            $ext = $request->file('document_file')->getClientOriginalExtension();
            $file = $request->file('document_file');
            $randomStr = date('ymdhis').Str::random(30);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/homework/', $filename);

            $homework->document_file = $filename;
        }
        $homework->save();

        return redirect('student/my_homework')->with('success', 'Homework Successfully Submitted');
    }

    public function HomeworkSubmittedStudent(Request $request)
    {
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent(Auth::user()->id);
        $data['header_title'] = 'My Submitted Homework';
        return view('student.homework.submitted_list', $data);
    }

    // parent side work
    public function HomeworkStudentParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkModel::getRecordStudent($getStudent->class_id, $getStudent->id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = 'Student Homework';
        return view('parent.homework.list', $data);
    }

    public function SubmittedHomeworkStudentParent($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $data['getRecord'] = HomeworkSubmitModel::getRecordStudent($getStudent->id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = 'Student Submitted Homework';
        return view('parent.homework.submitted_list', $data);
    }

}
