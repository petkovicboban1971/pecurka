<!-- include the style -->
    <link rel="stylesheet" href="css/alertify.min.css" />
    <!-- include a theme -->
    <link rel="stylesheet" href="css/themes/default.min.css" />

    <script type="text/javascript" src="{{ AdminOptions::base_url()}}/js/alertify.js"></script>
    <script type="text/javascript" src="{{ AdminOptions::base_url()}}/js/alertify.min.js"></script>

<!-- the content to be viewed as dialog
  ***Define the two input boxes
  *** Note the input element class "ajs-input" that i have used here , this is the class used by AlertifyJS for its Input elements.
-->
<div style="display:none;" >
    <div id="dlgContent">
        <p> Value1 </p>
        <input class="ajs-input" id="inpOne" type="text" value="Input1"/> 

        <p> Value2 </p>
        <input class="ajs-input" id="inpTwo" type="text" value="Input2"/> 
       
    </div>
</div>

<!-- the script  -->

<script>
  var dlgContentHTML = $('#dlgContent').html();

$('#dlgContent').html(""); 
/* This is important : strip the HTML of dlgContent to ensure no conflict of IDs for input boxes arrises" */


/* Now instead of making a prompt Dialog , use a Confirm Dialog */

alertify.confirm(dlgContentHTML).set('onok', function(closeevent, value) { 
          var inpOneVal = $('#inpOne').val();
          var inpTwoVal = $('#inpTwo').val();

          $.post('/admin-zarada',
                { 
                  plata: inpOneVal,
                  procenat: inpTwoVal
                });

        }).set('title',"<?php echo AdminOptions::lang(148, Session::get('jezik.AdminOptions::server()')) ?>");
 </script>
        