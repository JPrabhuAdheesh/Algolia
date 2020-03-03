<?php 

namespace App\Module;

use App\Module\SearchInterface;
use Algolia\AlgoliaSearch\SearchClient as searchClient;

class AlgoliaRepository implements SearchInterface
{
    private $client ; 

    public function __construct()
    {       
        $ALGOLIA_APP_ID = config('app.algolia.id');
        $ALGOLIA_SECRET = config('app.algolia.secret'); 

        $this->client = searchClient::create(
            $ALGOLIA_APP_ID,
            $ALGOLIA_SECRET
        );       
    }

       public function categories()
    {      

        return file_get_contents('./categories.json');
    }

    public function products( $request)
    {

        $index_name = 'search_AWOKMP';

        if ($request->has('sort_field')) {
            $sort_field = $request->input('sort_field');

            if ($sort_field == 'price') {
                $index_name = ($sort_field == 'desc') ? 'price_desc_AWOKMP' : 'price_asc_AWOKMP';
            }
        }

        if ($request->has('category_id')) {

            $category_id = $request->input('category_id');

            return $this->getProductsByCatId($category_id, $index_name);
        }

        if ($request->has('category_name')) {

            $category_name = $request->input('category_name');
            $category_name = urlencode($category_name);
            return $this->getProductsByCatName($category_name, $index_name);
        }
    }

    public function getProductsByCatId($category_id,  $index_name)
    {

        $index = $this->client->initIndex($index_name);

        //dd($index);

        $results = $index->search('', [
            'facetFilters' => [
                'categories_id_list:' . $category_id
            ]
        ]);

       


        return $results;
    }

    public function getProductsByCatName($category_name,  $index_name)
    {

        $index = $this->client->initIndex($index_name);

        $results = $index->search($category_name, [
            'restrictSearchableAttributes' => [
                'category'
            ]
        ]);

        return $results;
    }

}