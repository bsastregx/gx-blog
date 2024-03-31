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

# TAREAS PENDIENTES

- Arreglar "JetPack's Photon module breaks features built in WP Retina 2x (as Photos moves the files away). A common and better alternative to Photon is to use MaxCDN (very popular), CloudFlare or Fastly."

- Averiguar si sirve tener "Gutenberg", ya que esta desactivado, y aún así puedo editar los posts con el editor de bloques.

- Layout grid (se puede borrar?)

- WordPress.com Editing Toolkit (Se puede borrar?)

# PASOS WPML

0. Instalar y activar OTGS Installer, luego:

- WPML Multilingual CMS
- String Translation
- WPML SEO (Yoast)

1. Elegir "English" como default language, luego spanish y portuguese como secundarios.

2. **URL Format**:
   Seleccionar el primero "Different languages in directories"

3. **Translation Mode**:

   - Elegir "Translate what you choose"
   - Elegir luego "Users of this site" y asignar a los traductores.

---

## Siguientes pasos con WPML:

1. WPML → Languages. (aca se puede configurar el language switcher, que debe aparecer al menos en el header)

2. Activar "Category Translation" para la traduicción de las categorías:
   /wp-admin/admin.php?page=sitepress-multilingual-cms%2Fmenu%2Ftaxonomy-translation.php&taxonomy=category y traducir slugs y titulos de categorias.

3. En WPML > Settings > Translation Editor :
   Las traducciones deben hacerse con el traductor clasico.

4. En WPML > Settings > Custom Term Meta Translation:

   Los custom fields de las categorias (color, bg-color, header image etc) deben tomar los valores del idioma original (ingles). Para eso setear todos en: ¨Don't translate¨

5. En WPML > Settings > Media Translation:
   Chequear "Duplicate the featured images for translated content"

- Recuperar tags:
  Artificial Intelligence
  Digital Transformation
