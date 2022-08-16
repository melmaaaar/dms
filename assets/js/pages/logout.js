$(document).ready(function() {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $('#btn_logout').on('click',function(e) {
        e.preventDefault();
        $.ajax({
            url : base_url + "Auth/logout",
            type: "POST",
        }).done(function(response){
            Toast.fire({
                icon: 'info',
                title: 'You have logged out.'
            }).then(function(){
                window.location = base_url + "Auth";
            });
        });
    });

});
