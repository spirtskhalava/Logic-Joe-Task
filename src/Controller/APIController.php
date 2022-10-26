<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api")
 */
class APIController extends AbstractController
{

    public $dir = ["NORTH"=>"SOUTH", "SOUTH"=>"NORTH", "EAST"=>"WEST","WEST"=>"EAST"];
    public $result = [];
    public $countNumber=0;
    /**
    * @Route("/directions/{data}", methods={"GET"})
     */
    public function index(string $data): Response
    {
        $data = explode(',', $data);
        $this->countNumber = count($data);
        if (count($data) < 2) {
            return $this->json([
                'error' => 'Error'
            ], 401);
         }
        for($i = 0;$i < $this->countNumber;$i++){
            if($this->dir[$data[$i]]==end($this->result) && $i!==0){
                array_pop($this->result);
            }else{
                array_push($this->result,$data[$i]);
            }
         }
        return $this->json($this->result, 200);
    }
}
