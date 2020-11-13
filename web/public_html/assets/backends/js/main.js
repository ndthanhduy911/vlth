(function () {
	"use strict";

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function (event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function (event) {
		event.preventDefault();
		if (!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

	$('.select2-basic').select2();

	if ($('#editor1').length) {
		initSample1();
	}

	if ($('#editor2').length) {
		initSample2();
	}

	$('.date-basic').datetimepicker({
		format: "DD/MM/YYYY",
	});

	$('.time-basic').datetimepicker({
		format: "HH:mm",
	});

	$('.year-basic').datetimepicker({
		format: "YYYY",
	});

	$('.datetime-basic').datetimepicker({
		format: 'DD/MM/YYYY HH:mm',
	});
})();