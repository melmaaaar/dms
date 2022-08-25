$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    $.validator.setDefaults({
    submitHandler: function () {
        var formData = $('#form').serialize();
        $.ajax({
            url : base_url + "system_web_module/update",
            type: "POST",
            data : formData,
            dataType: 'json'
        }).done(function(response){ 

            if(response['status'])
            {
                Toast.fire({
                    icon: 'success',
                    title: response['message']
                }).then(function(){
                    window.location.reload();
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
      }
    },
    messages: {
      name: {
        required: "Please provide a name"
      },
      code: {
        required: "Please provide a code"
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