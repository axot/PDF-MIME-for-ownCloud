function showPDF(dir, file){
        return OC.linkTo('files_pdfmime', 'ajax/viewer.php')+'?dir='+encodeURIComponent(dir).replace(/%2F/g, '/')+'&file='+encodeURIComponent(file.replace('&', '%26'));
}

$(document).ready(function() {
	if(OC.currentUser) {
		if(typeof FileActions!=='undefined'){
			var mime = 'application/pdf';
                        FileActions.register(mime,'View', OC.PERMISSION_READ, '',function(filename){
                                window.location=showPDF($('#dir').val(), filename);
                        });

			FileActions.setDefault(mime,'View');
		}
	}
});

