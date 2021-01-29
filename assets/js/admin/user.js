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
			//ajax: base_url + "admin/user/ajaxList",

			// Load data for the table's content from an Ajax source
			ajax: {
					url: base_url + "admin/user/ajaxList",
					type: "POST"
			},
			"lengthMenu": [[5, 50, -1], [5, 50, "All"]],
			pageLength : 5,
			
			columns: [
				{data: 'Username'},
				{data: 'Email'},
				// {data: 'FirstName'},
				// {data: 'LastName'},
				// {data: 'CompanyName'},
				// {data: 'Country'},
				// {data: 'TownCity'},
				// {data: 'Address'},
				// {data: 'Zipcode'},
				// {data: 'VATNumber'},
				// {data: 'RegisterDate'},
				// {data: 'LastLogin'},
				// {data: 'Defunct'},
				// {data: 'Actions', responsivePriority: -1},
			],
			
			columnDefs: [

				{
					targets: -1,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'Pending', 'class': 'kt-badge--brand'},
							2: {'title': 'Delivered', 'class': ' kt-badge--danger'},
							3: {'title': 'Canceled', 'class': ' kt-badge--primary'},
							4: {'title': 'Success', 'class': ' kt-badge--success'},
							5: {'title': 'Info', 'class': ' kt-badge--info'},
							6: {'title': 'Danger', 'class': ' kt-badge--danger'},
							7: {'title': 'Warning', 'class': ' kt-badge--warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="kt-badge ' + status[data].class + ' kt-badge--inline kt-badge--pill">' + status[data].title + '</span>';
					},
				},
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

function viewSampleData(p_id){
	$.ajax({
		type: 'POST',
		url: base_url + "admin/product/ajaxViewSample",
		data: {
			product_id : p_id
		},
		dataType: "json",
		success: function(resultData) { 
			$("#sample_view_modal_content").html(resultData);
			$("#sample_view_modal").modal();
		}
	});
}
