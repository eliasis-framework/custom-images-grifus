# Extensions For Grifus · Custom Images

[![Latest Stable Version](https://poser.pugx.org/eliasis-framework/custom-images-grifus/v/stable)](https://packagist.org/packages/eliasis-framework/custom-images-grifus)
[![License](https://poser.pugx.org/eliasis-framework/custom-images-grifus/license)](LICENSE)

[Versión en español](README-ES.md)

Custom Images Grifus reemplaza imágenes externas de IMDB y las guarda en tu sitio de WordPress.

![image](resources/banner-1544x500.png)

---

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Imágenes](#imagenes)
- [Tests](#tests)
- [Patrocinar](#patrocinar)
- [Licencia](#licencia)

---

## Requisitos

Este módulo es soportado por versiones de **PHP 5.6** o superiores y es compatible con versiones de **HHVM 3.0** o superiores.

## Instalación

Puedes instalar este plugin desde el [repositorio oficial](https://es.wordpress.org/plugins/extensions-for-grifus/) en WordPress.

O instalar este módulo en el plugin desde [Composer](http://getcomposer.org/download/). En la carpeta raíz del plugin Extensions For Grifus ejecuta:

    composer require eliasis-framework/custom-images-grifus

## Imágenes

![image](resources/screenshot-22.png)
![image](resources/screenshot-23.png)
![image](resources/screenshot-24.png)
![image](resources/screenshot-25.png)
![image](resources/screenshot-26.png)
![image](resources/screenshot-27.png)
![image](resources/screenshot-28.png)

## Tests

Para ejecutar las [pruebas](tests) necesitarás [Composer](http://getcomposer.org/download/) y seguir los siguientes pasos:

    git clone https://github.com/eliasis-framework/custom-images-grifus.git
    
    cd custom-images-grifus

    composer install

Ejecutar pruebas de estándares de código para [WordPress](https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/) con [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

    composer phpcs

Ejecutar pruebas con [PHP Mess Detector](https://phpmd.org/) para detectar inconsistencias en el estilo de codificación:

    composer phpmd

Ejecutar todas las pruebas anteriores:

    composer tests

[PHPUnit](https://phpunit.de/): Las pruebas unitarias para esta módulo serán realizadas en el repositorio del [plugin](https://github.com/Josantonius/extensions-for-grifus#tests).

## Patrocinar

Si este proyecto te ayuda a reducir el tiempo de desarrollo,
[puedes patrocinarme](https://github.com/josantonius/lang/es-ES/README.md#patrocinar)
para apoyar mi trabajo :blush:

## Licencia

Este repositorio tiene una licencia [GPL-2.0+ License](LICENSE).

Copyright © 2017-2022, [Josantonius](https://github.com/josantonius/lang/es-ES/README.md#contacto)
