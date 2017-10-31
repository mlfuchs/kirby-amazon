<?php

include_once("settings.php");

kirbytext::$tags['amazon'] = array(
    'html' => function ($tag) use ($public_key, $private_key, $language, $associate_tag) {

        $produkt_id = $tag->attr('amazon');

        include_once("aws_signed_request.php");

        $request = aws_signed_request($language, array(
            'Operation' => 'ItemLookup',
            'ItemId' => $produkt_id,
            'ResponseGroup' => 'Large'), $public_key, $private_key, $associate_tag);


        $response = file_get_contents($request);
        if ($response === FALSE) {
            return "There was a problem with the Amazon-plugin.\n";
        } else {
            // parse XML
            $pxml = simplexml_load_string($response);
            if ($pxml === FALSE) {
                return "There was a problem with the Amazon-plugin.\n";
            } else {

                $imagedata = file_get_contents($pxml->Items->Item->LargeImage->URL);
                $image = new Media($pxml->Items->Item->LargeImage->URL);
                file_put_contents(kirby()->roots()->cache() . DS . $image->filename(), $imagedata);
                $image = new Media(kirby()->roots()->cache() . DS . $image->filename());


                $thumb_link = thumb($image, array("width" => 180, "height" => 180))->url();

                ob_start();
                include ('template.php');
                return ob_get_clean();

            }
        }

    }
);