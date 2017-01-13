# === T3v Illuminate Constants ===

plugin {
  tx_t3villuminate {
    persistence {
      # cat=plugin/tx_t3villuminate/persistence; type=int+; label=The PID of the storage
      # storagePid = 0
    }

    view {
      # cat=plugin/tx_t3villuminate/view; type=string; label=Path to layouts
      layoutRootPath = EXT:t3v_illuminate/Resources/Private/Layouts/

      # cat=plugin/tx_t3villuminate/view; type=string; label=Path to templates
      templateRootPath = EXT:t3v_illuminate/Resources/Private/Templates/

      # cat=plugin/tx_t3villuminate/view; type=string; label=Path to template partials
      partialRootPath = EXT:t3v_illuminate/Resources/Private/Partials/
    }

    settings {
      # ...
    }
  }
}