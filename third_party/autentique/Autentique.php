<?php

    require_once("Adapter.php");
    require_once("Document.php");
    require_once("Folder.php");

    class Autentique
    {
        var $adapter;

        public function __construct($param)
        {
            $this->adapter = new Adapter($param);
        }

        public function document()
        {
            return new Document($this->adapter);
        }

        public function folder()
        {
            return new Folder($this->adapter);
        }
    }