    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
	<script>
		$(document).ready( function () {
        $('#debtorsTable').DataTable({
            language: {
                  searchPlaceholder: "Search Debtors"                  
             },
             dom: 'Bfrtip',
            buttons: [                
                {
                    extend: 'copy',
                    footer: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },            
                {
                    extend: 'print',
                    footer: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'csv',
                    footer: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'excel',
                    footer: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    footer: true,
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                
            ],
           
        }); //dataTable
        $(".buttons-copy").html("<li class='fa fa-copy blue-text'></li> <span class='blue-text'>Copy</span>")
        $(".buttons-csv").html("<li class='fa fa-file-o blue-text'></li> <span class='blue-text'>CSV</span>")
        $(".buttons-excel").html("<li class='fa fa-file-excel-o blue-text'></li> <span class='blue-text'>Excel</span>")
        $(".buttons-pdf").html("<li class='fa fa-file-pdf-o blue-text'></li> <span class='blue-text'>PDF</span>")
        $(".buttons-print").html("<li class='fa fa-print blue-text'></li> <span class='blue-text'>Print</span>")
    });

	</script>