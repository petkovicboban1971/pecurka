
<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<div id="content"> 
    <div id="CreateForm" class="modal fade" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="bg-danger close" href="/admin-welcome" style="color:#000"; >&nbsp;×&nbsp;</a>
                    <h4 class="modal-title text-xs-center" style="color:#fff"; >
                        {{ AdminOptions::lang(11, Session::get('jezik.AdminOptions::server()')) }}
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">
                            {{ AdminOptions::lang(11, Session::get('jezik.AdminOptions::server()')) }}:
                        </label>
                        <div>
                            <textarea rows="8" cols="50" class="form-control input-lg" id="tekstClanka" name="tekstClanka" ></textarea>
                        </div>
                        <br>
                            <label for="file">
                                {{ AdminOptions::lang(267, Session::get('jezik.AdminOptions::server()')) }}
                            </label>
                            <input type="file" id="file" name="file" value="">
                        <br>
                        <button type="reset" style="color:#fff" class="btn btn-danger">
                            {{ Form::label('Reset') }}
                        </button>
                        <input type="hidden" name="korisnik" id="korisnik" value="{{ Session::get('user_id') }}">
                    </div>
                </div>           
                <div class="modal-footer">
                    <button id="submit_button" class="btn btn-danger confirm-btn" style="color:#000";>{{ AdminOptions::lang(47, Session::get('jezik.AdminOptions::server()')) }}</button>            
                </div>         
            </div>
        </div>
    </div>
    <script type="text/javascript"> 
        $(document).ready(function(){
            $(window).on('load', function(){
                $('#CreateForm').modal('show');
            }); 

            $('#submit_button').click(function(){
                var formData = new FormData();
                if ('file') {
                    formData.append('file', $('#file')[0].files[0]);
                }
                formData.append('naslovClanka', $('#naslovClanka').val());
                formData.append('tekstClanka', $('#tekstClanka').val());
                formData.append('korisnik', $('#korisnik').val());

                $.ajax({
                    url: '/create-article-ajax',
                    type: 'post',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function (response) {
                        location.href = '/admin-welcome';
                    }
                });
            });
        });   
    </script>	
</div>
