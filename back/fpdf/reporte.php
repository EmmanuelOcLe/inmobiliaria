<?php
require('./fpdf.php');

// Clase personalizada para el PDF
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Arial', 'B', 20); // Fuente para el título
        $this->SetTextColor(0, 0, 0); // Color del texto
        $this->Cell(1); // Mover a la derecha
        $this->Cell(110, 15, utf8_decode('INMOBILIARIA EMMANUEL'), 0, 1, 'S', 0); // Título principal
        $this->Ln(5); // Salto de línea

        // Información adicional
        $this->SetFont('Arial', '', 9);
        $this->Cell(1); // Mover a la derecha
        $this->Cell(1, 10, utf8_decode("Ubicación: Dosquebradas"), 0, 1, '', 0);
        $this->Cell(1);
        $this->Cell(1, 10, utf8_decode("Teléfono: +123 456 789"), 0, 1, '', 0);
        $this->Cell(1);
        $this->Cell(1, 10, utf8_decode("Correo: emmanuel@inmobiliaria.com"), 0, 1, '', 0);
        $this->Ln(30);

        // Título del reporte
        $this->SetTextColor(70,130,180); // Color del título
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(75);
        $this->Cell(100, 10, utf8_decode("REPORTE DE INMUEBLES"), 0, 1, 'C', 0);
        $this->Ln(7);

        // Cabecera de la tabla
        $this->SetFillColor(65,105,225); // Fondo de la cabecera
        $this->SetTextColor(255, 255, 255); // Texto blanco
        $this->SetFont('Arial', 'B', 9); // Ajustar el tamaño de la fuente
        $this->Cell(10, 8, utf8_decode('ID'), 1, 0, 'C', 1); // Reducir el tamaño de las celdas
        $this->Cell(45, 8, utf8_decode('NOMBRE'), 1, 0, 'C', 1);
        $this->Cell(40, 8, utf8_decode('UBICACIÓN'), 1, 0, 'C', 1);
        $this->Cell(30, 8, utf8_decode('HABITACIONES'), 1, 0, 'C', 1);
        $this->Cell(20, 8, utf8_decode('BAÑOS'), 1, 0, 'C', 1);
        $this->Cell(20, 8, utf8_decode('PARKING'), 1, 0, 'C', 1);
        $this->Cell(15, 8, utf8_decode('ÁREA'), 1, 0, 'C', 1);
        $this->Cell(25, 8, utf8_decode('OFERTA'), 1, 0, 'C', 1);
        $this->Cell(30, 8, utf8_decode('PRECIO'), 1, 0, 'C', 1);
        $this->Cell(25, 8, utf8_decode('ESTADO'), 1, 1, 'C', 1);
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
        $this->SetY(-15);
        $this->Cell(0, 10, date('d/m/Y'), 0, 0, 'R');
    }
}

// Conexión a la base de datos
require_once('../conection.php');

if ($con->connect_error) {
    die("Error en la conexión: " . $con->connect_error);
}

// Consulta a la tabla 'inmuebles'
$sql = "SELECT * FROM inmueble";
$result = $con->query($sql);

if ($result === false) {
    die("Error en la consulta: " . $con->error); // Si la consulta falla, muestra el error
}

if ($result->num_rows > 0) {
    // Crear la instancia del PDF con orientación horizontal
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L'); // Agregar página en orientación horizontal
    $pdf->SetFont('Arial', '', 9); // Ajustar el tamaño de la fuente
    $pdf->SetDrawColor(163, 163, 163); // Color del borde
// Función para ajustar el texto al ancho de la celda
   function ajustarTexto($pdf, $texto, $ancho)
   {
      while ($pdf->GetStringWidth($texto) > $ancho) {
         $texto = substr($texto, 0, -1); // Quitar el último carácter
      }
      return $texto;
   }

   // En el ciclo donde se generan las celdas del PDF
   while ($row = $result->fetch_assoc()) {
      $id = $row['id_inmueble'];
      $name = ajustarTexto($pdf, $row['nombre_inmueble'], 40);
      $location = ajustarTexto($pdf, $row['ubicacion_inmueble'], 35);
      $rooms = $row['cantidad_habitaciones'];
      $bathrooms = $row['cantidad_baños'];
      $parking = $row['zona_parqueo'];
      $area = $row['area'];
      $ofert = ajustarTexto($pdf, $row['tipo_oferta'], 25);
      $price = "$" . number_format($row['precio_inmueble'], 2);
      $status = ajustarTexto($pdf, $row['estado'], 25);

      $pdf->Cell(10, 8, $id, 1, 0, 'C', 0);
      $pdf->Cell(45, 8, utf8_decode($name), 1, 0, 'C', 0);
      $pdf->Cell(40, 8, utf8_decode($location), 1, 0, 'C', 0);
      $pdf->Cell(30, 8, utf8_decode($rooms), 1, 0, 'C', 0);
      $pdf->Cell(20, 8, utf8_decode($bathrooms), 1, 0, 'C', 0);
      $pdf->Cell(20, 8, utf8_decode($parking), 1, 0, 'C', 0);
      $pdf->Cell(15, 8, utf8_decode($area), 1, 0, 'C', 0);
      $pdf->Cell(25, 8, utf8_decode($ofert), 1, 0, 'C', 0);
      $pdf->Cell(30, 8, utf8_decode($price), 1, 0, 'C', 0);
      $pdf->Cell(25, 8, utf8_decode($status), 1, 1, 'C', 0);
   }

    // Salida del PDF
    $pdf->Output('Reporte_Inmuebles.pdf', 'I');
} else {
    echo "No se encontraron registros en la base de datos.";
}
?>
