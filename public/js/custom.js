var model = $('#common_modal');
function viewEmployee(id) {
    console.log("Employee modal");
    var url = baseUrl + '/emp';
    if (id) {

        url = baseUrl + '/emp/' + id;
    }
    $.get(url, function (data) {
        model.html('');
        model.html(data.view);
        model.modal('show');
        model.addClass('addemp');
    }); 
}


$(document).click(function (e) {
    if ($(e.target).is('#common_modal')) {            
        $('#add_employee_form').modal('close');
    }

});
$(function () {
     
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });

$(document).ready(function() {
            //load user data into table
            $('#DataTable').DataTable({
                "bSort": false,
                "responsive": true,
                "searching": true,
                "processing": true,
                "serverSide": true,
                "deferRender": true,
                "lengthChange": true,
                "pageLength": 10,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    search: "",
                    searchPlaceholder: "Search"
                },
                "ajax": {
                    "url": "http://127.0.0.1:8001/getlist",
                    "dataType": "json",
                    "type": "POST",
                    
                },
                "columns": [{
                        "data": "id",
                        orderable: false
                    },
                    {
                        "data": "first_name",
                        orderable: false
                    },
                    {
                        "data": "last_name",
                        orderable: false
                    }, {
                        "data": "email",
                        orderable: false
                    },
                    {
                        "data": "gender",
                        orderable: false
                    },
                    {
                        "data": "designation",
                        orderable: false
                    },
                    {
                        "data": "hobbies",
                        orderable: false
                    },
                    {
                        "data": "user_role",
                        orderable: false
                    },
                    {
                        "data": "action",
                        orderable: false
                    },
                ]
            });
        });  
});




$(document).on("click", '#add_employee_btn', function (event) {
    event.preventDefault();
     
    var formData = $('#add_employee_form').serialize();
        console.log(formData);
       var emp_id = $(this).attr('emp_id');
    //    var  fname = $("#fname").val();
    //    var lname = $("#lname").val();
    //    var email= $("#email").val();
    //    var gender = $('input[type="radio"]:checked').val();
    //    var designation= $("#designation").val();
    //    var user_role= $("#user_role").val();
      
    //    var hobbie = [];  
    //    $('.hobbies').each(function(){  
    //         if($(this).is(":checked"))  
    //         {  
    //           hobbie.push($(this).val());  
    //         }  
    //    });  
    // hobbies = hobbie.toString();

    var url = baseUrl + '/store';
    if ( emp_id !== 'undefined' && emp_id != '') {
        url = baseUrl + '/store/' + emp_id;
    }
    
    $.ajax({
        type: "POST",
        url: url,
        data: formData,
            
        dataType: "json",
        encode: true,
    }).done(function (data) {
        if (data) {
            $("#fname").val("");
            $("#lname").val("");
            $("#email").val("");
            $("#gender").val("");
            $("#designation").val("");
            $("#hobbies").val("");
            $("#user_role").val("");
            model.html('');
            model.modal('hide');
            $('#DataTable').DataTable().ajax.reload();
        } else {
            alert("something went wrong.");
        }

    });
});




$(document).on('click', '.delete_detail', function (event) {
    var delete_id = $(this).attr('id');

    $.ajax({
        type: "DELETE",
        url: baseUrl + '/Delete',
        data: { id: delete_id },
    }).done(function (data) {
        console.log(data);

        if (data) {
               model.html('');
                model.modal('hide');
                $('#DataTable').DataTable().ajax.reload();
            
                iziToast.success({
                timeout: 5000,
                message: 'Record deleted successfully.'
            });

        } else {
            iziToast.error({
                timeout: 5000,
                message: 'Something went wrong.'
            });
        }

    });

});



