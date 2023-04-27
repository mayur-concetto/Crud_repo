var model = $('#common_modal');
function viewEmployee(id) {
    // console.log(id)
    console.log("Employee modal");
    var url = baseUrl + '/emp';
    if (id) {
        url = baseUrl + '/emp/' + id;
    }
    $.get(url, function (data) {
        // console.log(data.view);
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
                        "data": "action",
                        orderable: false
                    },
                ]
            });
        });  
});


$(document).on("click", '#add_employee_btn', function (event) {
    
    var emp_id = $(this).attr('emp_id');
    var formData = {
        id: $('#empID').val(),
        fname: $("#fname").val(),
        lname: $("#lname").val(),
        email: $("#email").val(),
        gender: $("#gender").val(),
        designation: $("#designation").val(),
        hobbies: $("#hobbies").val(),
    };
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
        console.log(data);
        if (data) {
            $("#fname").val("");
            $("#lname").val("");
            $("#email").val("");
            $("#gender").val("");
            $("#designation").val("");
            $("#hobbies").val("");

            model.html('');
            model.modal('hide');
            $('#dashboard-table').DataTable().ajax.reload();
            //saveCircuitModal(mall_id);
        } else {
            alert("something went wrong.");
        }

    });
});

//  function ADDdata(){
//     $("#add_employee_form").submit(function(e) {
//         e.preventDefault();
//         const fd = new FormData(this);
        
//         $("#add_employee_btn").text('Adding...');
//         $.ajax({
//           url: 'http://127.0.0.1:8001/Store',
//           method: 'post',
//           data: fd,
//           cache: false,
//           contentType: false,
//           processData: false,
//           dataType: 'json',
//           success: function(response) {
//             if (response.status == 200) {
//               iziToast.success({
//                     timeout: 5000,
//                     message: 'Record insert successfully.'
//                 });
//             }
//                 model.html('');
//                 model.modal('hide');
//                 $('#DataTable').DataTable().ajax.reload();
              
//           }
//         });
//       });
//  }

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



