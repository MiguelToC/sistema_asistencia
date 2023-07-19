<?php

if (!empty($_GET["txtfechainicio"]) and !empty($_GET["txtfechafinal"]) and !empty($_GET["txtempleado"])) {
   require('./fpdf.php');

   $fechainicio = $_GET["txtfechainicio"];
   $fechafinal = $_GET["txtfechafinal"];
   $empleado = $_GET["txtempleado"];


   class PDF extends FPDF
   {

      // Cabecera de página
      function Header()
      {
         include "../../modelo/conexion.php"; //llamamos a la conexion BD

         $consulta_info = $conexion->query(" SELECT * FROM empresa "); //traemos datos de la empresa desde BD

         //$dato_info = $consulta_info->fetch_object();
         $this->Image('icon.png', 175, 5, 30); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
         $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
         $this->Cell(45); // Movernos a la derecha
         $this->SetTextColor(0, 0, 0); //color
         //creamos una celda o fila



         while ($datos = $consulta_info->fetch_object()) {
            $this->Cell(110, 15, utf8_decode("$datos->nombre"), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
            $this->Ln(3); // Salto de línea
            $this->SetTextColor(103); //color
            /* UBICACION */
            $this->Cell(110);  // mover a la derecha
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(96, 10, utf8_decode("Ubicación : $datos->ubicacion"), 0, 0, '', 0);
            $this->Ln(5);

            /* TELEFONO */
            $this->Cell(110);  // mover a la derecha
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(59, 10, utf8_decode("Teléfono : $datos->telefono"), 0, 0, '', 0);
            $this->Ln(5);

            /* COREEO */
            $this->Cell(110);  // mover a la derecha
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(85, 10, utf8_decode("Correo : infinitylabs@contacto.com"), 0, 0, '', 0);
            $this->Ln(5);

            /* TELEFONO */
            $this->Cell(110);  // mover a la derecha
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(85, 10, utf8_decode("RUC : $datos->ruc"), 0, 0, '', 0);
            $this->Ln(10);
         }

         /* TITULO DE LA TABLA */
         //color
         $this->SetTextColor(0, 95, 189);
         $this->Cell(50); // mover a la derecha
         $this->SetFont('Arial', 'B', 15);
         $this->Cell(100, 10, utf8_decode("REPORTE DE ASISTENCIAS POR FECHAS"), 0, 1, 'C', 0);
         $this->Ln(7);

         /* CAMPOS DE LA TABLA */
         //color
         $this->SetFillColor(125, 173, 221); //colorFondo
         $this->SetTextColor(255, 255, 255); //colorTexto
         $this->SetDrawColor(163, 163, 163); //colorBorde
         $this->SetFont('Arial', 'B', 11);
         $this->Cell(9, 10, utf8_decode('ID'), 1, 0, 'C', 1);
         $this->Cell(40, 10, utf8_decode('EMPLEADO'), 1, 0, 'C', 1);
         $this->Cell(23, 10, utf8_decode('DNI'), 1, 0, 'C', 1);
         $this->Cell(25, 10, utf8_decode('CARGO'), 1, 0, 'C', 1);
         $this->Cell(36, 10, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
         $this->Cell(36, 10, utf8_decode('SALIDA'), 1, 0, 'C', 1);
         $this->Cell(20, 10, utf8_decode('HORAS'), 1, 1, 'C', 1);
      }

      // Pie de página
      function Footer()
      {
         $this->SetY(-15); // Posición: a 1,5 cm del final
         $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
         $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

         $this->SetY(-15); // Posición: a 1,5 cm del final
         $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
         $hoy = date('d/m/Y');
         $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
      }
   }

   //include '../../recursos/Recurso_conexion_bd.php';
   //require '../../funciones/CortarCadena.php';
   /* CONSULTA INFORMACION DEL HOSPEDAJE */
   //$consulta_info = $conexion->query(" select *from hotel ");
   //$dato_info = $consulta_info->fetch_object();
   include "../../modelo/conexion.php"; //llamamos a la conexion BD
   $pdf = new PDF();
   $pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
   $pdf->AliasNbPages(); //muestra la pagina / y total de paginas

   $i = 0;
   $pdf->SetFont('Arial', '', 9);
   $pdf->SetDrawColor(163, 163, 163); //colorBorde

   if ($empleado == "todos") {
      $sql = $conexion->query(" SELECT asistencia.id_asistencia,
      asistencia.id_empleado,
      DATE_FORMAT(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as entrada,
      DATE_FORMAT(asistencia.salida, '%m-%d-%Y %H:%i:%s') as salida,
      TIMEDIFF(asistencia.salida,asistencia.entrada) as totalHR,
      empleado.nombre,
      empleado.apellido,
      empleado.dni,
      cargo.nom_cargo as cargo
      FROM
      asistencia
      INNER JOIN empleado on asistencia.id_empleado = empleado.id_empleado
      INNER JOIN cargo on empleado.cargo = cargo.id_cargo
      where entrada BETWEEN '$fechainicio' and '$fechafinal' ORDER BY id_empleado asc");
   } else {
      $sql = $conexion->query(" SELECT asistencia.id_asistencia,
      asistencia.id_empleado,
      DATE_FORMAT(asistencia.entrada, '%m-%d-%Y %H:%i:%s') as entrada,
      DATE_FORMAT(asistencia.salida, '%m-%d-%Y %H:%i:%s') as salida,
      TIMEDIFF(asistencia.salida,asistencia.entrada) as totalHR,
      empleado.nombre,
      empleado.apellido,
      empleado.dni,
      cargo.nom_cargo as cargo
      FROM
      asistencia
      INNER JOIN empleado on asistencia.id_empleado = empleado.id_empleado
      INNER JOIN cargo on empleado.cargo = cargo.id_cargo
      where asistencia.id_empleado= '$empleado' and entrada BETWEEN '$fechainicio' and '$fechafinal' ORDER BY id_empleado asc");
   }
   
   
   
   

   while ($datos = $sql->fetch_object()) {
      $i = $i + 1;
      /* TABLA */
      $pdf->Cell(9, 10, utf8_decode("$i"), 1, 0, 'C', 0);
      $pdf->Cell(40, 10, utf8_decode("$datos->nombre $datos->apellido"), 1, 0, 'C', 0);
      $pdf->Cell(23, 10, utf8_decode("$datos->dni"), 1, 0, 'C', 0);
      $pdf->Cell(25, 10, utf8_decode("$datos->cargo"), 1, 0, 'C', 0);
      $pdf->Cell(36, 10, utf8_decode("$datos->entrada"), 1, 0, 'C', 0);
      $pdf->Cell(36, 10, utf8_decode("$datos->salida"), 1, 0, 'C', 0);
      $pdf->Cell(20, 10, utf8_decode("$datos->totalHR"), 1, 1, 'C', 0);
   }




   $pdf->Output('Prueba.pdf', 'I'); //nombreDescarga, Visor(I->visualizar - D->descargar)

}
