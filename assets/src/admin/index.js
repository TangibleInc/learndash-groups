import { initMetaBoxes } from './meta-boxes/index.js'
import { initPluginSettings } from './settings/index.js'

jQuery(() => {
  
  let d = document

  /**
   * On the edit post page of learndash groups
   */
  if (d.getElementById('ttge-metabox-file-picture')) {
    initMetaBoxes()
  }

  /**
   * On the plugins settings
   */
  if (d.getElementById('ttge-default-group-images')) {
    initPluginSettings()
  }

})
