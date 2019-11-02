<!doctype html>
<html lang="en">
<head>
   @include('partials/header2')
   <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <script src="sweetalert2.all.min.js"></script>
    Optional: include a polyfill for ES6 Promises for IE11 and Android browser
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script> -->
    <style type="text/css">
      .row {
        margin-right: -20%;
        margin-left: -20%;/*
        margin-top: 30px;*/
      }
    </style>
</head>
<body>
  @if (Session::has('success'))   
    <script src="{{ AdminOptions::base_url()}}js/bootbox/bootbox.js" type="text/javascript"></script> 
    <script type="text/javascript">
      bootbox.alert("<?php echo Session::get('success'); ?>");
    </script> 
    <?php Session::forget('success') ?>             
  @endif 
<div class="wrapper">
  <!-- <div class="logo-container full-screen-table-demo">
    <div class="logo">
      <img src="images/Logo.png">
    </div>
  </div> -->
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="fresh-table full-color-orange">
          <div class="toolbar">
              <button id="alertBtn" class="btn btn-default">{{ AdminOptions::lang(33, Session::get('jezik.AdminOptions::server()')) }}</button>
          </div>
          <table id="fresh-table" class="table" style="table-layout: fixed; width: 100%;">            
              @if($pom == 3)
                @include('tabelaStavka')
              @elseif($pom == 4)
                @include('tabelaRadnik')
              @elseif($pom == 6)
                @include('tabelaKupac')
              @elseif($pom == 7)
                @include('tabelaGrupa')
              @elseif($pom == 8)
                @include('tabelaProizvod')
              @endif
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  if (!empty($data) && ($pom == 3)) {?>
    <script type="text/javascript">
      $(window).load(function(){
          $('#azuriranjeStavki').modal('show');
      });
    </script>
  <div id="azuriranjeStavki" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    @include('modals/azuriranjeStavki')
  </div>
<?php }
  if (!empty($data) && ($pom == 4)) {?>
    <script type="text/javascript">
      $(window).load(function(){
          $('#azuriranjeRadnika').modal('show');
      });
    </script>
  <div id="azuriranjeRadnika" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    @include('modals/azuriranje')
  </div>
<?php }
  if (!empty($data) && ($pom == 6)) {?>
    <script type="text/javascript">
      $(window).load(function(){
          $('#azuriranjeKupac').modal('show');
      });
    </script>
  <div id="azuriranjeKupac" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    @include('modals/azuriranjeKupac')
  </div>  
<?php
    }
    if (!empty($data) && ($pom == 7)) {?>
    <script type="text/javascript">
      $(window).load(function(){
          $('#azuriranjeGrupa').modal('show');
      });
    </script>
  <div id="azuriranjeGrupa" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    @include('modals/azuriranjeGrupa')
  </div>  
<?php
    }
    if (!empty($data) && ($pom == 8)) {?>
    <script type="text/javascript">
      $(window).load(function(){
          $('#azuriranjeProizvod').modal('show');
      });
    </script>
  <div id="azuriranjeProizvod" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    @include('modals/azuriranjeProizvod')
  </div>  
<?php
    }
?>
    <script type="text/javascript">
        var $table = $('#fresh-table'),
            $alertBtn = $('#alertBtn'),
            full_screen = false;

      $().ready(function(){
          $table.bootstrapTable({
              toolbar: ".toolbar",

              showRefresh: true,
              search: true,
              showToggle: true,
              showColumns: true,
              pagination: true,
              striped: true,
              pageSize: 8,
              pageList: [8,10,25,50,100],

              formatShowingRows: function(pageFrom, pageTo, totalRows){
                  //do nothing here, we don't want to show the text "showing x of y from..."
              },
              formatRecordsPerPage: function(pageNumber){
                  return pageNumber + " rows visible";
              },
              icons: {
                  refresh: 'fa fa-refresh',
                  toggle: 'fa fa-th-list',
                  columns: 'fa fa-columns',
                  detailOpen: 'fa fa-plus-circle',
                  detailClose: 'fa fa-minus-circle'
              }
          });

          $(window).resize(function () {
              $table.bootstrapTable('resetView');
          });

          window.operateEvents = {
              'click .like': function (e, value, row, index) {
                  alert('You click like icon, row: ' + JSON.stringify(row));
                  console.log(value, row, index);
              },
              'click .edit': function (e, value, row, index) {
                  alert('You click edit icon, row: ' + JSON.stringify(row));
                  console.log(value, row, index);
              },
              'click .remove': function (e, value, row, index) {
                  $table.bootstrapTable('remove', {
                      field: 'id',
                      values: [row.id]
                  });
              }
          };

          $alertBtn.click(function () {
              window.location.href = '/admin-welcome';
          });
        });


      function operateFormatter(value, row, index) {
          return [
              '<a rel="tooltip" title="{{ AdminOptions::lang(40, Session::get('jezik.AdminOptions::server()')) }}" class="table-action like" href="javascript:void(0)" title="like">',
                  '<i class="fa fa-heart"></i>',
              '</a>',
              '<a rel="tooltip" title="{{ AdminOptions::lang(25, Session::get('jezik.AdminOptions::server()')) }}" class="table-action edit" href="javascript:void(0)" title="edit">',
                  '<i class="fa fa-edit"></i>',
              '</a>',
              '<a rel="tooltip" title="{{ AdminOptions::lang(21, Session::get('jezik.AdminOptions::server()')) }}" class="table-action remove" href="javascript:void(0)" title="remove">',
                  '<i class="fa fa-remove"></i>',
              '</a>'
          ].join('');
      }


      $('#sharrreTitle').sharrre({
            share: {
            twitter: true,
            facebook: true,
            googlePlus: true
            },
            template: "",
            enableHover: false,
            enableTracking: true,
            render: function(api, options){

            $("#sharrreTitle").html('Thank you for ' + options.total + ' shares!');
            },
            enableTracking: true,
            url: 'http://demos.creative-tim.com/table'
        });

        $('#twitter').sharrre({
          share: {
            twitter: true
          },
          enableHover: false,
          enableTracking: true,
          buttons: { twitter: {via: 'CreativeTim'}},
          click: function(api, options){
            api.simulateClick();
            api.openPopup('twitter');
          },
          template: '<i class="fa fa-twitter"></i> {total}',
          url: 'http://demos.creative-tim.com/table'
        });

        $('#facebook').sharrre({
          share: {
            facebook: true
          },
          enableHover: false,
          enableTracking: true,
          click: function(api, options){
            api.simulateClick();
            api.openPopup('facebook');
          },
          template: '<i class="fa fa-facebook-square"></i> {total}',
          url: 'http://demos.creative-tim.com/table'
        });
    </script>
</body>
</html>
