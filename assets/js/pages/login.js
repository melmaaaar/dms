$(document).ready(function() {

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $.validator.setDefaults({
        submitHandler: function () {
            
            var formData = $('#form').serialize();
            
            $.ajax({
                url : base_url + "Auth/login",
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
                        window.location = base_url + "dashboard";
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
          username: {
            required: true
          },
          password: {
            required: true
          },
          terms: {
            required: true
          },
        },
        messages: {
          username: {
            required: "Please provide a username"
          },
          password: {
            required: "Please provide a password"
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
