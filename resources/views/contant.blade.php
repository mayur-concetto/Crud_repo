@extends('layouts.app')
@section('content')
    

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-12 text-right">
            <button class="btn btn-info" data-bs-toggle="modal" id= "addEmp" onclick="viewEmployee()"  data-bs-target="#addEmployeeModal"><i
                class="bi-plus-circle me-2">{{ __('pages.emp.add')  }}</i></button>
            </div>
            </div>
            
            <div class="row" style="clear: both;margin-top: 18px;">
                <div class="col-12">
                <table class="table table-bordered" id = "DataTable">
                    <thead>
                    <tr>
                        <th>{{ __('pages.emp.id')  }}</th>
                        <th>{{ __('pages.emp.fname')  }}</th>
                        <th>{{ __('pages.emp.lname')  }}</th>
                        <th>{{ __('pages.emp.email')  }}</th>
                        <th>{{ __('pages.emp.gender')  }}</th>
                        <th>{{ __('pages.emp.designation')  }}</th>
                        <th>{{ __('pages.emp.hobbies')  }}</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
         </div>
    </div>
</div>
            @endsection
            @section('models')
                <div class="modal fade" id="common_modal" tabindex="-1" aria-labelledby="addemp" aria-hidden="true">
                </div>
            @endsection


            