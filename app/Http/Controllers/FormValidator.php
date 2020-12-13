<?php

namespace App\Http\Controllers;
use DateTime;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FormValidator extends Controller
{
    private $filename = 'app/clients.txt';
    private $nif_validate_data = array('T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E');

    public function validateAndSave(Request $req) {
        $data = $req->all();
        $correct = $this->validateNIF($data['nif']);
        if($correct) $this->saveNewData($data);
        $clients = $this->getClientList();
        return view('main', ['correct' => $correct, 'clients' => $clients]);
    }

    private function saveNewData($data) {
        if(Storage::disk('local')->exists($this->filename) == false) {
            Storage::disk('local')->put($this->filename, $this->clientData($data));
            return;
        }

        $content = Storage::disk('local')->get($this->filename);
        $content = $content."\n".$this->clientData($data);
        Storage::disk('local')->put($this->filename, $content);
    }

    private function clientData($data) {
        return $data['name'].','.$data['surnames'].','.$data['nif'].','.$data['sex'].','.$data['state'];
    }

    private function validateNIF($nif) {
        $n = intval(substr($nif, 0, -1));
        $l = substr($nif, -1);
        $rest = $n % 23;
        if($rest > 22 || $this->nif_validate_data[$rest] != $l) return false;
        return true;
    }

    public function getClientList() {
        if(Storage::disk('local')->exists($this->filename) != false) {
            $content = Storage::disk('local')->get($this->filename);
            $lines = explode("\n", $content);
            $data = array();
            foreach($lines as $line) {
                list($name, $surname, $nif, $sex, $state) = explode(",", $line);
                $obj = ['name' => $name,  'surname' => $surname, 'nif' => $nif, 'sex' => $sex, 'state' => $state];
                array_push($data, $obj);
            }
            return $data;
        }
    }
}
