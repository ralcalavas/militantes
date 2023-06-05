
(function ($) {
	"use strict";

	jQuery(document).ready(function ($) {


		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_1').DataTable({
			'order': [
				[1, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});
		
		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_2').DataTable({
			'order': [
				[2, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});
		
		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_3').DataTable({
			'order': [
				[3, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});
		
		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_4').DataTable({
			'order': [
				[4, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});
		
		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_5').DataTable({
			'order': [
				[5, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});
		
		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_62').DataTable({
			'order': [
				[6, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});
		
		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_7').DataTable({
			'order': [
				[7, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});
		
		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_8').DataTable({
			'order': [
				[8, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});
		
		/* 
		=================================================================
		Datatables Example One JS
		=================================================================	
		*/
		$('#datatables_example_9').DataTable({
			'order': [
				[9, "desc"]
			],
			'paging': true,
			'pagingType': "numbers",
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});

		/* 
		=================================================================
		Responsiv Datatables Example JS
		=================================================================	
		*/

		$('#responsive_datatables_example').DataTable({
			'paging': true,
			'pagingType': "numbers",
			'responsive': true,
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});

		var table = $('#button_datatables_example').DataTable({

			'pagingType': "numbers",
			'lengthChange': false,
			'language': {
				searchPlaceholder: 'Search...',
				sSearch: ''
			}
		});

		new $.fn.dataTable.Buttons(table, {
			buttons: [{
					extend: "copy",
					className: "datatable-btn btn-sm"
				},
				{
					extend: "csv",
					className: "datatable-btn btn-sm"
				},
				{
					extend: "pdf",
					className: "datatable-btn btn-sm"
				},
				{
					extend: "print",
					className: "datatable-btn btn-sm"
				}
			]
		});

		table.buttons().container()
			.appendTo($('.col-sm-6:eq(0)', table.table().container()));


	});


}(jQuery));