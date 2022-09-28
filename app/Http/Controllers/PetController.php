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
            $er =  'Error: '.$e->getMessage();
            return redirect()->route('companies.edit', $id)->with('error', $er);
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
            "alias": "'.$request->alias.'",
            "sex": "'.$request->sex.'",
            "type_id": "'.$request->type_id.'",
            "breed_id": "'.$request->breed_id.'",
            "color_id": "'.$request->color_id.'",
            "weight": "'.$request->weight.'",
            "birthday": "'.$request->birthday.'",
            "chip_number": "'.$request->chip_number.'",
            "lab_number": "'.$request->lab_number.'",
            "owner_id": '.$id_client.',
        }';
        // echo $body;
        $request = new Request('POST', $url.'/rest/api/pet', $headers, $body);
        $res = $client->sendAsync($request)->wait();
        // echo $res->getBody();
        return redirect()->route('clients-all', $id)->with('success','Pet has been created successfully.');
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
    public function edit($id, $id_client, $id_pet)
    {
        $com = Company::find($id);
        $key = $com->key;
        $url = $com->url;
        $client = new Client();
        $headers = [
            'X-REST-API-KEY' => $key
        ];
        $request = new Request('GET', $url.'/rest/api/pet/'.$id_pet, $headers);
        $res = $client->sendAsync($request)->wait();
        $res = json_decode($res->getBody());
        $res = $res->data->pet;
        // var_dump(compact('res'));
        $ids = [
            'id' => $id,
            'id_client' => $id_client
        ];
        return view('pet.edit', compact('res'), compact('ids'));
    }
    public function update(HttpRequest $request, $id, $id_client, $id_pet)
    {
        $com = Company::find($id);
        $key = $com->key;
        $url = $com->url;
        $client = new Client();
        $headers = [
            'X-REST-API-KEY' => $key
        ];
        $body = '{
            "id": "'.$id_pet.'",
            "alias": "'.$request->alias.'",
            "sex": "'.$request->sex.'",
            "type_id": "'.$request->type_id.'",
            "breed_id": "'.$request->breed_id.'",
            "color_id": "'.$request->color_id.'",
            "weight": "'.$request->weight.'",
            "birthday": "'.$request->birthday.'",
            "chip_number": "'.$request->chip_number.'",
            "lab_number": "'.$request->lab_number.'",
            "owner_id": '.$id_client.',
        }';
        echo $body;
        $request = new Request('PUT', $url.'/rest/api/pet/'.$id_pet, $headers, $body);
        $client->sendAsync($request)->wait();
        return redirect()->route('clients-all', $id)->with('success','Pet Has Been updated successfully');
    }
}

// 'b2720694a3a218bd59f59380b24bb4a5'
// https://devlaravel.vetmanager.ru
