# === T3v Illuminate Configuration ===

plugin {
  tx_t3villuminate {
    persistence {
      enableAutomaticCacheClearing = 1

      updateReferenceIndex = 1

      # storagePid = {$plugin.tx_t3villuminate.persistence.storagePid}
    }

    view {
      layoutRootPath = {$plugin.tx_t3villuminate.view.layoutRootPath}

      templateRootPath = {$plugin.tx_t3villuminate.view.templateRootPath}

      partialRootPath = {$plugin.tx_t3villuminate.view.partialRootPath}
    }

    settings {
      # ...
    }
  }
}