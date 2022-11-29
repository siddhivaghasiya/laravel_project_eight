<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

</head>
<body>

<div class="container">
  <h2>Product Form Listing</h2>
  <h4><a href="{{ route('product.create') }}" id="createNewProduct">Add Product Records</a></h4>
  <table class="table" id="users-table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>details</th>
        <th>Status</th>
        <th>Action</th>

      </tr>
    </thead>
    <tbody>

    </tbody>
  </table>
</div>
<script>
    var oTable = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        searching:false,
        responsive: true,
        ajax: {
              url:'{!! route('product.ajaxlisting') !!}',
              data: function (d) {

              }
            },
        columns: [
          { data: 'id'},
          { data: 'name'},
          { data: 'details'},
          { data: 'status'},
          { data: 'action'},
        ]
    });



    $(document).on("click",".delete",function(){


        var myUrl = $(this).attr('data-link');

        $.ajax({
            type: 'DELETE',
            url: myUrl,
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success:  function(response) {
                if (response.status == 0 && response.msg != "") {

                    oTable.draw();

                }
            }

        });
    });


    </script>

</body>
</html>

