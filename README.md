## BraintlyViajes

Consideraciones que se tomaron.

1. En el módulo "Ver todos los vuelos disponibles" se listarán los próximos vuelos programados que se solicitan en la 
documentación recibida. En dicho módulo se pueden realizar reservas visualizando el precio por tipo de asiento y la
cantidad de asientos disponibles por cada uno.
2. Al momento de reservar un vuelo se agrega el nombre, apellido y mail de contact. En este caso (según la 
documentación recibida) no se realiza un login. Por lo tanto, en el apartado "Vuelos reservados" se listarán
todas las reservas realizadas en el sistema, no se distingue por persona a la que se realiza la reserva. Queda claro
que la forma correcta es mediante un login que habilite dicho apartado y liste las reservas que realizó el usaurio.
3. En "Vuelos reservados" sólo se listan las reservas de los vuelos que tengan el estado "scheduled" y que la fecha
"departure_date" sea mayor al día de hoy.
4. Dado que el precio del vuelo depende de la cantidad de asientos disponibles, en ocasiones puede que el importe 
de una reserva sea distinto al mostrado. Si se tienen 2 ventanas abiertas con la misma pantalla de confirmación 
de reserva, se realizan N reservas en una mientras se mantiene la otra sin actualizar. Cuando se quiere realizar
la reserva en la segunda ventana el importe sería otro, y esto se produce ya que en dicho lapso se realizaron
varias reservas para el mismo vuelo.
5. Las reservas canceladas no se muestran en el listado de reservas. En la tabla de cancelaciones se guarda
el importe devuelto.
6. Las reservas de vuelos donde la fecha "departure_date" sea inferior al día de hoy no se muestran en el 
listado de reservas.
7. Se considera que el cambio de estado de los vuelos es realizado por algún proceso externo que lo realiza.
8. Se asume que cada reserva corresponde a un asiento de alguno de los tipos de asientos que brinda el avión en cuestión.