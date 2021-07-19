// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    order: [
      [0, 'desc']
      ],
  });
  $('#dataPelanggan').DataTable({
    order: [
      [0, 'asc']
      ],
  });
});
