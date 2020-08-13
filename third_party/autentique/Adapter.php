<?php

    class Adapter 
    {
        var $token;
        var $headers;
        var $endpoint;
        var $env;

        public function __construct($param=array())
        {
            if(isset($param['token']))
            {
                $this->setToken($param['token']);
            }

            if(isset($param['endpoint']))
            {
                $this->setEndPoint($param['endpoint']);
            }

            if(isset($param['env']))
            {
                $this->setEnv($param['env']);
            }
        }
        
        public function setToken($token)
        {
            $this->token = $token;
        }

        public function getToken()
        {
            return $this->token;
        }

        public function setEndPoint($endpoint)
        {
            $this->endpoint = $endpoint;
        }

        public function getEndPoint()
        {
            return $this->endpoint;
        }

        public function setEnv($env)
        {
            if($env=='sandbox')
                $this->env = 'true';
            else
                $this->env = 'false';
        }

        public function getEnv()
        {
            return $this->env;
        }

        private function getHeader($args = array())
        {
            if($args['headers']['contentType'] == 'json')
                $headers[] = "Content-Type: application/json";
            
            $headers[] = "Authorization: Bearer ". $this->token;

            return $headers;
        }
        
        public function call($method = 'POST', $args = array())
        {
            return $this->request($method, $args);
        }
        
        private function request($method, $args = array())
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getHeader($args));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 0);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

            if($method == "GET")
            {
                $params = http_build_query($args);
                curl_setopt($ch, CURLOPT_URL, "{$this->getEndPoint()}?{$params}");
            }
            else 
            {
                curl_setopt($ch, CURLOPT_URL, $this->getEndPoint());	
            }

            if($method == "POST" && count($args['body']) > 0) 
            {
                curl_setopt($ch, CURLOPT_POST, true);

                if($args['headers']['contentType'] == 'json')
                {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($args['body']));
                }
                else 
                {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $args['body']);
                }
            } 

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

            $result = curl_exec($ch);

            if(!$result)
            {
                $result = curl_error($ch);
                $code   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            }
            else
            {
                $result = json_decode($result);
                $code   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            }

            curl_close($ch);          
           
           return (object) array( "status" => $code, "response" => $result);
   
        }

        public function replaces($resource, $replaces)
        {
            return str_replace(array_keys($replaces),array_values($replaces), $resource);
        }

        public function resources($entity, $resource)
        {
            return file_get_contents(APPPATH."/third_party/autentique/resources/{$entity}/{$resource}.tpl");
        }
    }