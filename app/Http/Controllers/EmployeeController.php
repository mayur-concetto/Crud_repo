<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
	public function index(Request $request){
		$Employee = Employee::all();
		return view('contant', compact('Employee'));	

	}

    public function Getlist(Request $request) {
		try {
            $columns = array(
                0 => 'first_name',
            );
            $orderVal = isset($columns[$request->input('order.1.column')]) ? $columns[$request->input('order.1.column')] : null;
            $direction = $request->input('order.1.dir');
            $sarchVal = !empty($request->input('search.value')) ? $request->input('search.value') : null;
			$limit = $request->input('length');
            $start = $request->input('start');

            $getData = Employee::latest()->get();
			if (!empty($orderVal)) {
                $getData = $getData->orderBy($orderVal, $direction);
            }
            $totalaData = $getData->count();
			if (!empty($sarchVal)) {
				$getData = $getData->where(function ($q) use ($sarchVal) {
					$q->where("first_name", 'LIKE', "%$sarchVal%");
					
				});
            }
            $totalaFilterData = $getData->count();
			$pdata = [];
            $i = 1;
            if (count($getData)) {
                foreach ($getData as $pkey => $pval) {
                    $data = [];
                    $action = "";

                    $data['id'] = $pval->id;
                    $data['first_name'] = $pval->first_name;
                    $data['last_name'] = $pval->last_name;
					$data['email'] = $pval->email;
					$data['gender'] = $pval->gender;
					$data['designation'] = $pval->designation;
					$data['hobbies'] = $pval->hobbies;
                    $data['user_role'] = $pval->user_role;
			
                    $action .= '<a href="javascript:void(0);" data-bs-toggle="modal" onclick="viewEmployee(' . $pval->id . ')"
                            class="btn btn-success action-btn btn-sm" id = "update" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Edit"><i class="icon-edit"></i>EDIT</a>';

                    $action .= '<a href="javascript:void(0);" class="btn btn-danger  delete_detail" data-bs-toggle="modal" id="' . $pval->id . '"  data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Delete"><i class="icon-delete"></i>DELETE</a>';
                            
                    $data['action'] = $action;
                    $pdata[] = $data;
                }
            }
            $jsonData = array(
                "draw" => intval($request->input('draw')),
                "recordsTotal" => $totalaData,
                "recordsFiltered" => $totalaFilterData,
                "data" => $pdata
            );
            return response()->json($jsonData);
        } catch (Exception $ex) {
            echo $ex->getMessage();die;
            Log::info('Exception emp list');
            Log::error($ex);
            $response['status'] = false;
            return response()->json($response);
        }
		
		
	}

	public function load($id = null)
	{
		$title = __('ADD Employee');
        $emp = null;
        if (!empty($id)) {
            $title = __('EDIT Employee');
            $emp = Employee::find($id);
		}
        $view = view('empModel', compact('emp', 'id','title'))->render();
        $response['emp'] = $emp;
        // dd($response['emp']);
        $response['view'] = $view;
		return response()->json($response);
	}

	public function store(Request $request, $id = null)
    {
		$request->validate([    
			'fname' => 'required|max:255',
			'lname' => 'required|max:255',
			'email' => 'required|email',
			'gender' => 'required',
			'designation' => 'required|max:255',
			'hobbies' => 'required',
            'user_role' => 'required|in:Admin,Customer',
            ]);
		
		$response = false;
		$data = [
			'first_name' => $request->fname,
			'last_name' => $request->lname,
			'email' => $request->email,
			'gender' => $request->gender,
			'designation' => $request->designation,
			'hobbies' => $request->hobbies,
            'user_role' => $request->user_role,
        ];
        // dd($data);die;
        if($id!=""){
            $employee = Employee::find($id);
        }else{
            $employee = new  Employee();
        }
        // \DB::enableQueryLog();
        $employee->first_name  = $request->fname;
        $employee->last_name  = $request->lname;
        $employee->email  = $request->email;
        $employee->gender  = (string)$request->gender;
        $employee->designation  = $request->designation;
        $employee->hobbies  = ($request->hobbies);
        $employee->user_role  = $request->user_role;
        $save = $employee->save();
		if ($save) {
            $response = true;
        }
        return $response;
    
	}

	public function delete(Request $request)
    {
        $id = $request->id;
        if (!empty($id)) {
               	$delete = Employee::where('id', $id)->delete();
            }
        return $delete;
    }
}
