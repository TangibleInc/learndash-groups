export const initMetaBoxes = () => {

  let d = document

  const groupPicture = d.getElementById('ttlg-metabox-file-picture')
  const groupBanner = d.getElementById('ttlg-metabox-file-banner')
  
  const removePicture = d.getElementById('ttlg-remove-file-picture')
  const removeBanner = d.getElementById('ttlg-remove-file-banner')

  /**
   * Show the picture/banner dynamically
   */
  groupPicture.addEventListener('change', () => {
    removePicture.getElementsByTagName('input')[0].checked = false
    previewImgFile(groupPicture, d.getElementById('ttlg-metabox-picture'), true)
    removePicture.style.display = ''
  })

  groupBanner.addEventListener('change', () => {
    removeBanner.getElementsByTagName('input')[0].checked = false
    previewImgFile(groupBanner, d.getElementById('ttlg-metabox-banner'), true)
    removeBanner.style.display = ''
  })

  /**
   * Delete current picture
   */
  removePicture.addEventListener('click', () => {
    groupPicture.value = ''
    d.getElementById('ttlg-metabox-picture').style = ''
    removePicture.getElementsByTagName('input')[0].checked = true
    removePicture.style.display = 'none'
  })

  removeBanner.addEventListener('click', () => {
    groupBanner.value = ''
    d.getElementById('ttlg-metabox-banner').style = ''
    removeBanner.getElementsByTagName('input')[0].checked = true
    removeBanner.style.display = 'none'
  })
}

const previewImgFile = (input, image, background = false) => {
  
  let $ = jQuery
  let ext = input.files[0]['name']
    .substring(input.files[0]['name'].lastIndexOf('.') + 1)
    .toLowerCase()

  if (
    input.files &&
    input.files[0] &&
    (ext == 'gif' || ext == 'png' || ext == 'jpeg' || ext == 'jpg')
  ) {
    let reader = new FileReader()
    reader.onload = function(e) {
      if (background === true) {
        $(image).attr('style', `background-image: url('${e.target.result}')`)
      } else {
        $(image).attr('src', e.target.result)
      }
    }

    reader.readAsDataURL(input.files[0])
  }
}
