$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
    
    $.validator.addMethod("ddl_required", function(value) {
        return value != '0';
    }, "This field is required");

    $.validator.setDefaults({
        submitHandler: function () {
            const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                        },
                        buttonsStyling: true
                    });

            var formData = $('#form').serialize();

            $.ajax({
                url : base_url + "system_web_section/save",
                type: "POST",
                data : formData,
                dataType: 'json'
            }).done(function(response){ 

                if(response['status'])
                {
                      swalWithBootstrapButtons.fire({
                        title: 'Success!',
                        text: "Do you want to add another one?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = base_url + "system_web_section/create";
                        } else if (
                          /* Read more about handling dismissals below */
                          result.dismiss === Swal.DismissReason.cancel
                        ) {
                            window.location = base_url + "system_web_section";
                        }
                      });
                      
                      return;
                }

                Toast.fire({
                    icon: 'error',
                    title: response['message']
                });
            });
        }
      });
      
      $('#form').validate({
        rules: {
          name: {
            required: true
          },
          code: {
            required: true
          },
          web_module_id: {
            ddl_required: true
          }
        },
        messages: {
          name: {
            required: "This field is required"
          },
          code: {
            required: "This field is required"
          },
          web_module_id: {
            ddl_required: "This field is required"
          }
        },
        errorElement: 'span', 
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.input-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });


});
