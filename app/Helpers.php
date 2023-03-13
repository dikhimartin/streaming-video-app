<?php
function arrStatusActive() {
    return array(1 => __('main.active'), 0 => __('main.inactive'));
}

function arrStatus() {
    return array('Y' => __('main.aa'), 'N' => __('main.bb'));
}


function arrTarget() {
    return array('1' => '_self', '2' => '_blank');
}

function arrJenjangPendidikan() {
    return array(1 => 'SD', 2 => 'SMP', 3 => 'SMA', 4 => 'D1', 5 => 'D3', 6 => 'D4', 7 => 'S1', 8 => 'S2', 9 => 'S3');
}

function arrReligion() {
    return array(1 => __('main.islam'), 2 => __('main.protestan'), 3 => __('main.katolik'), 4 => __('main.hindu'), 5 => __('main.buddha'), 6 => __('main.Konghucu'), 10 => __('main.others'));
}

function arrMaritalStatus() {
    return array(1 => __('main.married'), 2 => __('main.widowed'), 3 => __('main.widower'), 4 => __('main.divorce'), 5 => __('main.single'));
}

function arrCountryExperience()
{
    return ['TW', 'SG', 'HK', 'MY', 'MDL'];
}

function arrMonth($locale) {
    if ($locale == 'id') {
        return array(1 => 'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember');
    } elseif ($locale == 'zh') {
        return array(1 => '一月', 2=>'二月', 3=>'游行', 4=>'四月', 5=>'可能', 6=>'六月', 7=>'七月', 8=>'八月', 9=>'九月', 10=>'十月', 11=>'十一月', 12=>'十二月');
    } elseif ($locale == 'en') {
        return array(1 => 'January', 2=>'February', 3=>'March', 4=>'April', 5=>'May', 6=>'June', 7=>'July', 8=>'August', 9=>'September', 10=>'October', 11=>'November', 12=>'December');
    }
}

function snippetwop($text,$length=64,$tail="...")
{
    $text = trim($text);
    $txtl = strlen($text);
    if ($txtl > $length)
    {
        for ($i=1;$text[$length-$i]!=" ";$i++)
        {
            if ($i == $length)
            {
                return substr($text,0,$length) . $tail;
            }
        }

        for (;$text[$length-$i]=="," || $text[$length-$i]=="." || $text[$length-$i]==" ";$i++) {;}

        $text = substr($text,0,$length-$i+1) . $tail;
    }
    return $text;
}

function makeLinks($str) {
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    $urls = array();
    $urlsToReplace = array();
    if(preg_match_all($reg_exUrl, $str, $urls)) {
        $numOfMatches = count($urls[0]);
        $numOfUrlsToReplace = 0;
        for($i=0; $i<$numOfMatches; $i++) {
            $alreadyAdded = false;
            $numOfUrlsToReplace = count($urlsToReplace);
            for($j=0; $j<$numOfUrlsToReplace; $j++) {
                if($urlsToReplace[$j] == $urls[0][$i]) {
                    $alreadyAdded = true;
                }
            }
            if(!$alreadyAdded) {
                array_push($urlsToReplace, $urls[0][$i]);
            }
        }
        $numOfUrlsToReplace = count($urlsToReplace);
        for($i=0; $i<$numOfUrlsToReplace; $i++) {
            $str = str_replace($urlsToReplace[$i], "<a href=\"".$urlsToReplace[$i]."\" target=\"_blank\">".$urlsToReplace[$i]."</a> ", $str);
        }
        return $str;
    } else {
        return $str;
    }
}



function orientate($image, $orientation)
{
    switch ($orientation) {

        // 888888
        // 88
        // 8888
        // 88
        // 88
        case 1:
            return $image;

        // 888888
        //     88
        //   8888
        //     88
        //     88
        case 2:
            return $image->flip('h');


        //     88
        //     88
        //   8888
        //     88
        // 888888
        case 3:
            return $image->rotate(180);

        // 88
        // 88
        // 8888
        // 88
        // 888888
        case 4:
            return $image->rotate(180)->flip('h');

        // 8888888888
        // 88  88
        // 88
        case 5:
            return $image->rotate(-90)->flip('h');

        // 88
        // 88  88
        // 8888888888
        case 6:
            return $image->rotate(-90);

        //         88
        //     88  88
        // 8888888888
        case 7:
            return $image->rotate(-90)->flip('v');

        // 8888888888
        //     88  88
        //         88
        case 8:
            return $image->rotate(90);

        default:
            return $image;
    }
}

function setUrlSlug($kata){
    $new_string = strip_tags(trim($kata));
    $new_string1 = preg_replace("/[^a-zA-Z0-9-_\s]/", "", $new_string);
    $new_string2 = urlencode($new_string1);
    $new_string3 = str_replace('+','-',$new_string2);
    $new_string4 = str_replace('--','-',$new_string3);

    return strtolower($new_string4);
}

function pre($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
