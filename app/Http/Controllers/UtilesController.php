<?php

namespace App\Http\Controllers;
use App\Models\ListaTareas;
use Illuminate\Http\Request;
use Mpdf\Mpdf;  
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class UtilesController extends Controller
{
    public function utiles_inicio()
    {
        return view('utiles.home');
    }

    public function utiles_pdf($id)
    {

    $tarea = ListaTareas::where(['id'=>$id])->firstorfail(); 
    $mpdf = new Mpdf();

    $html = '<h1>Tarea</h1>

            ID: '.$tarea->id.'<br>
            Título: '.$tarea->titulo.'<br>
            Descripción: '.$tarea->descripcion.'<br>
            Autor: '.$tarea->autor.'<br>
            Fecha: '.$tarea->fecha.'<br>
            Hora: '.$tarea->hora.'<br>
            <hr>'; 
            $mpdf->WriteHTML($html);
            $mpdf->Output();
    }

    public function utiles_excel()
    {
        $helper = new Sample();
        if ($helper->isCli()){
            $helper->log('a'.PHP_EOL);
            return;
        }
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('Francisco Barrena')
            ->setLastModifiedBy('Francisco')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Excel')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file');

        $tareas = ListaTareas::orderby('id', 'desc')->get();
        $i = 2;
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1','ID')
        ->setCellValue('B1','TITULO')
        ->setCellValue('C1','DESCRIPCIÓN')
        ->setCellValue('D1','AUTOR')
        ->setCellValue('E1','FECHA')
        ->setCellValue('F1','HORA');

        foreach ($tareas as $tarea)
        {
        $spreadsheet->getActiveSheet()
        ->setCellValue('A'.$i, $tarea->id)
        ->setCellValue('B'.$i, $tarea->titulo)
        ->setCellValue('C'.$i, $tarea->descripcion)
        ->setCellValue('D'.$i, $tarea->autor)
        ->setCellValue('E'.$i, $tarea->fecha)
        ->setCellValue('F'.$i, $tarea->hora);
        $i++;
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="reporte_'.date("Y-m-d H:i:s").'.xlsx"');
        $writer->save('php://output'); 
        exit;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
    }

}

    
    

