<?php 

//  START  GOOGLE__FEED__TEMPLATE_function(){  -->-----
    function GOOGLE__FEED__TEMPLATE_function( $shop_Name ,$feed_Name, $array_products1 , $version_xml, $xml_type, $formated , $file_real_path, $feed_description_text  ){

        $data = '';
        $data = $array_products1;        
        $array_products = json_decode($data , true);
        $keys__Attributes__Names = array_keys($array_products[0]) ;
        $XML = new DOMDocument($version_xml,  $xml_type );
        if($formated == true){
            $XML->formatOutput = true;
        }
        $rss = $XML-> createElement("rss");
        $rss->setAttribute("version", "2.0");
        $rss->setAttribute("xmlns:g", "http://base.google.com/ns/1.0");
        $channel_tag = $XML->createElement("channel");
        $feed_title = $XML-> createElement("title", $feed_Name);
        $channel_tag->appendChild($feed_title );
        $feed_description = $XML-> createElement('description', $feed_description_text);
        $channel_tag->appendChild($feed_description);
        $feed_link = $XML-> createElement("link", "https://". $shop_Name);
        $channel_tag->appendChild($feed_link);

        foreach ($array_products as $key => $array_value) :
        
            $item = $XML-> createElement("item");
            for ($feed__index__i =0; $feed__index__i < sizeof($keys__Attributes__Names) ; $feed__index__i++) { 
                
                $attr_temp = $keys__Attributes__Names[$feed__index__i] ; 
                $val_temp_ = $array_value[ $attr_temp  ];
                $item-> appendChild( $XML-> createElement(  str_replace("'","", convert_multiline_toSingleLine_text2( $attr_temp ))  ,  htmlentities(  str_replace("'","", convert_multiline_toSingleLine_text2( $val_temp_ )) , ENT_XML1, 'UTF-8')   ) );
            }
            $channel_tag->appendChild($item);            
        endforeach;
        $rss->appendChild($channel_tag);
        $XML->appendChild($rss);
        return $XML->saveXML();
    }//  END  GOOGLE__FEED__TEMPLATE_function(){  --<-----

//  START  GOOGLE__FEED__TEMPLATE_function(){  -->-----
    function GOOGLE__FEED_EDIT_TEMPLATE_function( $shop_Name ,$feed_Name, $array_products1 , $version_xml, $xml_type, $formated , $file_real_path, $feed_description_text  ){
        $array_products = $array_products1;
        $keys__Attributes__Names = array_keys($array_products[0]) ;
        
        $XML = new DOMDocument($version_xml,  $xml_type );
        if($formated == true){
            $XML->formatOutput = true;
        }
        $rss = $XML-> createElement("rss");
        $rss->setAttribute("version", "2.0");
        $rss->setAttribute("xmlns:g", "http://base.google.com/ns/1.0");
        $channel_tag = $XML->createElement("channel");
        $feed_title = $XML-> createElement("title", $feed_Name);
        $channel_tag->appendChild($feed_title );
        $feed_description = $XML-> createElement('description', $feed_description_text);
        $channel_tag->appendChild($feed_description);
        $feed_link = $XML-> createElement("link", "https://". $shop_Name);
        $channel_tag->appendChild($feed_link);
        foreach ($array_products as $key => $array_value) :
        
            $item = $XML-> createElement("item");
            for ($feed__index__i =0; $feed__index__i < sizeof($keys__Attributes__Names) ; $feed__index__i ++) {                 
                $attr_temp = $keys__Attributes__Names[$feed__index__i] ; 
                $val_temp_ = $array_value[ $attr_temp  ];
                $item-> appendChild( $XML-> createElement(  str_replace("'","", convert_multiline_toSingleLine_text2( $attr_temp ))  ,  str_replace("'","", convert_multiline_toSingleLine_text2( $val_temp_ ))   ) );
            }
            $channel_tag->appendChild($item);
        endforeach;
        $rss->appendChild($channel_tag);
        $XML->appendChild($rss);
        return $XML->saveXML();
    }//  END  GOOGLE__FEED__TEMPLATE_function(){  --<-----

    function convert_multiline_toSingleLine_text2($s){
        return str_replace(array("\r","\n"),"", trim($s) );
    }
?>
