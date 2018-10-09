<?php
    namespace App\Classes;
    use App\PlatformField;
    use App\PlatformFieldValue;
    use GuzzleHttp;
    class Jvzoo{

    var $api_parameters= array();
    var $project;
    var $result;

        public function SetCredentials($project)
        {
            $this->project=$project;
            foreach ($project->platform->platformFields->pluck('input_name') as $input_name) {
                $platform_field_id = PlatformField::where('input_name', '=', $input_name)->
                                                    where('platform_id', '=', $project->platform->id)->get()->first()->id;

                $platform_field_value = PlatformFieldValue::where('platform_field_id', '=', $platform_field_id)->
                                                            where('project_id', '=', $project->id)->get()->first();

                $this->api_parameters[$input_name] = $platform_field_value->field_value;

            }

        }


        public function getStatusCode()
        {
            $client = new GuzzleHttp\Client();


            try {

//            $this->result=$client->request('GET','https://bc4e6c93-677b-4bce-9438-788d650df9d6.mock.pstmn.io/transactions');

                $this->result = $client->request('GET', $this->api_parameters['api_url'], [
                    'auth' => [$this->api_parameters['app_key'], $this->api_parameters['password']]
                ]);

            }
            catch (\Exception $exception)
            {
                return '404';
            }
            return $this->result->getStatusCode();

        }


    public function getTransactions()
    {

        $data=json_decode($this->result->getBody()->getContents());

        $results=$data->results;

//        $filtered_results=array();
//
//
//        foreach ($results as $result)
//        {
//            if($result->product_id == $this->api_parameters['product_number'])
//            {
//                array_push($filtered_results,$result);
//            }
//        }

        return $results;

    }

    }




