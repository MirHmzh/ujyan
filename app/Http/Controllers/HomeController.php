<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use View;
use Illuminate\Support\Facades\Input;
use Auth;
use Sentry;
use Redirect;
use Alert;
use App\User;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index()
    {
        $target = Sentry::getUser()->id;
        $data = User::find($target);
        $now = Sentry::getUser()->start_time;
        $exp_date = $now + 1440*60;
        $finished = Sentry::getUser()->finished;
        if (Sentry::check() && Sentry::getUser()->hasAccess('admin')) {
            return view('admin');
        }else{
            if ($finished == '0') {
                alert()->info('Kerjakan dalam rentang waktu yang disediakan','Selamat Mengerjakan')
                       ->autoclose(5000);
                    if ($data->start_time == null) {
                        $data->start_time = time();
                        $data->save();
                    }
                return view('exam.query', ['now' => $now, 'exp_date' => $exp_date]);
            }else{
                return view('home');
            }
        }
    }

    public function user()
    {
        return view('sentinel.sessions.agreement');
    }

    public function pdf()
    {
    	return view('exam.result');
    }

    public function printpdf()
    {
    	$fork = Input::all();
        $target = Sentry::getUser()->id;
        $data = User::find($target);
        $data->finished = '1';
        $data->save();

    	// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$html = View::make('exam.result', array('fork' => $fork, 'i' => 0));
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'potrait');

		// Render the HTML as PDF
		$dompdf->render();
		$pdfname = Sentry::getUser()->email;

		$output = $dompdf->output();
		file_put_contents('result/'.$pdfname.'.pdf', $output);
        Alert::success('Telah Mengerjakan Dengan Baik, Semoga Sukses!', 'Terima Kasih');
        return view('home');
    }

    public function showsuccess()
    {
        if (Sentry::check() && Sentry::getUser()->hasAccess('admin')) {
            return view('admin');
        }else{
            return view('home');
        }
    }
}