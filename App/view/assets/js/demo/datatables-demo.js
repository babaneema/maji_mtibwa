// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable();
});

$(document).ready(function() {
  $('#data1').DataTable();
});


$(document).ready(function() {
  $('#print').DataTable( {
      dom: 'Bfrtip',
      buttons: [
          'print'
      ]
  } );
} );
