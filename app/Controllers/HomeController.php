<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Propiedad;

class HomeController extends Controller
{
    public function index()
    {
        $propiedadModel = new Propiedad();
        $properties = $propiedadModel->getAll();
        $this->view('home/index', ['properties' => $properties]);
    }
}
?>
