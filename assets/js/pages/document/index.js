$(document).ready(function() {
  $('#table').DataTable({
    dom: 'Bfrtip',
    ajax: {
        url: base_url + "/system_web_module/datatable_get_all"
    },
    columns: [
        {
            'data': 'id',
            'visible': false
        },
        {
            'data': 'name',
            'class': 'text-center'
        },
        {
            'data': 'description',
            'class': 'text-center'
        },
        {
            'data': 'link',
            'class': 'text-center'
        },
        {
            'data': 'ctr',
            'class': 'text-center'
        },
        {
            'orderable': false,
            'data': null,
            'className': 'text-center',
            'render': function(data, type, full, meta){
                if(full.is_active==1)
                    return 'Yes';
                else
                    return 'No';
            }
        },
        {
            'orderable': false,
            'data': null,
            'className': 'text-center',
            'render': function(data, type, full, meta){
                var data = '';

                // data += '<a id="view" href="javascript:void(0)" class="btn btn-info" data-id="'+ full.id +'"><i class="fas fa-eye"></i></a> ';
                data += '<a id="edit" href="javascript:void(0)" class="btn btn-warning" data-id="'+ full.id +'"><i class="fas fa-pencil-alt"></i></a> ';
                data += '<a id="delete" href="javascript:void(0)" class="btn btn-danger" data-id="'+ full.id +'"><i class="fas fa-trash"></i></a> ';
                
                return data;
            }
        }
    ],  
    buttons: [
        "copy", 
        "excel", 
        "pdf", 
        "print"
    ]
  }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
    
});


$(document).on('click','#view',function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    window.location = base_url + "system_web_module/view/" + id;
 });
 
 $(document).on('click','#edit',function(e) {
    e.preventDefault();
 
    var id = $(this).data("id");
 
    window.location = base_url + "system_web_module/edit/" + id;
 
 });

$(document).on('click','#delete',function(e) {
    e.preventDefault();
    var id = $(this).data("id");

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    });

      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : base_url + "system_web_module/delete/" + id,
                type: "POST",
                dataType: 'json'
            }).done(function(response){ 
    
                if(!response['status'])
                {
                    swalWithBootstrapButtons.fire(
                        'Oops!',
                        response['message'],
                        'info'
                    );
                    return;
                }

                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    response['message'],
                    'success'
                ).then(function() {
                    window.location = base_url + "system_web_module";
                });
            });

        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Delete cancelled. Your record is safe :)',
            'error'
          )
        }
      })

      e.preventDefault();
});
