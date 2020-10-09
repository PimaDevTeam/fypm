/*
	By Osvaldas Valutis, www.osvaldas.info
	Available for use under the MIT License
*/

'use strict';

;( function ( document, window, index )
{
	var inputs = document.querySelectorAll( '.inputfile' );
	var fupload = document.querySelector('.fupload');
	var fdoc = document.querySelector('.fdoc');
	// Showing image based on the extension of the image
	var docExtensionContainer = document.querySelector('.extension__container');
	var pdfExtensionImage = `<img src="/images/adobe-pdf-icon.svg" class="img-fluid ml-auto mr-auto mb-2 extension_img" alt="">`;
	var wordExtensionImage = `<img src="/images/microsoft-word-logo.svg" class="img-fluid ml-auto mr-auto mb-2 extension_img" alt="">`;
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName ) {
				label.querySelector( 'span' ).innerHTML = fileName;
				var splitName = fileName.split('.');
				var fileExtension = splitName[1];
				if(fileExtension == 'docx') {
					docExtensionContainer.innerHTML = wordExtensionImage;
				} else if(fileExtension == 'pdf') {
					docExtensionContainer.innerHTML = pdfExtensionImage;
				} 
				fupload.style.display = 'none';
				fdoc.classList.remove('d-none');
			}
			else
				label.innerHTML = labelVal;
		});

		// Firefox bug fix
		input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
		input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
	});
}( document, window, 0 ));