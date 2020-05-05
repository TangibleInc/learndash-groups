export const initPluginSettings = () => {

  let $ = jQuery
  var file_frame;

  $('.ttlg-upload-file-image').on('click', function( event ){

    event.preventDefault()

    var $w = $(this).parents('.ttlg-image-preview-wrapper')

    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
      title: ImageUpload.media_modal_title,
      frame: 'select',
      library: {
        type: 'image'
      },
      button: {
        text: ImageUpload.media_modal_button,
      },
      multiple: false
    })

    // When an image selected - callback.
    file_frame.on( 'select', function() {

      var i = file_frame.state().get('selection').first()
      var fname = i.attributes.filename
      var ext = fname.substring(fname.lastIndexOf('.') + 1).toLowerCase()
      var attachment = i.toJSON();
      if (ext == 'gif' || ext == 'png' || ext == 'jpeg' || ext == 'jpg' ) {

        // Do something with attachment.id and attachment.url here
        $w.css('background-image', 'url("' + attachment.url + '")').css('background-size', 'cover')
        $w.find('.ttlg-settings-default').val(attachment.id)
        $w.find('.ttlg-remove-file-image').css('display', 'inline-block')
        $w.find('.ttlg-upload-file-image').css('display', 'none')
      }
    })

    // Open the modal
    file_frame.open()
  })

  // The 'Remove' button
  $('.ttlg-remove-file-image').click(function(event) {

    event.preventDefault()

    var answer = confirm(ImageUpload.remove_button_confirm)
    if (answer == true) {
      var $w = $(this).parents('.ttlg-image-preview-wrapper')
      $w.css('background-image', 'none')
      $w.find('.ttlg-settings-default').val('')
      $(this).css('display', 'none' )
      $w.find('.ttlg-upload-file-image').css('display', 'inline-block')
    }
    return false
  })
}
