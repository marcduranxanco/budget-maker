# Práctica final

Exceptuando los ejercicios 1, 7 y 12, todos los ejercicios se realizarán en este repositorio ya que forman parte del ejercicio práctico final. Las entregas parciales se realizarán en sus apartados correspondientes, copiando el enlace al repositorio, de tal forma que informe al profesor que esa parte está realizada.

ESTE EJERCICIO PRÁCTICO NO ES OBLIGATORIO. Si no lo finalizas completo no supone ningún problema para pasar el curso.

## Enunciado de la práctica final

Supongamos que nuestra compañía se dedica a implantar servicios de Software para empresas (blogs, tiendas online, desarrollos a medida…).

En la página web actual de nuestra compañía se describen los servicios que ofrecemos y se ofrecen datos de contacto para contactar con el departamento comercial.

Se quiere mejorar la web para incluir un auto-presupuestador, en el que un visitante de la web y posible futuro cliente, pueda introducir en un formulario los servicios que necesita y ver un presupuesto aproximado. Evidentemente, esta solicitud de presupuesto recogerá algún dato de contacto del visitante para que el departamento comercial pueda ponerse en contacto con ellos.

Además, en el backend de nuestra web queremos introducir paneles de gestión de las solicitudes de presupuesto para los comerciales y de los proyectos (solicitudes de presupuesto convertidas en contratos) para los jefes de proyecto y empleados.

## Requisitos 

Los requisitos de nuestra Web/Aplicación son los siguientes:

### Parte pública de la web (REQ-PUB)

- REQ-PUB-01: A la parte pública de la web se accede sin identificación
- REQ-PUB-02: Estará disponible en español e inglés. Todas las páginas de la parte pública tendrán enlaces en la cabecera para cambiar de idioma. Un enlace que diga “Español” y otro que diga “English”. Como excepción, los textos de estos dos enlaces no se traducirán.
- REQ-PUB-03: Al darle al enlace “Español” descrito en REQ-PUB-02, todas las páginas de la parte pública de la web se mostrarán en español.
- REQ-PUB-04: Al darle al enlace “English” descrito en REQ-PUB-02, todas las páginas de la parte pública de la web se mostrarán en inglés.

Todos los textos indicados a partir de ahora en los requisitos de la parte pública (REQ-PUB-XXXXXX) deben estar traducidos al español y al inglés. No se valorará la calidad de las traducciones, pero sí se valorará que los textos estén traducidos. 

### Landing Page o LP (REQ-PUB-LP)

La página de bienvenida o Landing Page tendrá los siguientes elementos:

- REQ-PUB-LP-01: Una breve descripción general de los servicios que ofrece nuestra empresa (los textos, imágenes, colocación de elementos… a libertad vuestra).
- REQ-PUB-LP-02: Una sección bien visible con un texto que diga “Calcula tu presupuesto de forma gratuita y sin compromiso” y un botón en dicha sección que diga “Empezar”.
- REQ-PUB-LP-03: Un enlace o botón con el texto “Login” para ir a la página de login.

El comportamiento de la LP será el siguiente:

-REQ-PUB-LP-04: Al darle al botón de “Empezar” descrito en REQ-PUB-LP-02, se dirigirá al usuario a la página del presupuestador.
-vREQ-PUB-LP-05: Al darle al enlace o botón de login descrito en REQ-PUB-LP-03, se dirigirá al usuario a la página de login.

### Página de login (REQ-PUB-LOG)

El login será por email y contraseña. La página de login tendrá como mínimo los siguientes elementos:

- REQ-PUB-LOG-01: Caja para introducir el correo
- REQ-PUB-LOG-02: Caja para introducir la contraseña
- REQ-PUB-LOG-03: Botón con el texto “Entrar”

El comportamiento de la página de login será el siguiente:

- REQ-PUB-LOG-04: Al darle a Entrar, si la caja del correo está vacía, mostrará el mensaje “Debes indicar el correo”.
- REQ-PUB-LOG-05: Al darle a Entrar, si la caja del correo está vacía, mostrará el mensaje “Debes indicar la contraseña”.
- REQ-PUB-LOG-06: Al darle a Entrar, si los datos de identificación no son correctos mostrará el mensaje “Credenciales no válidas”.
- REQ-PUB-LOG-07: Al darle a Entrar, si los datos de identificación son correctos dirigirá al usuario a la página correspondiente según el rol del usuario".

- REQ-PUB-LOG-08: Si el usuario es un administrador, le dirigirá a la página del panel de control del administrador.
- REQ-PUB-LOG-09: Si el usuario es un comercial, le dirigirá a la página del panel de control del comercial
- REQ-PUB-LOG-10: Si el usuario es un jefe de proyecto, le dirigirá a la página del panel de control del jefe de proyecto
- REQ-PUB-LOG-11: Si el usuario es un empleado distinto a los enumerados en los requisitos anteriores, le dirigirá a la página del panel de control del empleado.

SE DEBEN PROGRAMAR TESTS DE TODOS LOS REQUISITOS REQ-PUB-LP y REQ-PUB-LOG.



### Página del presupuestador (REQ-PUB-PRESU)

La página del presupuestador permitirá a un visitante anónimo crear un presupuesto a medida.

Esta página pedirá al usuario que introduzca primero el tipo de aplicación a elegir entre:

- Aplicación Web
- Aplicación Móvil
- Aplicación de escritorio

Este listado será configurable a través del panel de administración.

Una vez elegido el tipo o tipos de aplicación (se puede elegir más de uno), el usuario tendrá que indicar las características de la aplicación, que serán distintas según el tipo de aplicación.

Por ejemplo, para una aplicación web, habrá que señalar si tiene blog, si tiene tienda online, si tiene usuarios registrados, cuantos idiomas tendrá, si tiene galería de imágenes, si tiene chat…

Para una aplicación móvil, habría que señalar si es para android, si es para ios, si tiene login, si está integrada con otra aplicación, si recibe/manda notificaciones…

Se pueden coger ideas de:

https://www.web-media.com.ar/presupuesto-online.html

https://www.cuantocuestamiapp.com/

Las características también serán configurables a través del panel de administración y estarán asociadas al tipo de aplicación (según el tipo de aplicación elegida, se podrán elegir unas características u otras).

Habrá un campo opcional adicional para rellenar Otras características a tener en cuenta.

Una vez indicados los tipos de aplicación deseados y las características deseadas, se deberá rellenar también una sección con los siguientes campos:

- Nombre (obligatorio)
- Email (obligatorio)
- Teléfono (obligatorio)

Y con todo esto se podrá enviar la solicitud de presupuesto haciendo click en un botón con el texto “Solicitar presupuesto”.

Al hacer click en dicho botón, aparecerá una pantalla indicando las características seleccionadas, el presupuesto aproximado, con un texto visible que advierta de que es orientativo y de que “un comercial se pondrá en contacto con usted en la mayor brevedad posible”.

También se enviará un correo al usuario con la misma información: características de la(s) aplicación(es), presupuesto aproximado y texto que deje claro que es un presupuesto orientativo.

También se enviará otro correo a todos los usuarios con rol “comercial” indicando los datos de contacto del solicitante, las características de la(s) aplicación(es) y el presupuesto orientativo.



### Cálculo del presupuesto:

Cada tipo de aplicación tendrá asociado un precio base. Por ejemplo, una aplicación móvil, aunque no tenga nada de nada, conlleva un trabajo de dar de alta y subir en las tiendas de Google y de Apple.

Cada característica tendrá asociada también un precio.

El presupuesto orientativo se calculará sumando los precios de las características elegidas al precio base del tipo de aplicación.



### Parte privada de la web

La parte privada de la web constara de 4 zonas diferenciadas:

- Panel del administrador (para usuarios con rol “administrador”)
- Panel del comercial (para usuarios con rol “comercial”)
- Panel del jefe de proyecto (para usuarios con rol “jefeproyecto”)
- Panel del técnico (para usuarios con rol “tecnico”)

Según el rol del usuario que haga login, el sistema le dirigirá a su panel correspondiente.

De la parte privada solamente será necesario que esté traducido el título (h1 y/o h2) de cada pantalla. El resto de contenido no se revisará si está traducido.



Panel del administrador

Permite la gestión estándar de usuarios, pudiendo asignar roles de “administrador”, “comercial”, “jefeproyecto” y “técnico” a cada usuario.
NOTA: Cuando se hable de gestión estándar nos referimos a alta, modificación, borrado y listado de los ítems correspondientes, es decir, un CRUD normal y corriente. 

 

Panel del comercial

Permite visualizar el listado de solicitudes de presupuesto, su estado, y todos sus datos asociados, modificar una solicitud de presupuesto, rechazar una solicitud de presupuesto y aprobar una solicitud de presupuesto.
No se podrán crear ni eliminar solicitudes desde el panel del comercial.

El estado de una solicitud podrá ser “pendiente”, “aprobada” o “rechazada”.

Una vez aprobada o rechazada una solicitud de presupuesto ya no se podrá modificar ni cambiar de estado.

Los estados de las solicitudes de presupuesto se deberán gestionar con el componente workflow.

Para aprobar una solicitud, se deberán rellenar dos datos extra: “presupuesto final” y “fecha de entrega”. Al aprobar una solicitud de presupuesto, se mandarán correos al solicitante y a los jefes de proyecto.

En el correo al solicitante se indicarán las características de la solicitud y el presupuesto final en vez del presupuesto inicial. También se añadirá en el correo un enlace. (Ver sección: panel del solicitante)

En el correo a los jefes de proyecto se indicarán las características de la solicitud con el presupuesto final y la fecha de entrega.

Una solicitud aprobada generará un proyecto.

Los comerciales podrán ver los datos de un proyecto, su estado y su grado de avance, pero no podrán realizar ninguna acción sobre ellos.

Los comerciales no tendrán un listado de proyectos. Accederán a los datos de un proyecto a través de la solicitud de presupuesto asociada. Una solicitud de presupuesto en estado aprobado, tendrá algún elemento (icono, enlace, botón) que permita ver los datos del proyecto. 

 

Panel del jefe de proyecto

- Permitirá acceder al listado de proyectos sin terminar y su grado de avance.
- Permitirá acceder al histórico de listado de proyectos
- Permitirá asociar técnicos a proyectos que no hayan terminado.
- Permitirá crear tareas en un proyecto.
- Permitirá asociar un técnico del proyecto a una tarea del proyecto.
- Permitirá cambiar el técnico que está asociado a una tarea.

NOTA: En una tarea solamente podrá haber un técnico. Un técnico puede estar asociado a varias tareas simultáneamente.

Los estados de un proyecto serán:

- aprobado
- enproceso
- terminado

Los estados de los proyectos se deben gestionar con el componente workflow.

Los estados de una tarea serán:

- sin asignar
- asignada
- terminada

Una tarea tendrá una descripción corta (obligatoria), una descripción larga (obligatoria) y un campo notas (opcional).

Los estados de las tareas se deben gestionar con el componente workflow.

El jefe de proyecto podrá cambiar el estado de un proyecto de aprobado a enproceso y de enproceso a terminado cuando lo estime oportuno.

El sistema mostrará un mensaje al jefe de proyecto en caso de que intente pasar un proyecto a terminado y en dicho proyecto todavía queden tareas sin terminar. En el mensaje pondrá algo similar a “No ha podido realizarse la acción porque quedan tareas por terminar”.

Al cambiar de estado el proyecto, se mandará correo al solicitante y a los técnicos asociados al proyecto informando en el correo del nuevo estado del proyecto.

Al asignar un técnico a una tarea, se enviará un correo al técnico con la información de la tarea asignada.

 

Panel del técnico

- Podrá visualizar los datos de un proyecto excepto los económicos (por ejemplo el presupuesto)
- Podrá visualizar la lista de tareas que se le han asignado
- Podrá marcar una tarea como terminada.
- Podrá visualizar el grado de avance de los proyectos en los que esté asignado.
- Al marcar una tarea como terminada, se enviará un correo a los jefes de proyecto.



Panel del solicitante (cliente)

Cuando una solicitud de presupuesto es aprobada, en el correo que se envía al cliente vendrá un enlace.

Esté enlace será único por proyecto (solicitud aprobada).

Al acceder a dicho enlace en cualquier momento, el cliente podrá ver los datos de su proyecto, la fecha de entrega prevista (la que introdujo el comercial al aprobar el proyecto) y el grado de avance del proyecto.

Para proteger la privacidad del proyecto, el enlace deberá tener alguna cadena tipo token:

Ejemplo de enlace: miempresa.com/proyectos/vri7gg5j6j4yb65945v3945

El sistema reconocería el proyecto concreto a través del identificador vri7gg5j6j4yb65945v3945.

Este token no tendrá caducidad.



Grado de avance de los proyectos

El grado de avance de los proyectos se calculará como el porcentaje de las tareas terminadas respecto al número total de tareas del proyecto.

 

### Perfil del usuario

Los usuarios registrados podrán visualizar y modificar los siguientes datos de su perfil:

Contraseña de acceso
Idioma preferido 
 

### Idiomas

Toda la parte pública debe ser bilingüe, con lo que los nombres de los tipos de proyecto y de las tareas, que están en base de datos, deberán también ser traducibles de alguna manera. De la parte privada solamente se pide que sea traducible el título (h1 o h2) de cada página.

En la parte pública el idioma se elige como se explica en REQ-PUB-02, REQ-PUB-03 y REQ-PUB-04. En la parte privada el idioma utilizado será el que el usuario tenga configurado en su perfil.

Los correos sí deben ser traducibles. Al solicitante se le enviará el correo en el idioma en el que hizo la solicitud. Al resto de usuarios se le enviarán los correos en el idioma que tenga configurado cada receptor del correo en su perfil.



### Otras consideraciones y recordatorios

Se puede utilizar cualquier bundle/componente que conozcáis aunque no se haya visto en el curso. No hay limitación con eso.

No es necesario hacer más de lo indicado en las especificaciones del proyecto.

No hay especificaciones de diseño gráfico/visual. Libertad total.

Las propiedades de objetos, campos de la base de datos y demás cosas que no estén definidas en las especificaciones se dejan a libertad de cada uno.

Al subir el zip con el proyecto recordad NO subir el fichero .env para evitar mandarme contraseñas de bases de datos y/o de cuentas de correo.

Si consideráis que se necesita “contradecir” algún requisito para poder realizar el proyecto (por ejemplo, consideráis que sobra o falta algún estado en el workflow), indicadlo razonadamente en el foro para que otros alumnos caigan también en la cuenta y/o puedan proponer más soluciones alternativas.
