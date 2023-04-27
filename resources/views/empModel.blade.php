<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addemp">{{ __('pages.emp.add')  }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action=""  method="" id="add_employee_form" >
        @csrf
        <input type="hidden" name="empID" id="empID">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
              <label for="fname">{{ __('pages.emp.fname')  }}</label>
              <input type="text" name="fname" id = "fname" class="form-control" value = "{{ $emp->first_name ?? null }}" placeholder="First Name" >
              <span class="text-danger"></span>
            </div>
            <div class="col-lg">
              <label for="lname">{{ __('pages.emp.lname')  }}</label>
              <input type="text" name="lname" id = "lname" class="form-control" value = "{{ $emp->last_name ?? null }}" placeholder="Last Name" >
              <span class="text-danger"></span>
            </div>
          </div>
          <div class="my-2">
            <label for="email">{{ __('pages.emp.email')  }}</label>
            <input type="text" name="email"  id = "email" class="form-control" value = "{{ $emp->email ?? null }}" placeholder="E-mail" >
            <span class="text-danger"></span>
          </div>
          <div class="my-2">
            <label for="gender">{{ __('pages.emp.gender')  }}</label>
            <input type="tel" name="gender" id = "gender" class="form-control" value = "{{ $emp->gender ?? null }}" placeholder="Gender" >
            <span class="text-danger"></span>
          </div>
          <div class="my-2">
            <label for="designation">{{ __('pages.emp.designation')  }}</label>
            <input type="text" name="designation"  id = "designation" class="form-control" value = "{{ $emp->designation ?? null }}" placeholder="designation" >
            <span class="text-danger"></span>
          </div>
          <div class="my-2">
            <label for="hobbies">{{ __('pages.emp.hobbies')  }}</label>
            <input type="text" name="hobbies" id = "hobbies" class="form-control" value = "{{ $emp->hobbies ?? null }}" placeholder="hobbies" >
            <span class="text-danger"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btn"  emp_id="{{ $id }}"  class="btn btn-primary">Add Employee</button>
        </div>
      </form>
    </div>
  </div>

<script>
$(document).ready(function() {
  
    $("#add_employee_form").validate({
        rules: {
            fname: {
                required: true,
                maxlength: 20,
            },
            lname:{
                required: true,
                maxlength: 20,
            },
            email: {
                required: true,
                email: true,
                maxlength: 50
            },
            gender: {
                required: true,
            },
            designation:{
                required: true,
                maxlength: 20,
            },
            hobbies:{
              required: true,
              maxlength: 20,
            }
        },
        messages: {
            fname: {
                required: "First name is required",
                maxlength: "First name cannot be more than 20 characters"
            },
            lname: {
                required: "Last name is required",
                maxlength: "Last name cannot be more than 20 characters"
            },
            email: {
                required: "Email is required",
                email: "Email must be a valid email address",
                maxlength: "Email cannot be more than 50 characters",
            },
            gender: {
                required: "gender  is required",
            },
            designation: {
                required: "designation is required",
                maxlength: "designation cannot be more than 20 characters"
            },
            hobbies: {
                required: "avatar is required",
                maxlength: "designation cannot be more than 20 characters"
            },

        }
    });
});


</script>