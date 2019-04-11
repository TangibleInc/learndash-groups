jQuery(function() {

	if(document.getElementById('ttsg_metabox-file-picture')) {
		
		let d = document

		const groupPicture 	= d.getElementById('ttsg_metabox-file-picture')
		const groupBanner 	= d.getElementById('ttsg_metabox-file-banner')

		// Show the picture to upload if the user add any
		groupPicture.addEventListener('change', () => {
			previewImgFile(groupPicture, d.getElementById("ttsg_metabox-picture"), true)
		})

		// Show the banner to upload if the user add any
		groupBanner.addEventListener('change', () => {
			previewImgFile(groupBanner, d.getElementById("ttsg_metabox-banner"), true)
		})

		let previewImgFile = (input, image, background = false) => {
	 	
		 	let $ = jQuery;
		 	let ext = input.files[0]['name'].substring(input.files[0]['name'].lastIndexOf('.') + 1).toLowerCase();
			
			if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
			    
			    let reader = new FileReader();
			    reader.onload = function (e) {
			    	if(background === true) {
			        	$(image).attr('style', `background-image: url('${e.target.result}')`);
			    	}
			    	else{
			        	$(image).attr('src', e.target.result);
			    	}
			    }

			    reader.readAsDataURL(input.files[0]);
			}
		}
	}
})