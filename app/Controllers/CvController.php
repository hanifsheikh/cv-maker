<?php

namespace App\Controllers;

use App\Models\CV;
use Dompdf\Dompdf;
use Exception;

class CvController
{

    private $cv;
    public function __construct()
    {
        if (session_has('isLoggedIn') !== true) {
            return redirect('/auth/login');
        }
        $this->cv = new CV();
    }
    public function list()
    {
        $page_title = 'CV List';
        $cvs = $this->cv->all();

        return view('cv.list', compact('cvs', 'page_title'));
    }
    public function templates()
    {
        $page_title = 'Choose Template';
        $templates = $this->getTemplates();
        return view('cv.template', compact('page_title', 'templates'));
    }
    public function create()
    {
        if (!post_request()) {
            return dd('Only POST method is allowed!');
        }
        $page_title = 'Create New CV';
        $template_id = $_POST['template_id'];
        $template_options =  $this->getTemplates()[$template_id]['options'];

        return view('cv.create', compact('page_title', 'template_id', 'template_options'));
    }
    public function edit()
    {
        if (!post_request()) {
            return dd('Only POST method is allowed!');
        }

        $page_title = 'Edit CV';
        $cv_data = $this->cv->get($_POST['cv_url']);
        if (!$cv_data) {
            return dd('CV not found!');
        }
        $template_id = $_POST['template_id'];
        $template_options =  $this->getTemplates()[$template_id]['options'];

        return view('cv.edit', compact('page_title', 'template_id', 'cv_data', 'template_options'));
    }
    public function update()
    {
        if (!post_request()) {
            return dd('Only POST method is allowed!');
        }
        if (auth()['id']) {
            $this->cv->update($_POST);
            $this->generatePDF($_POST['cv_id']);
            return redirect('/cv/list');
        }
    }
    public function store()
    {
        if (!post_request()) {
            return dd('Only POST method is allowed!');
        }
        if (auth()['id']) {
            $cv_id = $this->cv->create($_POST);
            $this->generatePDF($cv_id);
            return redirect('/cv/list');
        }
    }
    private function getHTML($request)
    {
        ob_start();
        include __DIR__ . '/../../views/cv/templates/template_' . $request['template_id'] . '.php';
        return ob_get_clean();
    }

    private function getTemplates()
    {
        $templates = file_get_contents((storage_dir('templates.json')));
        return json_decode($templates, true);
    }
    public function download($cv_url)
    {
        $cv_data = $this->cv->get($cv_url);

        $filename = storage_dir('/users' . '/' . session_get('userData')['id'] . '/files') . '/' . $cv_data['id'] . '/' . 'CV - ' . $cv_data['name'] . '.pdf';
        //Check the file exists or not
        if (file_exists($filename)) {
            //Define header information
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header("Cache-Control: no-cache, must-revalidate");
            header("Expires: 0");
            header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
            header('Content-Length: ' . filesize($filename));
            header('Pragma: public');
            //Clear system output buffer
            flush();
            //Download the file
            readfile($filename);
            //Terminate from the script
            die();
        } else {
            echo "File does not exist.";
        }
    }
    public function delete()
    {
        $cv_data = $this->cv->get($_POST['cv_url']);

        $file = storage_dir('/users/' . session_get('userData')['id'] . '/files') . '/' . $cv_data['id'] . '/' . 'CV - ' . $cv_data['name'] . '.pdf';
        $thumb = storage_dir('/users/' . session_get('userData')['id'] . '/files') . '/' . $cv_data['id'] . '/thumb.jpeg';
        //Check the file exists or not
        if (file_exists($file)) {
            unlink($file);
            unlink($thumb);
            $this->cv->delete($_POST['cv_url']);
            return redirect('/cv/list');
        } else {
            echo "File does not exist.";
        }
    }
    private function generatePDF($cv_id)
    {
        $files_dir =  storage_dir('/users/' . auth()['id'] . '/files');

        if (!file_exists($files_dir . '/' . $cv_id)) {
            mkdir($files_dir . '/' . $cv_id, 755, true);
        }
        $pdf = new Dompdf(array('enable_remote' => true));
        $pdf->loadHtml($this->getHTML($_POST));
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $output = $pdf->output();
        // $pdf->stream('CV - ' . $_POST['name'], array("Attachment" => 0));

        file_put_contents($files_dir . '/' . $cv_id . '/' . 'CV - ' . $_POST['name'] . '.pdf', $output);

        try {

            $im = new \Imagick();
            $im->setResolution(72, 72);
            $im->setBackgroundColor('white');
            $im->readImage($files_dir . '/' . $cv_id . '/' . 'CV - ' . $_POST['name'] . '.pdf' . '[0]');
            $im->setImageFormat('jpg');
            $im->scaleImage(320, 320, true);
            $im->mergeImageLayers(\Imagick::LAYERMETHOD_FLATTEN);
            $im->setImageAlphaChannel(\Imagick::ALPHACHANNEL_REMOVE);
            $im->writeImage($files_dir . '/' . $cv_id . '/thumb.jpeg');
        } catch (Exception $e) {
            // return dd();
            shell_exec('"' . GHOSTSCRIPT_PATH . '"' . ' -sstdout=%stderr -dQUIET -dSAFER -dBATCH -dNOPAUSE -dNOPROMPT -dMaxBitmap=500000000 -dAlignToPixels=0 -dGridFitTT=2 "-sDEVICE=pngalpha" -dTextAlphaBits=4 -dGraphicsAlphaBits=4 "-r72x72" -dPrinted=false -dFirstPage=1 -dLastPage=1 -sOutputFile="' . $files_dir . '/' . $cv_id . '/thumb.jpeg"' . ' -f"' . $files_dir . '/' . $cv_id . '/' . 'CV - ' . $_POST['name'] . '.pdf"');
        }
    }
}
