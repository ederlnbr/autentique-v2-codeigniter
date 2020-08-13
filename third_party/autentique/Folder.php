<?php

    class Folder
    {
        var $adapter;

        public function __construct($adapter)
        {
            $this->adapter = $adapter;
        }

        public function get($id, $resource="")
        {
            if($resource=="")
                $resource = $this->adapter->resources("folder","get");

            $args['headers']['contentType'] = 'json';
            $args['body']['query']          = $this->adapter->replaces($resource, ['$id' => $id]);
            $args['body']['variables']      = [];

            return $this->adapter->call("POST", $args);
        }

        public function list($resource="")
        {
            if ($resource == "")
                $resource = $this->adapter->resources("folder", "list");

            $args['headers']['contentType'] = 'json';
            $args['body']['query']          = $resource;
            $args['body']['variables']      = [];

            return $this->adapter->call("POST", $args);
        }

        public function create($name, $resource="")
        {
             if ($resource == "")
                $resource = $this->adapter->resources("folder", "create");

            $args['headers']['contentType'] = 'json';
			$args['body']['query']          = $resource;
            $args['body']['variables']['folder']['name'] = $name;
            
            return $this->adapter->call("POST", $args);
        }

        public function delete($id, $resource="")
        {
            if($resource=="")
                $resource = $this->adapter->resources("folder","delete");

            $args['headers']['contentType'] = 'json';
            $args['body']['query']          = $this->adapter->replaces($resource, ['$id' => $id]);
            $args['body']['variables']      = [];

            return $this->adapter->call("POST", $args);
        }
        
        public function move($id, $document_id, $resource="")
        {
            if($resource=="")
                $resource = $this->adapter->resources("folder","move");

            $args['headers']['contentType'] = 'json';
            $args['body']['query']          = $this->adapter->replaces($resource, ['$id' => $id, '$document_id' => $document_id]);
            $args['body']['variables']      = [];

            return $this->adapter->call("POST", $args);
        }

        public function listDocuments($id, $resource="")
        {
            if($resource=="")
                $resource = $this->adapter->resources("folder", "listDocuments");

            $args['headers']['contentType'] = 'json';
            $args['body']['query']          = $this->adapter->replaces($resource, ['$id' => $id]);
            $args['body']['variables']      = [];

            return $this->adapter->call("POST", $args);
        }
      
        /*



		if($action=="move")
		{
			$args['headers']['contentType'] = 'json';
			$args['body']['query']       = "mutation { moveDocumentToFolder(document_id: \"".$param['document_uid']."\", folder_id: \"".$param['uid']."\") }";
			$args['body']['variables']   = [];

			return $this->call("POST", $args);
		}

		if($action=="list_documents")
		{
			$args['headers']['contentType'] = 'json';
			$args['body']['query']       = "query { documentsByFolder(folder_id: \"" . $param['uid'] . "\", limit: 60, page: 1) { total data { id name created_at files { original signed } signatures { public_id name email action { name } viewed { created_at } signed { created_at } rejected { created_at } } } } }";
			$args['body']['variables']   = [];

			return $this->call("POST", $args);
		}*/
    }