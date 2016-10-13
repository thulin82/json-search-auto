<?php
/**
 * A CSearch class to use when searching a json file
 *
 */
class CSearch {

    /**
     * Properties
     *
     */
    private $query;
    private $products;

    /**
     * Constructor
     *
     * @param string $query    String from form containing search query
     * @param string $products String containing path to json file
     */
    public function __construct($query, $products) {
        $this->query    = $query;
        $this->products = $products;
    }
    
    /**
     * Searh through json file looking for the query
     *
     * @return string String containing the result in a html table
     */
    public function searchJson() {
        $str   = file_get_contents($this->products);
        $json  = json_decode($str, true);
        $regex = $this->buildRegex();
        $array = array();
        foreach ($json as $key => $value) {
                if (preg_match("/" . $regex . "/i", $value['name'])) {
                array_push($array, $key);
            }
        }
        $content = $this->outputData($array);
        return $content;
    }
    
    /**
     * Returning and formatting the correct values given by the input array
     *
     * @param  int $array Array containing the results of the search
     * @return string String containing the result in a html table
     */
    private function outputData($array) {
        $str    = file_get_contents($this->products);
        $json   = json_decode($str, true);
        $array2 = array();
        if (empty($array)) {
            return "<p>No data found</p>";
        } else {
            $html = "<table><tr><th>ID</th><th>Namn</th><th>Adress</th></tr>";
            foreach ($array as $key){
               $html .= "<tr><td>" . $json[$key]['id'] . "</td><td>" . $json[$key]['name'] . "</td><td>" . $json[$key]['adress'] . "</td></tr>";
            }
            return $html;
        }
    }
   
    /**
     * Build regex, word for word
     *
     * @return string String containg regex
     */
    private function buildRegex() {
    $words  = explode(" ", $this->query);
    $string = null;
    foreach ($words as $value) {
        $string .= "(?=.*" . $value . ")";
    }
    return $string;
    }
}