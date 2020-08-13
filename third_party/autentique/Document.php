<?php

    class Document
    {
        var $adapter;

        public function __construct($adapter)
        {
            $this->adapter = $adapter;
		}
		
		public function get($id, $resource="")
        {
            if($resource=="")
                $resource = $this->adapter->resources("document","get");

            $args['headers']['contentType'] = 'json';
            $args['body']['query']          = $this->adapter->replaces($resource, ['$id' => $id]);
            $args['body']['variables']      = [];

            return $this->adapter->call("POST", $args);
        }

        public function list($resource="")
        {
            if ($resource == "")
                $resource = $this->adapter->resources("document", "list");

            $args['headers']['contentType'] = 'json';
            $args['body']['query']          = $resource;
            $args['body']['variables']      = [];

            return $this->adapter->call("POST", $args);
        }

        public function create($param, $resource="")
        {
             if ($resource == "")
				$resource = $this->adapter->resources("document", "create");

			$variables = json_encode(
			[				
				"document" => [ "name" => $param['name']],
				"signers"  => $param['signers'],
				"file"     => null
			]);
				
			$query = $this->adapter->replaces($resource, ['$variables' => $variables, '$sandbox' => $this->adapter->getEnv()]);

			$args['headers']['contentType'] = 'form';
			$args['body']['operations']     = '{"query":'.$query.'}';
			$args['body']['map']            = '{"file": ["variables.file"]}';
			$args['body']['file']           = new CURLFILE($param['file']);

            return $this->adapter->call("POST", $args);
        }

        public function delete($id, $resource="")
        {
            if($resource=="")
                $resource = $this->adapter->resources("document","delete");

            $args['headers']['contentType'] = 'json';
            $args['body']['query']          = $this->adapter->replaces($resource, ['$id' => $id]);
            $args['body']['variables']      = [];

            return $this->adapter->call("POST", $args);
		}
		
		public function sign($id, $resource="")
        {
            if($resource=="")
                $resource = $this->adapter->resources("document", "sign");

            $args['headers']['contentType'] = 'json';
            $args['body']['query']          = $this->adapter->replaces($resource, ['$id' => $id]);
            $args['body']['variables']      = [];

            return $this->adapter->call("POST", $args);
        }
    }
