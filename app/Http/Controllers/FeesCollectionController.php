<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ClassModel;
use App\Models\User;
use App\Models\StudentAddFeesModel;
use App\Models\SettingModel;
use Auth;
use Zfhassaan\Easypaisa\Easypaisa;

class FeesCollectionController extends Controller
{
    public function CollectFees(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        if(!empty($request->all()))
        {
            $data['getRecord'] = User::getCollectFeesStudent();
        }
        $data['header_title'] = "Collect Fees";
        return view('admin.fees_collection.collect_fees', $data);
    }

    public function CollectFeesReport()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = StudentAddFeesModel::getRecord();
        $data['header_title'] = "Collect Fees Report";
        return view('admin.fees_collection.collect_fees_report', $data);
    }

    public function CollectFeesAdd($student_id)
    {
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = "Add Collect Fees";
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        return view('admin.fees_collection.add_collect_fees', $data);
    }

    public function CollectFeesInsert($student_id, Request $request)
    {
        $getStudent = User::getSingleClass($student_id);
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        if(!empty($request->amount))
        {

            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >= $request->amount)
            {
                $remaining_amount_user =  $RemainingAmount - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->student_id = $student_id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount	 = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::User()->id;
                $payment->is_payment = 1;
                $payment->save();

                return redirect()->back()->with('success', 'Fees Successfully Add');
            }
            else
            {
                return redirect()->back()->with('error', 'Your amount go to greater than remaining amount');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'You add your amount atleast greater than zero');
        }

    }

    // student side work

    public function CollectFeesStudent(Request $request)
    {
        $student_id = Auth::user()->id;

        $data['getFees'] = StudentAddFeesModel::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;

        $data['header_title'] = "Fees Collection";

        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        return view('student.my_fees_collection', $data);
    }


    public function CollectFeesStudentPayment(Request $request)
    {
        $getStudent = User::getSingleClass(Auth::user()->id);
        $paid_amount = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        if(!empty($request->amount))
        {
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >= $request->amount)
            {
                $remaining_amount_user =  $RemainingAmount - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->student_id = Auth::user()->id;
                $payment->class_id = Auth::user()->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount	 = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::User()->id;
                $payment->save();

                $getSetting = SettingModel::getSingle();

                if($request->payment_type == 'Easypaisa')
                {
                    // $query = array();
                    // $query['business']  = $getSetting->account_number;
                    // $query['cmd']  = '_xclick';
                    // $query['item_name']  = 'Student Fees';
                    // $query['no_shipping']  = '1';
                    // $query['orderRefNumber'] = uniqid('order_');

                    // $query['item_number']  = '$payment->id';
                    // $query['amount']  = $request->amount;
                    // $query['currency_code']  = 'PKR';
                    // $query['cancel_return']  = url('student/easypaisa/payment-error');
                    // $query['return']  = url('student/easypaisa/payment-success');

                    // $query_string = http_build_query($query);

                    // header('Location: https://api.eu-de.apiconnect.appdomain.cloud/easypaisaapigw-telenorbankpk-tmbdev/dev-catalog' . $query_string);
                    // exit();
                }

                if($request->payment_type == 'Jazzcash')
                {

                }

                return redirect()->back()->with('success', 'Fees Successfully Add');
            }
            else
            {
                return redirect()->back()->with('error', 'Your amount go to greater than remaining amount');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'You add your amount atleast greater than zero');
        }
    }

    public function PaymentError()
    {
        // return redirect('student/fees-collection')->with('error', 'Due to some error please try again');
    }

    public function PaymentSuccess(Request $request)
    {
        // dd($request->all());
    }



    // parent side work

    public function CollectFeesStudentParent($student_id, Request $request)
    {
        $getStudent = User::getSingle($student_id);
        $data['getStudent'] = $getStudent;

        $data['getFees'] = StudentAddFeesModel::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;

        $data['header_title'] = "Fees Collection";

        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        return view('parent.my_fees_collection', $data);
    }
}
