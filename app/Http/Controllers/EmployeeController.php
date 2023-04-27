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
			// echo $sarchVal;die;
			$limit = $request->input('length');
            $start = $request->input('start');

            $getData = Employee::latest()->get();
			// echo "<pre>";print_r($getData);die;
            if (!empty($orderVal)) {
                $getData = $getData->orderBy($orderVal, $direction);
            }
            $totalaData = $getData->count();
			if (!empty($sarchVal)) {
				// echo "hello";die;
                $getData = $getData->where(function ($q) use ($sarchVal) {
					$q->where("first_name", 'LIKE', "%$sarchVal%");
					
				});
            }
            $totalaFilterData = $getData->count();
			// print_r($totalaFilterData);die;
			// $getData = $getData->offset($start)->limit($limit)->get();
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
			
                    $action .= '<a href="javascript:void(0);" data-bs-toggle="modal" onclick="viewEmployee(' . $pval->id . ')"
                            class="btn btn-success action-btn btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Edit"><i class="icon-edit"></i>EDIT</a>';

                    $action .= '<a href="javascript:void(0);" class="btn btn-danger  delete_detail" data-bs-toggle="modal" id="' . $pval->id . '"  data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Delete"><i class="icon-delete"></i>DELETE</a>';
                            
                    $data['action'] = $action;
                    $pdata[] = $data;
                }
				// echo "<pre>";print_r($pdata);die;
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
            // $response['message'] = __('admin_message.admin_exception_message');
            return response()->json($response);
        }
		
		
	}

	public function load($id = null)
	{
		// echo "hello";die;
		$title = __('ADD Employee');
        $emp = null;
		// echo $id;die;
        if (!empty($id)) {
            $title = __('EDIT Employee');
            $emp = Employee::find($id);
			
		}
		
        $view = view('empModel', compact('emp', 'id'))->render();
        $response['emp'] = $emp;
        $response['view'] = $view;
		return response()->json($response);
	}

	public function store(Request $request, $id = null)
    {
		$request->validate([    
			'fname' => 'required',
			'lname' => 'required',
			'email' => 'required|email',
			'gender' => 'required',
			'designation' => 'required',
			'hobbies' => 'required',
            ]);
		
		$response = false;
		$data = [
			'first_name' => $request->fname,
			'last_name' => $request->lname,
			'email' => $request->email,
			'gender' => $request->gender,
			'designation' => $request->designation,
			'hobbies' => $request->hobbies,
        ];
        $save = Employee::updateOrCreate(['id' => $id], $data);
        // return response()->json([$save,'status' => 200,]);
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
