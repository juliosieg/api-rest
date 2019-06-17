<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cats;
use App\Search;

class CatsController extends Controller
{
    public function searchById(Request $request, $id){

        $cat = Cats::find($id);

        echo $cat;

    }

    public function index(Request $request){

        //Verifica se o termo ja foi pesquisado e se a quantidade
        //de resultados é a mesma da anterior

        $name = $request->query('name');
        
        $search = Search::where('term', $name)->get();
        $foundTerm = count($search);

        $cats = Cats::where('name', 'LIKE', '%' . $name . '%')->get();
        $countResultsCats = count($cats);

        $findNewResults = true;

        if($foundTerm > 0){
            
            //Se encontrou o termo, verifica se a quantidade é a mesma
            $quantity_results = $search[0]->quantity_results;

            if($countResultsCats == $quantity_results){

                $findNewResults = false;

                echo json_encode($cats);

            }else{
    
                Cats::where('name', 'LIKE', '%' . $name . '%')->truncate();
                Search::where('term', $name)->truncate();  

            }

        }

        if($findNewResults){

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.thecatapi.com/v1/breeds/search?q=".$name,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'x-api-key: 1474c307-7ac9-4089-96e6-4988bd7dc046'
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                // Curl Error
            } else {
                
                $search = new Search;
                $search->term = $name;
                $search->quantity_results = sizeof(json_decode($response));
                $search->save();

                $responses = json_decode($response);

                foreach($responses as $key => $resp){
                
                    //Pesquisa se ja tem o gato na base para não inserir novamente
                    $cat = Cats::where('name', $resp->name)->first();

                    $alreadyExists = false;

                    if($cat){
                        $alreadyExists = true;
                    }
                    
                    if(!$alreadyExists){

                        $cat = new Cats;

                        if(property_exists($resp, 'weight')){
                            $cat->weight_imperial = $resp->weight->imperial; 
                            $cat->weight_metric = $resp->weight->metric;
                        }

                        $arrayParams = array(
                            'id', 
                            'name', 
                            'cfa_url', 
                            'vetstreet_url',
                            'vcahospitals_url', 
                            'temperament',
                            'origin',
                            'country_codes',
                            'country_code',
                            'description',
                            'life_span',
                            'indoor',
                            'lap',
                            'alt_names',
                            'adaptability',
                            'affection_level',
                            'child_friendly',
                            'dog_friendly',
                            'energy_level',
                            'grooming',
                            'health_issues',
                            'intelligence',
                            'shedding_level',
                            'social_needs',
                            'stranger_friendly',
                            'vocalisation',
                            'experimental',
                            'hairless',
                            'natural',
                            'rare',
                            'rex',
                            'suppressed_tail',
                            'short_legs',
                            'wikipedia_url',
                            'hypoallergenic'
                        );

                        foreach($arrayParams as $param){
                        
                            if(property_exists($resp, $param)){
                                $cat->$param = $resp->$param;
                            }
                        
                        }                   
                    } 
                    
                    $cat->save();
                    
                }

                print_r($response);
            }
        }
    }
}