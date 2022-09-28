<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use App\Models\Company;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request as HttpRequest;

class ConnController extends Controller
{

    public function all($id)
    {
        try{
            $com = Company::find($id);
            $key = $com->key;
            $url = $com->url;
            $client = new Client();
            $headers = ['X-REST-API-KEY' => $key];
            $request = new Request('GET', $url.'/rest/api/client/clientsSearchData?limit=50', $headers);
            $res = $client->sendAsync($request)->wait();
            $res = json_decode($res->getBody());
            $res = $res->data->client;
            $result = [];
            foreach($res as $re){
                if($re->status == 'ACTIVE'){
                    $re->id = $re->client_id;
                    try{
                        $re->pet = '';
                        foreach ($re->pets as $pets)
                            $re->pet .= $pets->alias.", ";
                    }
                    catch(Exception $e){
                        $re->pet = " ";
                    }
                    try{
                        $re->city = $re->city_data->title;
                    }
                    catch(Exception $e){
                        $re->city = " ";
                    }
                    try{
                        $re->address = "ул. ".$re->street_data->title." ".$re->apartment;
                    }
                    catch(Exception $e){
                        try{
                            $re->address = "ул".$re->street_data->title;
                        }
                        catch(Exception $e){
                            try{
                                $re->address = $re->apartment;
                            }
                            catch(Exception $e){
                                $re->address = " ";
                            }
                        }
                    }
                    $result[] = $re;
                }
            }
            return view('conn.index', compact('result'), compact('id'));
        }
        catch(Exception $e){
            $er =  'Error: '.$e->getMessage();
            return redirect()->route('companies.edit', $id)->with('error', $er);
        }
    }
    public function search(HttpRequest $request, $id)
    {
        try{
            $com = Company::find($id);
            $key = $com->key;
            $url = $com->url;
            $client = new Client();
            $headers = ['X-REST-API-KEY' => $key];
            $request = new Request('GET', $url.'/rest/api/client/clientsSearchData?limit=50&search_query='.$request->search, $headers);
            $res = $client->sendAsync($request)->wait();
            $res = json_decode($res->getBody());
            $res = $res->data->client;
            $result = [];
            foreach($res as $re){
                if($re->status == 'ACTIVE'){
                    $re->id = $re->client_id;
                    try{
                        $re->pet = '';
                        foreach ($re->pets as $pets)
                            $re->pet .= $pets->alias.", ";
                    }
                    catch(Exception $e){
                        $re->pet = " ";
                    }
                    try{
                        $re->city = $re->city_data->title;
                    }
                    catch(Exception $e){
                        $re->city = " ";
                    }
                    try{
                        $re->address = "ул. ".$re->street_data->title." ".$re->apartment;
                    }
                    catch(Exception $e){
                        try{
                            $re->address = "ул".$re->street_data->title;
                        }
                        catch(Exception $e){
                            try{
                                $re->address = $re->apartment;
                            }
                            catch(Exception $e){
                                $re->address = " ";
                            }
                        }
                    }
                    $result[] = $re;
                }
            }
            return view('conn.index', compact('result'), compact('id'));
        }
        catch(Exception $e){
            $er =  'Error: '.$e->getMessage();
            return redirect()->route('companies.edit', $id)->with('error', $er);
        }
    }
    public function create($id)
    {
        return view('conn.create', compact('id'));
    }
    public function store(HttpRequest $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'nullable|integer',
            'street_id' => 'nullable|integer',
            'type_id' => 'nullable|integer',
            'how_find' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $com = Company::find($id);
        $key = $com->key;
        $url = $com->url;
        $client = new Client();
        $headers = [
            'X-REST-API-KEY' => $key,
        ];
        $body = '{
            "last_name": "'.$request->last_name.'",
            "first_name": "'.$request->first_name.'",
            "middle_name": "'.$request->middle_name.'",
            "passport_series": "'.$request->passport_series.'",
            "home_phone": "'.$request->home_phone.'",
            "work_phone": "'.$request->work_phone.'",
            "cell_phone": "'.$request->cell_phone.'",
            "email": "'.$request->email.'",
            "city_id": '.$request->city_id.',
            "street_id": '.$request->street_id.',
            "apartment": "'.$request->apartment.'",
            "zip": "'.$request->zip.'",
            "discount": "'.$request->discount.'",
            "number_of_journal": "'.$request->number_of_journal.'",
            "type_id": '.$request->type_id.',
            "how_find": "'.$request->how_find.'",
            "unsubscribe": "'.$request->unsubscribe.'",
            "in_blacklist": "'.$request->in_blacklist.'"
        }';
        $request = new Request('POST', $url.'/rest/api/client', $headers, $body);
        $client->sendAsync($request)->wait();
        return redirect()->route('clients-all', $id)->with('success','Client has been created successfully.');
    }
    public function destroy($id, $id_client)
    {
        $com = Company::find($id);
        $key = $com->key;
        $url = $com->url;
        $client = new Client();
        $headers = [
            'X-REST-API-KEY' => $key
        ];
        $body = '';
        $request = new Request('DELETE', $url.'/rest/api/client/'.$id_client, $headers, $body);
        $client->sendAsync($request)->wait();
        return redirect()->route('clients-all', $id)->with('success','Client has been deleted successfully.');
    }
    public function edit($id, $id_client)
    {
        $com = Company::find($id);
        $key = $com->key;
        $url = $com->url;
        $client = new Client();
        $headers = [
            'X-REST-API-KEY' => $key
        ];
        $request = new Request('GET', $url.'/rest/api/client/'.$id_client, $headers);
        $res = $client->sendAsync($request)->wait();
        $res = json_decode($res->getBody());
        $res = $res->data->client;
        // var_dump(compact('res'));
        return view('conn.edit', compact('res'), compact('id'));
    }
    public function update(HttpRequest $request, $id, $id_client)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'nullable|integer',
            'street_id' => 'nullable|integer',
            'type_id' => 'nullable|integer',
            'how_find' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $com = Company::find($id);
        $key = $com->key;
        $url = $com->url;
        $client = new Client();
        $headers = [
            'X-REST-API-KEY' => $key
        ];
        $body = '{
            "last_name": "'.$request->last_name.'",
            "first_name": "'.$request->first_name.'",
            "middle_name": "'.$request->middle_name.'",
            "passport_series": "'.$request->passport_series.'",
            "home_phone": "'.$request->home_phone.'",
            "work_phone": "'.$request->work_phone.'",
            "cell_phone": "'.$request->cell_phone.'",
            "email": "'.$request->email.'",
            "city_id": '.$request->city_id.',
            "street_id": '.$request->street_id.',
            "apartment": "'.$request->apartment.'",
            "zip": "'.$request->zip.'",
            "discount": "'.$request->discount.'",
            "number_of_journal": "'.$request->number_of_journal.'",
            "type_id": '.$request->type_id.',
            "how_find": "'.$request->how_find.'",
            "unsubscribe": "'.$request->unsubscribe.'",
            "in_blacklist": "'.$request->in_blacklist.'"
        }';
        // echo $body;
        $request = new Request('PUT', $url.'/rest/api/client/'.$id_client, $headers, $body);
        $res = $client->sendAsync($request)->wait();
        // echo $res->getBody();
        return redirect()->route('clients-all', $id)->with('success','Client Has Been updated successfully');
    }
}

// 'b2720694a3a218bd59f59380b24bb4a5'
// https://devlaravel.vetmanager.ru
