<?php

namespace App\Http\Controllers;
use App\Module\SearchInterface;
use Illuminate\Http\Request;


class ApiController extends Controller
{
    private $client;
    protected $search_client;

    public function __construct(SearchInterface $search)
    {
        $this->search_client = $search; 
         
    }
     
    public function getCategories()
    {
        return $this->search_client->categories();       
    }

    public function products(Request $request)
    {
        return  $this->search_client->products($request); 
        
    }    

    
}
