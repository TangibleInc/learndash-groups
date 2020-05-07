import { initPluginSettingsMetaboxes } from './settings/index.js'

jQuery(() => {
  
  let d = document

  /**
   * On the plugins settings and learndash groups metaboxes
   */
  if ( d.getElementById('ttge-default-group-images') || d.getElementById('ttge-group-images') ) {
    initPluginSettingsMetaboxes()
  }

})
