Si se encuentran con este problema para enviar el correo de la suscripción:
“cURL error 60: SSL certificate problem: unable to get local issuer certificate“
Deben hacer lo siguiente:
1.-Descargar un certificado digital para curl de esta dirección: https://curl.haxx.se/ca/cacert.pem
2.-Lo guardan en la carpeta C:\xampp\php\extras\ssl con el nombre cacert.pem (Aunque creo que podemos guardarlo en cualquier lugar)
3.-Luego añadir al archivo php.ini (C:\xampp\php\php.ini) el siguiente código:
[curl]
curl.cainfo = C:\xampp\php\extras\ssl\cacert.pem
4.-Reiniciar el servidor, y ya debería funcionar.
