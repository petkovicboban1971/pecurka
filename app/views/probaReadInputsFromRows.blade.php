<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<table id="mantab" style="cursor:pointer;">
<tr>
  <a href="#" data-popover=".popover-help" class="open-popover modal-in"></a>
  <td><input type='text' placeholder="Term" id='inp1' class="key" /></td>
  <td><input type='text' placeholder="Definition" id='inp2' class="value" /></td>
</tr>
<tr>
  <a href="#" data-popover=".popover-help" class="open-popover modal-in"></a>
  <td><input type='text' placeholder="Term" id='inp1' class="key" /></td>
  <td><input type='text' placeholder="Definition" id='inp2' class="value" /></td>
</tr>
</table>

<button id="bt">
Get Value
</button>
<script>
$("#bt").click(function()
{
  var keys = [], values = [];

  $('table tr input').each(function(i,e){
  //access the input's value like this:
    var $e = $(e);
    if($e.hasClass('key')){
      keys.push($e.val());
    }else{
    values.push($e.val());
    }
});  
  keys = keys.join(',');
  values = values.join(',');
  console.log(keys);
  console.log(values);
});
</script>