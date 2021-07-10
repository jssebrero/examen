<a>Este es un examen de la empresa Realhost, cuyo unico fin es realizar una prueba sobre mis conocimientos en PHP.</a><br>

Se me solicito:
- Generar par de llaves
- Encriptar cadena y desencriptar cadena

Para esto lo primero fue revisar las rutas existentes en el proyecto para conocerlas y  manejarlas.
Una vez encontradas, revise el archivo PrototypeController.php porque note que apuntaban a la clase PrototypeController y cada ruta a los métodos correspondintes,
una vez hecho esto empece a leer el codigo para mejorar la comprensión de lo que se solicitaba.

Para validar los campos use la funcion Validator de Laravel, y mostre mensajes flash, tome el campo method (que debia tener como  valor sha512 pero tenía sha511 solo lo corregi) lo envie como parametro y para generar el par de llaves utilice la función openssl_pkey_new(); y el atributo Config_SSL al que le asigne el method del campo, una vez generadas, las guarde en los atributos Key y keyPublic respectivamente para facilitar su reutilizacion dentro de la clase.

Cuando fueron generadas ambas claves y siguiendo la logica que se usa en https utilizaría la clave pública para encriptar la cadena de texto, pensando en el usuario final, para que a este se le facilitara el uso del sistema, cree variables de session que permitieran utilizar la clave de cifrado por 1 minuto, después de ello se debería generar de nuevo las llaves esto por seguridad,con la variable de session key la utilice para evitar que el usuario la escribiera esto para ahorrar el tiempo que este debería invertir en el uso del sistema.

Para encriptar la cadena de texto, realizando investigaciones por internet utilice openssl_encrypt(); porque me permitia encriptar con AES-128 que era como se me pedia, utilice la misma clave publica para encriptar, con esto guarde el resutado en otra variable de session para que el usuario tampoco tuviera que excribir la cadena cifrada ni la clave solo descifrar y listo.

Para desencriptar utilice openssl_decrypt(); con ello solo utilizaba la cadena encriptada y la clave con la que se encripto.

Como extras corregi sintaxis de metodos estaticos, utilice unas variables de session para mostras los resultados en áreas especificas de la pantalla, facilitando la comprension del usuario a lo que se estaba realizando, no utilice el metodo openssl_public_encrypt(); porque el resultado de la cadena encriptado no era de manera legible (comprobe esto en pruebas realizadas), por esto, como se estaba encriptando una cadena de texto y no una firma(de igual manera solo las certificadoras oficiales puedes hacerlo en la practica), preferi utilizar el metodo que use porque de igual forma se cumple lo solicitado y no se compromete la seguridad. Para facilitar las cosas defini unas constantes con valores que use para encriptar porque asi eran las especificaciones de las tareas (me refiero al metodo AES-128).


<br>
<br>
<br>
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
