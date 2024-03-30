# PASOS LIMPIEZA STAGING

1. Desactivar y eliminar plugin multilanguage

- Elminar tablas Multilanguage:
  \_wp_142437618_mltlngg_custom_fields
  \_wp_142437618_mltlngg_elementor_dependencies
  \_wp_142437618_mltlngg_post_slugs
  \_wp_142437618_mltlngg_strings_translate
  \_wp_142437618_mltlngg_terms_translate
  \_wp_142437618_mltlngg_translate
  \_wp_142437618_mltlngg_yoast_meta_descriptions

2. Eliminar ACF fields y groups desde el admin:

Los fields estan guardados en la tabla wp-posts ("acf-field-group" y "acf-field")

- Author (group) - group_619de94692b94

  - position ✅
  - phrase_english ✅
  - phrase_spanish ✅
  - phrase_portuguese ✅

- Categories (group) - group_618d811376166 ->

  - category_color ✅
  - category_background_color ✅
  - category_icon ✅
  - category_icon_mobile ✅
  - category_header ✅
  - category_image (?) ✅

- Post (group) - group_618eaaf63acdd
  - ocultar_imagen_destacada ✅
  - sticky_main ✅
  - destacado ✅
  - mega_destacado ✅

3. Cambiar de tema (pasarnos al wp-content nuevo)

- Arreglar "JetPack's Photon module breaks features built in WP Retina 2x (as Photos moves the files away). A common and better alternative to Photon is to use MaxCDN (very popular), CloudFlare or Fastly."
