<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php $item_id=8; ?>


<button data-toggle="modal" data-target="#view-modal" data-id="<?php echo $item_id; ?>" id="getUser" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-eye-open"></i> View</button> 


  <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
      <div class="modal-content"> 
        <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
            <h4 class="modal-title">
                <i class="glyphicon glyphicon-user"></i> User Profile
            </h4> 
        </div> 
        <div class="modal-body"> 

           <div id="modal-loader" style="display: none; text-align: center;">
            <img src="ajax-loader.gif">
           </div>

           <!-- content will be load here -->                          
           <div id="dynamic-content"></div>

        </div> 
        <div class="modal-footer"> 
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
        </div> 
      </div> 
    </div>
  </div>
</body>
<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click', '#getUser', function(e){

        e.preventDefault();

        var item_id= $(this).data('id');   // it will get id of clicked row

        $('#dynamic-content').html(''); // leave it blank before ajax call
        $('#modal-loader').show();      // load ajax loader


        var radnik=item_id;
        var kupac=item_id+1;
        var x={radnik:item_id,
                kupac:item_id+1};

        $.ajax({
            url: '/privremena-tabela',
            type: 'POST',
            data: x, 
            dataType: 'html'
        })
        .done(function(data){
            console.log(data);  
            $('#dynamic-content').html('');    
            $('#dynamic-content').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });

    });

});
</script>
</html>