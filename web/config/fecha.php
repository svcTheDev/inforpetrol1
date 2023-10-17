<?php
//defined( 'CLAVELOAD' ) or die( 'Operacion no permitida.' );
?>
<?php
// El nombre para ste archivo es fecha.php
// Para el idioma Espanol, los dias de la semana
function dia_semana($dia) {
   switch ($dia) {
    case 0: $valor="Domingo"; break;
    case 1: $valor="Lunes"; break;
    case 2: $valor="Martes"; break;
    case 3: $valor="Mi&eacute;rcoles"; break;
    case 4: $valor="Jueves"; break;
    case 5: $valor="Viernes"; break;
    case 6: $valor="S&aacute;bado"; break;
   }
 return($valor);
}

// Para el idioma Espanol, los dias de la semana
function dia_nombre($dian) {
   switch ($dian) {
    case "Sunday": $valor="Domingo"; break;
    case "Monday": $valor="Lunes"; break;
    case "Tuesday": $valor="Martes"; break;
    case "Wednesday": $valor="Mi&eacute;rcoles"; break;
    case "Thursday": $valor="Jueves"; break;
    case "Friday": $valor="Viernes"; break;
    case "Saturday": $valor="S&aacute;bado"; break;
   }
 return($valor);
}

// Para el idioma Espanol, los meses del ano
function mes_ano($mes) {
   switch ($mes) {
    case "January": $valor="Enero"; break;
    case "February": $valor="Febrero"; break;
    case "March": $valor="Marzo"; break;
    case "April": $valor="Abril"; break;
    case "May": $valor="Mayo"; break;
    case "June": $valor="Junio"; break;
    case "July": $valor="Julio"; break;
    case "August": $valor="Agosto"; break;
    case "September": $valor="Septiembre"; break;
    case "October": $valor="Octubre"; break;
    case "November": $valor="Noviembre"; break;
    case "December": $valor="Diciembre"; break;
   }
 return($valor);
}
?>