import { initMetaBoxes } from './meta-boxes/index.js'

jQuery(() => {
  let d = document

  /**
   * On the edit post page of learndash groups
   */
  if (d.getElementById('ttge-metabox-file-picture')) {
    initMetaBoxes()
  }
})
