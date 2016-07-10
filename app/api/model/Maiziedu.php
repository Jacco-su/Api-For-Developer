<?php
namespace app\api\model;

use think\Model;

class Maiziedu extends Model{
    public static function getCategory(){
        if(cache('maiziedu_category') != false) {
            return cache('maiziedu_category');
        }

        $html = http("http://www.maiziedu.com/");
        preg_match_all('/<p class=\"second\"><a href=\"\/course\/(.*)\/\" target=\"_blank\">(.*)学习路线<\/a><\/p>/',$html,$temp);
        foreach ($temp[1] as $key => $value) {
            $res[$key]['id'] = $temp[1][$key];
            $res[$key]['title'] = $temp[2][$key];
        }

        cache('maiziedu_category',$res);
        return $res;
    }
    public static function getCourses($id){
        if(cache('maiziedu_courses_'.$id) != false) {
            return cache('maiziedu_courses_' . $id);
        }

        $html = codingke_http("http://www.maiziedu.com/course/".$id."/");
        preg_match_all('/<dl class=\"course-stage-dl zygogo\" id=\"\w+\">\s*<dt>(.*)<\/dt>/',$html,$temp,PREG_OFFSET_CAPTURE);
        if(empty($temp[0]))return null;
        foreach ($temp[1] as $key => $value) {
            $res[$key]['title'] = $value[0];
            if(isset($temp[1][$key+1][1])){
                $l = $temp[1][$key+1][1]-$temp[1][$key][1];
            }else{
                $l = 99999999;
            }
            $t = substr($html,$temp[1][$key][1],$l);
            preg_match_all("/<a href=\"\/course\/(\d+)\/\" title=\"(.*)\">\n/",$t,$temp2);
            preg_match_all("/<img src=\"(.*)\" alt=\".*\" border=\"0\"><\/a>/",$t,$temp3);
            foreach ($temp2[1] as $key2 => $value2) {
                $res[$key]['list'][] = array('id'=>$temp2[1][$key2],'title'=>$temp2[2][$key2],'thumbnail'=>'http://www.maiziedu.com/'.$temp3[1][$key2]);
            }
        }

        cache('maiziedu_courses_'.$id,$res);
        return $res;
    }
    public static function getVideos($id){
        if(cache('maiziedu_videos_'.$id) != false) {
            return cache('maiziedu_videos_' . $id);
        }

        $html = codingke_http("http://www.maiziedu.com/course/".$id."/");
        preg_match_all('/<li><a href="\/course\/'.$id.'-(\d+)\/" target="_blank" class="font14 color66"><span class="fl">(.*)<\/span><span/',$html,$temp);
        if(empty($temp[0]))return null;
        foreach ($temp[1] as $key => $value) {
            $res[] = array('id'=>$temp[1][$key],'title'=>$temp[2][$key]);
        }

        cache('maiziedu_videos_'.$id,$res);
        return $res;
    }
    public static function getInfo($cid,$vid){
        if(cache('maiziedu_info_'.$cid.'_'.$vid) != false) {
            return cache('maiziedu_info_'.$cid.'_'.$vid);
        }

        $html = codingke_http("http://www.maiziedu.com/course/".$cid."-".$vid."/");
        preg_match("/<title>(.*)-.*-麦子学院<\/title>/",$html,$title);
        preg_match("/<source src=\"(.*)\" type='video\/mp4' \/>/",$html,$temp);
        $res['title'] = $title[1];
        $res['url'] = $temp[1];

        cache('maiziedu_info_'.$cid.'_'.$vid,$res);
        return $res;
    }
}