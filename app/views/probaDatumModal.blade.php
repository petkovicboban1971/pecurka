<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
</head>
<body>

<div class="container-fluid">
  <!-- Trigger the modal with a button -->
  <br>  <br>
<button type="button" class="btn btn-info btn-sm pull-right" data-toggle="modal" data-target="#myModal">Show Record</button>  <br>  <br>
<div class="panel panel-default col-sm-3">
  <div class="panel-heading"></div>
  <div class="panel-body">
    <form id="form1">
  <div class="form-group">
  <input type="Hidden" name="ID" class="form-control">
  </div>
  <div class="form-group">
    <label>Name</label>
  <input type="text" name="Name"  class="form-control">
   </div>
  <div class="form-group">
    <label>Bday</label>
  <input type="date" name="Bday"  class="form-control">
   </div>
  <div class="form-group">
    <label>Age</label>
  <input type="number" name="Age"  class="form-control">
   </div>
   <div class="form-group">
  <input type="submit" name="Submit"  class="btn btn-success">
   </div>
</form>

  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
       <div class="table-responsive">
          <table class="table" id="example">
            <thead>
              <tr>
                <th>Name</th>
                <th>Bday</th>
                <th>Age</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Name1</td>
                <td>10-1-1997</td>
                <td>20</td>
              </tr>
              <tr>
                <td>Name2</td>
                <td>9-1-1997</td>
                <td>20</td>
              </tr>
              
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
 </div>

</body>
<script type="text/javascript">
  // $(document).ready(function() {
    // $('#example').DataTable();
    var table= $('#example').DataTable();
    
    
    $(tableBody).on('click', 'tr', function () {
var cursor = table.row($(this).parents('tr'));//get the clicked row
var data=cursor.data();// this will give you the data in the current row.
var tableBody = '#example tbody';

});
    $('form').find("input[name='Name'][type='text']").val(data.name);
$('form').find("input[name='Bday'][type='text']").val(data.name);
$('form').find("input[name='Age'][type='text']").val(data.name);
// } );
</script>
</html>
