$(function () {
  bsCustomFileInput.init();
});

function resetFile() {
  bsCustomFileInput
  const file = document.querySelector('.custom-file-input');
  file.value = '';

  document.getElementById('lbl_file_upload').innerHTML = 'Upload attachments';
}


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

            var form = document.getElementById('form');
            var formData = new FormData(form);
            // Read selected files
            var totalfiles = document.getElementById('attachments').files.length;
            for (var index = 0; index < totalfiles; index++) {
              formData.append("attachments[]", document.getElementById('attachments').files[index]);
            }

            $.ajax({
                type: 'POST',
                url: base_url + 'document/save', 
                data: formData,
                contentType: false,
                cache: false,
                processData:false,
                dataType: 'json'
            }).done(function(response){ 
                 console.log(response);
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
                            window.location = base_url + "document/create";
                        } else if (
                          /* Read more about handling dismissals below */
                          result.dismiss === Swal.DismissReason.cancel
                        ) {
                            window.location = base_url + "document";
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
          document_date: {
            required: true
          },
          document_time: {
            required: true
          },
          reference_number: {
            required: true
          },
          title: {
            required: true
          },
          rgv_document_type_id: {
            ddl_required: true
          },
          rgv_document_status_id: {
            ddl_required: true
          }
        },

        messages: {
          document_date: {
            required: "This field is required"
          },
          document_time: {
            required: "This field is required"
          },
          reference_number: {
            required: "This field is required"
          },
          title: {
            required: "This field is required"
          },
          rgv_document_type_id: {
            ddl_required: "This field is required"
          },
          rgv_document_status_id: {
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
