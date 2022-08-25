$(document).ready(function() {
    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        ajax: {
            url: base_url + "/document/datatable_get_all"
        },
        columns: [
            {
                'className': 'dt-control text-center',
                'orderable': false,
                'data': null,
                'defaultContent': ''
            },
            {
                'data': 'id',
                'visible': false
            },
            {
                'data': 'document_date',
                'class': 'dt-body-left'
            },
            {
                'orderable': false,
                'data': null,
                'className': 'dt-body-left',
                'render': function(data, type, full, meta){
                    if(full.rgv_document_tlp_code_id==10)
                        return '<span class="badge bg-danger"><i class"fas fa-circle"></i></span> ' + full.reference_number;
                    else if(full.rgv_document_tlp_code_id==11)
                        return '<span class="badge bg-yellow"><i class"fas fa-circle"></i></span> ' + full.reference_number;
                    else if(full.rgv_document_tlp_code_id==10)
                        return '<span class="badge bg-green"><i class"fas fa-circle"></i></span> ' + full.reference_number;
                    else
                        return '<span class="badge bg-white"><i class"fas fa-circle"></i></span> ' + full.reference_number;
                }
            },
            {
                'data': 'title',
                'class': 'dt-body-left'
            },
            {
                'data': 'document_type',
                'class': 'text-center'
            },
            {
                'data': 'document_status',
                'class': 'text-center'
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
            },
            {
                'data': 'remarks',
                'visible': false
            }
        ],  
        buttons: [
            "copy", 
            "excel", 
            "pdf", 
            "print"
        ]
    });
    table.buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
// Add event listener for opening and closing details
    $('#table tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
    
});


$(document).on('click','#view',function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    window.location = base_url + "document/view/" + id;
 });
 
 $(document).on('click','#edit',function(e) {
    e.preventDefault();
 
    var id = $(this).data("id");
 
    window.location = base_url + "document/edit/" + id;
 
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

function format(d) {
    // `d` is the original data object for the row
    return (
        '<table  cellspacing="0" border="0" width="100%">' +
            '<tr>' + 
                '<td style="width: 15%;">Date of Completion:</td>' +
                '<td>N/A</td>' +
            '</tr>' + 
            '<tr>' + 
                '<td style="width: 15%;">No. Of Days Completed:</td>' +
                '<td>N/A</td>' +
            '</tr>' + 
            '<tr>' + 
                '<td style="width: 15%;">Remarks</td>' +
                '<td>'+ d.remarks +'</td>' +
            '</tr>' + 
        '</table>'
    );
}