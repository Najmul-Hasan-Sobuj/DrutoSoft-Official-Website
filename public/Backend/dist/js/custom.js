//= image preview before upload
function previewFile(input){
    var file = $("input[type=file]").get(0).files[0];

    if(file){
        var reader = new FileReader();

        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
//= image preview before upload


//= global delete function

$(document).on('click', '#destroy', function(e) {
    e.preventDefault();
    let csrf = $(this).find("input[name='_token']").val();
    const delUrl = $(this).attr("href");
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "DELETE",
                    url: delUrl,
                    data: {
                        "_token": csrf
                    },
                    dataType: "html",
                    success: function(response) {
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        }).then((willDelete) => {
                            location.reload();
                        })
                    }
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
});
//= global delete function

//= DataTable 
$(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
//= DataTable 

//= toastr overwrite , close button
// toastr.options = Object.assign({}, toastr.options, {
//     closeButton: true
// });
//= toastr overwrite , close button
