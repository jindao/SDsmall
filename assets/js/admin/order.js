"use strict";
var KTDatatablesDataSourceAjaxServer = function() {
	
	var initTable1 = function() {
		var table = $('#kt_table_1');

		// begin first table
		table.DataTable({
			responsive: true,
			searchDelay: 500,
			processing: true,
			serverSide: true,
			paging: true,
			"paging": true,
			"pageLength" : 10,
			"lengthChange": true, 
			"searching": true,
			"info": false,
			"autoWidth": true,
			// "ordering": false,
			"stateSave": true,

			// Load data for the table's content from an Ajax source
			ajax: {
					url: base_url + "admin/order/ajaxList",
					type: "POST"
			},
			"lengthMenu": [[5, 50, -1], [5, 50, "All"]],
			pageLength : 5,
			
			columns: [
				{data: 'Username'},
				{data: 'Product'},
				{data: 'PaidAmount'},
				{data: 'PaymentType'},
				{data: 'Processed'},
				{data: 'Confirmed'},
				{data: 'Created'},
			],
			
			columnDefs: [

			],
			
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();
jQuery(document).ready(function() {
    KTDatatablesDataSourceAjaxServer.init();
});
