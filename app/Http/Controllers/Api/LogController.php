<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Models\BankTransactionFault;
use App\Models\BankTransactionSuccess;
use App\Models\EntityPayment;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class LogController extends Controller
{
    public function save_log($state, $service_id, $description, $request_details, $response_details, $ip, $start_date = "", $end_date="")
    {

        $log = new Log();
        $log->status = $state;
        $log->ip = $ip;
        $log->type = $service_id;
        $log->description = $description;
        $log->request = $request_details;
        $log->response = $response_details;
        $log->created_by=$user=Auth::hasUser()? Auth::user()->u_id:null;
        $log->modified_by=$user;
        $log->created_on = !empty($start_date) ? $start_date : now(env('TIMEZONE'));
        $log->modified_on = !empty($end_date) ? $end_date : now(env('TIMEZONE'));
        $log->start_date = !empty($start_date) ? $start_date : now(env('TIMEZONE'));
        $log->end_date = now(env('TIMEZONE'))->addYear(35);
        $log->save();
    }
}
