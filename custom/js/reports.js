$(document).ready(function() {

    $('#navReports').addClass('active');

	$("#getOrderReportForm").unbind('submit').bind('submit', function() {
		
		var startDate = $("#startDate").val();
		var endDate = $("#endDate").val();

		if (startDate == "" || endDate == "") {
			if (startDate == "") {
				$("#startDate").closest('.form-group').addClass('has-error');
				$("#startDate").after('<p class="text-danger">Start Date is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}

			if (endDate == "") {
				$("#endDate").closest('.form-group').addClass('has-error');
				$("#endDate").after('<p class="text-danger">End Date is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}
		} else {
			$(".form-group").removeClass('has-error');
			$(".text-danger").remove();

			var form = $(this);

			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'text',
				success:function(response) {
					var mywindow = window.open('', 'Sales Management System', 'height=400,width=600');
	        mywindow.document.write('<html><head><title>Orders Report</title>');
			mywindow.document.write('<style>\n' +
				'body {\n' +
				'    font-family: arial, sans-serif;\n' +
				'    width: 98%;\n' +
				'}\n' +
				'\n' +
				'.table td, .table th {\n' +
				'    border: 1px solid #cccccc;\n' +
				'    text-align: center;\n' +
				'    padding: 4px 0;\n' +
				'}\n' +
				'\n' +
				'</style>');
	        mywindow.document.write('</head><body>');
	        mywindow.document.write(response);
	        mywindow.document.write('</body></html>');

	        mywindow.document.close(); // necessary for IE >= 10
	        mywindow.focus(); // necessary for IE >= 10

	        mywindow.print();
	        mywindow.close();
				} // /success
			});	// /ajax

		} // /else

		return false;
	});

});