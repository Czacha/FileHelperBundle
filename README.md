File Helper Bundle
========================

Przykładowa konfiguracja
--------------

```
ow_file_helper:
    upload_root_dir: var/uploads
    channels:
        - name: simple_image
          target_dir: images
          save_original_filename: true
```

Definiowanie helpera
--------------

```
## Simple Image Helper
OW\FileHelperBundle\Helper\SimpleImageHelper:
    tags:
        - { name: 'file_helper.simple_image' }
```