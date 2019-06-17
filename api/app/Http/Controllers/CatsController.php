<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cats;
use App\Search;

/**
 * @group General
 *
 * APIs for cats data
 */

class CatsController extends Controller
{

    /**
     * Search by id
     *
     * This function return information about the provided id cat
     *
     * @queryParam id required Id of the cat to search. Example: sibe
     *
    * @response [{"breeds":[{"weight":{"imperial":"8 - 16","metric":"4 - 7"},"id":"sibe","name":"Siberian","cfa_url":"http://cfa.org/Breeds/BreedsSthruT/Siberian.aspx","vetstreet_url":"http://www.vetstreet.com/cats/siberian","vcahospitals_url":"https://vcahospitals.com/know-your-pet/cat-breeds/siberian","temperament":"Curious, Intelligent, Loyal, Sweet, Agile, Playful, Affectionate","origin":"Russia","country_codes":"RU","country_code":"RU","description":"The Siberians dog like temperament and affection makes the ideal lap cat and will live quite happily indoors. Very agile and powerful, the Siberian cat can easily leap and reach high places, including the tops of refrigerators and even doors. ","life_span":"12 - 15","indoor":0,"lap":1,"alt_names":"Moscow Semi-longhair, HairSiberian Forest Cat","adaptability":5,"affection_level":5,"child_friendly":4,"dog_friendly":5,"energy_level":5,"grooming":2,"health_issues":2,"intelligence":5,"shedding_level":3,"social_needs":4,"stranger_friendly":3,"vocalisation":1,"experimental":0,"hairless":0,"natural":1,"rare":0,"rex":0,"suppressed_tail":0,"short_legs":0,"wikipedia_url":"https://en.wikipedia.org/wiki/Siberian_(cat)","hypoallergenic":1}],"id":"qLPz9prjF","url":"https://cdn2.thecatapi.com/images/qLPz9prjF.jpg","width":750,"height":937}]    
     */

    public function searchById(Request $request, $id){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.thecatapi.com/v1/images/search?breed_ids=".$id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if($response and $response != '[]'){

            return response($response, 200);

        }else{

            return response()->json([
                'message' => 'Not found'
            ], 404);
        
        }

    }

    /**
     * Search by name
     *
     * This function return information about the provided similar name cats
     *
     * @queryParam name required Name of the cat to search. Example: si
     * @bodyParam x-api-key required Api Key. Example: 1474c307-7ac9-4089-96e6-4988bd7dc046
    * @response [{"breeds":[{"weight":{"imperial":"8 - 16","metric":"4 - 7"},"id":"sibe","name":"Siberian","cfa_url":"http://cfa.org/Breeds/BreedsSthruT/Siberian.aspx","vetstreet_url":"http://www.vetstreet.com/cats/siberian","vcahospitals_url":"https://vcahospitals.com/know-your-pet/cat-breeds/siberian","temperament":"Curious, Intelligent, Loyal, Sweet, Agile, Playful, Affectionate","origin":"Russia","country_codes":"RU","country_code":"RU","description":"The Siberians dog like temperament and affection makes the ideal lap cat and will live quite happily indoors. Very agile and powerful, the Siberian cat can easily leap and reach high places, including the tops of refrigerators and even doors. ","life_span":"12 - 15","indoor":0,"lap":1,"alt_names":"Moscow Semi-longhair, HairSiberian Forest Cat","adaptability":5,"affection_level":5,"child_friendly":4,"dog_friendly":5,"energy_level":5,"grooming":2,"health_issues":2,"intelligence":5,"shedding_level":3,"social_needs":4,"stranger_friendly":3,"vocalisation":1,"experimental":0,"hairless":0,"natural":1,"rare":0,"rex":0,"suppressed_tail":0,"short_legs":0,"wikipedia_url":"https://en.wikipedia.org/wiki/Siberian_(cat)","hypoallergenic":1}],"id":"qLPz9prjF","url":"https://cdn2.thecatapi.com/images/qLPz9prjF.jpg","width":750,"height":937}]    
     */

    public function index(Request $request){

        $name = $request->query('name');

        if($name){
        
            $search = Search::where('term', $name)->get();
            $foundTerm = count($search);

            $cats = Cats::where('name', 'LIKE', '%' . $name . '%')->get();
            $countResultsCats = count($cats);

            $findNewResults = true;

            if($foundTerm > 0){
            
                //Se encontrou o termo, verifica se a quantidade é a mesma
                $quantity_results = $search[0]->quantity_results;

                if($countResultsCats == $quantity_results and $countResultsCats == 0){

                    $findNewResults = false;

                    return response()->json([
                        'message' => 'Not found'
                    ], 404);

                }if($countResultsCats == $quantity_results){

                    $findNewResults = false;

                    return response()->json($cats, 200);

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
                    
                    return response()->json([
                        'message' => 'Internal Server Error'
                    ], 500);

                } else {
                
                    $search = new Search;
                    $search->term = $name;
                    $search->quantity_results = sizeof(json_decode($response));
                    $search->save();

                    $responses = json_decode($response);

                    foreach($responses as $key => $resp){
                
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

                    return response($response, 200);
                }
            }
        }else{

            return response()->json([
                'message' => 'Not found'
            ], 404);

        }
    }
}