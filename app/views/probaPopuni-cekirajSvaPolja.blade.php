<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>


<form role="form" id="contentHoldEdu" method="post">
  <div class="setup-content form-horizontal form-bordered" id="step-1">

    <div class="form-group">
      <label class="label1 col-md-4">Enter the name  <span class="required"> * </span> </label>
      <div class="col-md-7">
        <input id="Name" type="text" name="name" data-required="1" class="form-control" onkeyup="changeDetected()"/>

      </div>
    </div>
    <div class="form-group">
      <label class="label1 col-md-4">Enter Admission Year <span class="required"> * </span> </label>
      <div class="col-md-7">
        <input id="AdmissionYear" type="text" name="name" data-required="1" class="form-control allownumericwithoutdecimal" maxlength="4" onkeyup="changeDetected()" />


      </div>
    </div>
    <div class="form-group">
      <label class="label1 col-md-4">Select course <span class="required"> * </span> </label>
      <div class="col-md-7">
        <select id="courseSelect" class="form-control" data-placeholder="Select" tabindex="1" onchange="changeDetected()">
<option value="">--Select--</option>
                                    <option value="B.tech">B.tech</option>
                                    <option value="mba">Mba</option>
                                  </select>
      </div>
    </div>
    <div class="form-group">
      <label class="label1 col-md-4">Select all applicable faculties <span class="required"> * </span> </label>
      <div class="col-md-7">
        <div class="portlet light portlet-fit box grey ">
          <div class="portlet-body">
            <table class="eduleveles table table-bordered table-hover">
              <thead>
                <th>confirm</th>
                <th> AC Room</th>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type="checkbox" id="confirmRoom" onchange="changeDetected()"/></td>
                  <td>Yes</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" id="confirmRoom2" onchange="changeDetected()"/></td>
                  <td>Yes</td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" id="confirmRoom3" onchange="changeDetected()"/></td>
                  <td>Yes</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <button class="btn btn-primary" id="Save" type="button" disabled="disabled">submit</button>
    </div>
<script>
var Seatname;
var Seatadmissionyr;
var Seatlevelselectval;
var SeatProgramLevel;
//var SeatAvailableFaculties;
$('#SaveNxt').attr('disabled', 'disabled');

function changeDetected(){
  name = $('#Name').val()
  admissionyr = $('#AdmissionYear').val()
  SeatProgramLevel = $('#courseSelect').val();

  if ((name.length > 0) && (admissionyr.length > 0) && (SeatProgramLevel.length > 0) && ($('#confirmRoom').attr('checked') != undefined) && ($('#confirmRoom2').attr('checked') != undefined) && ($('#confirmRoom3').attr('checked') != undefined)) {
    $('#Save').removeAttr('disabled');
  } else {

    $('#Save').attr('disabled', 'disabled');
  }
}
</script>