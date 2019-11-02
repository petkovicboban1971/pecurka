<form name="courseForm" id="courseForm">
        <select name="coursetype" id="coursetype">
            <option value="0" selected disabled>Select here...</option>
            <option value="1">CourseName 1</option>
            <option value="2">CourseName 2</option>
            <option value="3">CourseName 3</option>
        </select>
        <button type="button" id="startBtn" disabled>Start</button>
    </form>
<script>
var courses = ['1','2'];

$('#coursetype').one('change', function() {
     $('#startBtn').prop('disabled', false);
});

$('#startBtn').on('click', function() {
    var val = $('#coursetype').val(),
        msg = $.inArray(val, courses) != -1 ? 'CourseName '+val+' is selected!' : 'This course is not implemented yet';
    alert(msg);
});
</script>