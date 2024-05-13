<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## DESCRIPCION DEL SISTEMA

En la primera parte del sistema, al iniciar sesión, se despliega la pantalla de inicio de sesión donde los clientes pueden crear una cuenta. Al hacer clic en "crear una cuenta", se presenta un formulario que los clientes deben completar para registrar su cuenta. Este formulario incluye una función de búsqueda de números de documentos utilizando una API externa para verificar la identidad del cliente.

En el segundo paso, una vez que el cliente ha ingresado al sistema, se le muestran opciones para registrar una comunicación a través de canales específicos como WhatsApp, Telegram o Messenger. En esta sección, se proporcionan campos para que el cliente escriba su mensaje y otros datos necesarios.

El tercer paso involucra un módulo para registrar asesores de ventas. Estos asesores son responsables de responder a los mensajes de comunicación de los clientes a través de un formulario dedicado. Una vez que el asesor ha respondido al cliente, se mostrará un botón en la tabla de comunicaciones que permitirá al cliente cargar la información necesaria para realizar la recarga de pagos.

Además, el sistema cuenta con un módulo de cliente donde los clientes pueden ver su información personal y los montos asociados a su cuenta. También se presenta un módulo de recargas que muestra todas las recargas realizadas por los clientes, con la opción de actualizar la información de cada recarga.


En el modelo de clientes, al ingresar al sistema, solo se presenta la información personal del cliente que ha iniciado sesión. Esto incluye detalles como su nombre, saldo disponible y cualquier otra información relevante relacionada con su cuenta. Este enfoque garantiza la privacidad y la seguridad de los datos del cliente, limitando el acceso solo a la información que le concierne directamente.

Por otro lado, cuando un asesor de ventas inicia sesión en el sistema, se le muestra una vista más amplia que incluye la información de todos los clientes. Esto permite que el asesor acceda a los detalles de cada cliente, como sus historiales de transacciones, saldos actuales y comunicaciones previas. Esta visión holística permite que los asesores de ventas brinden un servicio más completo y personalizado a los clientes, al tiempo que les proporciona una comprensión completa de la base de clientes en general.

Por último, se ha implementado un módulo de inicio de sesión utilizando JSON Web Tokens (JWT) para garantizar la seguridad y autenticación de los usuarios en el sistema.

## Tecnologias
* **Laravel 8**
* **Angular 16**
* **MYSQL**
* **JWT**
## Modelo de base de datos
### Modelo ([Descargar](https://drive.google.com/file/d/1BwSELp9V6lQOOHabfoROhFnWoIYX_YM6/view))

## Arquitecturas y marcos Empleadas
* **Hexagonal**
* * **INJECCION DE DEPENDENCIAS**
* **SOLID**
### Desc

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
