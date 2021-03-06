<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller {

    public function index(Request $request) {
        $final_data = array();
        
        $models_config = config('viewmodels');
        
//        die(sha1('$f@H^J(K%GSD$TGRSDSD'));

        if (empty($request->get('api_data'))) {
            $final_data['status'] = 404;
            $final_data['message'] = 'api_data key is missing';
            $final_data['result'] = [];
            $final_data['count'] = '';
            return json_encode($final_data);
        }


        $decodeJson = json_decode($request->get('api_data'));

        if (json_last_error() !== 0) {
            $final_data['status'] = 404;
            $final_data['message'] = 'your json string is not correct';
            $final_data['result'] = [];
            $final_data['count'] = '';
            return json_encode($final_data);
        }

        
        if($decodeJson->api_key != env('API_KEY')){
            $final_data['status'] = 404;
            $final_data['message'] = 'your Api key is not correct';
            $final_data['result'] = [];
            $final_data['count'] = '';
            return json_encode($final_data);
        }
        
        if($decodeJson->api_token != env('API_TOKEN')){
            $final_data['status'] = 404;
            $final_data['message'] = 'your Api token is not correct';
            $final_data['result'] = [];
            $final_data['count'] = '';
            return json_encode($final_data);
        }
        
        if(empty($models_config[$decodeJson->m])){
            $final_data['status'] = 404;
            $final_data['message'] = 'Model name is not correct';
            $final_data['result'] = [];
            $final_data['count'] = '';
            return json_encode($final_data);
        }
        
        
        $modelObj = $models_config[$decodeJson->m];
//        strlen()
        
        /* 
         * Regax Pendgin
         */
        call_user_func(array($modelObj, $decodeJson->f), $decodeJson->params);
        
//        if(empty()){
//            $final_data['status'] = 404;
//            $final_data['message'] = 'Methd name is not correct';
//            $final_data['result'] = [];
//            $final_data['count'] = '';
//            return json_encode($final_data);
//        }
//        
        
//        call_user_func_array(array($modelObj, $decodeJson->f.'asd'), []);
//        dd();
//        
//        call_user_func_array(array($modelObj, $decodeJson->f), []);
//        \App\Http\Models\User::class;


        dd(json_decode($request->get('api_data')));
    }

}
