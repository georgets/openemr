
$(function() {
	var print_func= function() {
//		var pdf = new jsPDF('p', 'pt', 'a4');
//		pdf.fromHTML($('#content')[0], 15, 15, {
//			'width' : 170
//		});
//		pdf.save('Test.pdf');
		var printContents = document.getElementById('content').innerHTML;
	    var originalContents = document.body.innerHTML;

	     document.body.innerHTML = printContents;

	     window.print();

	     document.body.innerHTML = originalContents;
	     $("#print_link").click(print_func);
	}
	$("#print_link").click(print_func);

});
