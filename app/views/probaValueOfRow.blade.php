<table id="tablename">
    <tr>
        <td>hi!</td>
    <tr>
</table>
<button onclick="showCell()">Show Cell Value</button>

<script>
function showCell() {
    var sTableName = document.getElementById("tablename");

    for (var i=0;i<sTableName.rows.length;i++) {
        var col1= sTableName.rows[i].cells[0].innerText;
        alert(col1)
    }
}
</script>