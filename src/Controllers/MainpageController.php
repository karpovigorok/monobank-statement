<?php

namespace Karpovigorok\MonobankAPI\Controllers;

use App\Http\Controllers\Controller;
use Karpovigorok\MonobankAPI\Models\Statement;
use Monobank\Monobank as Monobank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class MainpageController extends Controller
{
    private $_x_token;
    private $_url_prefix;

    public function __construct() {
        $this->_url_prefix = config('monobank.url_prefix', '/');
    }


    public function index(Request $request) {
        if ($request->session()->exists('x_token')) {
            return redirect('/start');
        }
        return view('MonobankAPI::index');

    }

    public function check_token(Request $request) {
        $this->_x_token = $request->input('x_token');
        $remember_token = $request->input('remember_token');

        if($this->_x_token) {
            $request->session()->put('x_token', $this->_x_token);
            if($remember_token == 1) {
                \Cookie::queue('x_token', $this->_x_token, 1);
            }
            return redirect('start');
        }
        else if ($request->session()->exists('x_token')) {
            return redirect('start');
        }
        else {
            return redirect('/');

        }


    }
    public function start(Request $request)
    {
        date_default_timezone_set('Europe/Kiev');

        if (!$request->session()->exists('x_token')) {
            return redirect('/');
        }
        $this->_x_token = $request->session()->get('x_token');
        $monobank = new Monobank($this->_x_token);

        $clientInfo = Cache::get('clientInfo_' . $this->_x_token);
        if(!$clientInfo) {
            try {
                $clientInfo = $monobank->personal->getClientInfo();
                Cache::put('clientInfo_' . $this->_x_token, $clientInfo, 60);
            } catch (Exception $exception) {
                exit($exception->getMessage());
            }
        }
        $data['client_name'] = $clientInfo->name();
        $iso4217 = new \Alcohol\ISO4217();
        foreach($clientInfo->accounts() as $account) {
            $data['accounts'][] = array(
                'id' => $account->id(),
                'currency' => $iso4217->getByNumeric($account->currencyCode()),
            );
        }
        return view('MonobankAPI::start', $data);
    }

    public function process_statement(Request $request) {



        date_default_timezone_set('Europe/Kiev');

        if (!$request->session()->exists('x_token')) {
            return redirect('/');
        }
        $this->_x_token = $request->session()->get('x_token');

        $monobank = new Monobank($this->_x_token);
        $clientInfo = Cache::get('clientInfo_' . $this->_x_token);
        if(!$clientInfo) {
            try {
                $clientInfo = $monobank->personal->getClientInfo();
                Cache::put('clientInfo_' . $this->_x_token, $clientInfo, 60);
            } catch (Exception $exception) {
                exit($exception->getMessage());
            }
        }
        $startDate = new \DateTime($request->input('startDate'));
        //dd($startDate);
        $endDate = new \DateTime($request->input('endDate'));

        $account_id = $request->input('account_id');

        try {
            $statements = $monobank->personal->getStatement($account_id, $startDate, $endDate);
            $statements_array = [];

            foreach ($statements->statements() as $statement) {

                //dd($statement->time());
                $statements_array[] = [
                    "id" => $statement->id(),
                    "time" => $statement->time()->getTimestamp(),
                    "description" => $statement->description(),
                    "isHold" => $statement->isHold(),
                    "amount" => $statement->amount(),
                    "operationAmount" => $statement->operationAmount(),
                    "currencyCode" => $statement->currencyCode(),
                ];
            }


            $statement = new Statement();
            $statement->uid = uniqid();
            $statement->statement = json_encode([
                'person_name' => $clientInfo->name(),
                'startDate' => $startDate->format('U'),
                'endDate' => $endDate->format('U'),
                'rows' => $statements_array
            ], true);
            $statement->save();

            return redirect('/statement/' . $statement->uid);

        } catch (InvalidAccountException $exception) {
            exit('Invalid account '.$account_id);
        } catch (Exception $exception) {
            exit($exception->getMessage());
        }
    }

    public function statement($uid) {
        date_default_timezone_set('Europe/Kiev');
        $data['iso4217'] = new \Alcohol\ISO4217();
        $statement = Statement::where('uid', '=', $uid)->firstOrFail();
        $data['statement'] = json_decode($statement->statement);
        return view('MonobankAPI::statement', $data);
    }

    public function forget_xtoken(Request $request) {
        if ($request->session()->exists('x_token')) {
            $this->_x_token = $request->session()->forget('x_token');
        }
        return redirect('/');
    }
}