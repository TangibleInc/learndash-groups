export const initMetaBoxes = () => {

  let d = document

  const groupPicture = d.getElementById('ttge-metabox-file-picture')
  const groupBanner = d.getElementById('ttge-metabox-file-banner')
  
  const removePicture = d.getElementById('ttge-remove-file-picture')
  const removeBanner = d.getElementById('ttge-remove-file-banner')

  /**
   * Show the picture/banner dynamically
   */
  groupPicture.addEventListener('change', () => {
    removePicture.getElementsByTagName('input')[0].checked = false
    previewImgFile(groupPicture, d.getElementById('ttge-metabox-picture'), true)
    removePicture.style.display = ''
  })

  groupBanner.addEventListener('change', () => {
    removeBanner.getElementsByTagName('input')[0].checked = false
    previewImgFile(groupBanner, d.getElementById('ttge-metabox-banner'), true)
    removeBanner.style.display = ''
  })

  /**
   * Delete current picture
   */
  removePicture.addEventListener('click', () => {
    groupPicture.value = ''
    d.getElementById('ttge-metabox-picture').style = ''
    removePicture.getElementsByTagName('input')[0].checked = true
    removePicture.style.display = 'none'
  })

  removeBanner.addEventListener('click', () => {
    groupBanner.value = ''
    d.getElementById('ttge-metabox-banner').style = ''
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
