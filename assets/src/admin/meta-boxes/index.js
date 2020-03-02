export const initMetaBoxes = () => {

  let d = document

  const groupPicture  = d.getElementById('ttlg-metabox-file-picture')
  const groupBanner   = d.getElementById('ttlg-metabox-file-banner')

  // Show the picture to upload if the user add any
  groupPicture.addEventListener('change', () => {
    previewImgFile(groupPicture, d.getElementById("ttlg-metabox-picture"), true)
  })

  // Show the banner to upload if the user add any
  groupBanner.addEventListener('change', () => {
    previewImgFile(groupBanner, d.getElementById("ttlg-metabox-banner"), true)
  })
}

const previewImgFile = (input, image, background = false) => {

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
