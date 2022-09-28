<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function all($id, $id_client)
    {
        try{
            $com = Company::find($id);
            $key = $com->key;
            $url = $com->url;
            $client = new Client();
            $headers = ['X-REST-API-KEY' => $key];
            $request = new Request('GET', $url.'/rest/api/pet', $headers);
            $res = $client->sendAsync($request)->wait();
            $res = json_decode($res->getBody());
            $res = $res->data->pet;
            $result = [];
            foreach($res as $re){
                if($re->status == 'alive' && $re->owner_id == $id_client){
                    try{
                        $re->type = $re->type->title;
                    }
                    catch(Exception $e){
                        $re->type = " ";
                    } try{
                        $re->breed = $re->breed->title;
                    }
                    catch(Exception $e){
                        $re->breed = " ";
                    }
                    $result[] = $re;
                }
            }
            $ids = [
                'id' => $id,
                'id_client' => $id_client
            ];
            return view('pet.index', compact('result'), compact('ids'));
        }
        catch(Exception $e){
            $er =  'Error: '.$e->getMessage()." --$id-- ";
            return redirect()->route('companies.index')->with('error', $er);
        }
    }
    public function create($id, $id_client)
    {

        $ids = [
            'id' => $id,
            'id_client' => $id_client
        ];
        return view('pet.create', compact('ids'));
    }
    public function store(HttpRequest $request, $id, $id_client)
    {
        $com = Company::find($id);
        $key = $com->key;
        $url = $com->url;
        $client = new Client();
        $headers = [
            'X-REST-API-KEY' => $key,
            'Content-Type' => 'application/json'
        ];
        $body = '{
            "owner_id":6,
            "alias":"Матроскин",
            "type_id": 13,
            "breed_id":444
        }';
        // "alias": "'.$request->alias.'",
        // "sex": "'.$request->sex.'",
        // "breed_id": "'.$request->breed_id.'",
        // "color_id": "'.$request->color_id.'",
        // "weight": "'.$request->weight.'",
        // "birthday": "'.$request->birthday.'",
        // "chip_number": "'.$request->chip_number.'",
        // "lab_number": "'.$request->lab_number.'",
        // "owner_id": '.$id_client.',
        // echo $body;
        $request = new Request('POST', $url.'/rest/api/pet', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        echo $res->getBody();

        // // return redirect()->route('clients-all', $id)->with('success','Pet has been created successfully.');
    }
    public function destroy($id, $id_client, $id_pet)
    {
        $com = Company::find($id);
        $key = $com->key;
        $url = $com->url;
        $client = new Client();
        $headers = [
            'X-REST-API-KEY' => $key
        ];
        $body = '';
        $request = new Request('DELETE', $url.'/rest/api/pet/'.$id_pet, $headers, $body);
        $client->sendAsync($request)->wait();
        return redirect()->route('clients-all', $id)->with('success','Pet has been deleted successfully.');
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
        return redirect()->route('clients-all', $id)->with('success','Pet Has Been updated successfully');
    }
}

// 'b2720694a3a218bd59f59380b24bb4a5'
// https://devlaravel.vetmanager.ru
