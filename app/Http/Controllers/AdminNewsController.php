<?php

namespace Curso\Http\Controllers;

class AdminNewsController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function details($id){
        return 'Accediendo a la noticia: '. $id;
    }

}