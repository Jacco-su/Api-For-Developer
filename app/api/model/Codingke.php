<?php
namespace app\api\model;

use think\Model;

class Codingke extends Model{
    public static function getCourses($id){
        if(cache('codingke_courses_'.$id) != false) {
            return cache('codingke_courses_'.$id);
        }

        $html = codingke_http("http://old.codingke.com/courses-".$id."-2.html");
        preg_match_all('/<h2 class=".*">(.*)<\/h2>/',$html,$temp,PREG_OFFSET_CAPTURE);
        foreach ($temp[1] as $key => $value) {
            $res[$key]['title'] = $value[0];
            if(isset($temp[1][$key+1][1])){
                $l = $temp[1][$key+1][1]-$temp[1][$key][1];
            }else{
                $l = 99999999;
            }
            $t = substr($html,$temp[1][$key][1],$l);
            preg_match_all("/<a  title='(.*)'  class=\"btn ckbg-shadow\" href=\"http:\/\/old.codingke.com\/course\/(\d*)\" >查看课程<\/a>/",$t,$temp2);
            foreach ($temp2[1] as $key2 => $value2) {
                $res[$key]['list'][] = array('id'=>$temp2[2][$key2],'title'=>$temp2[1][$key2]);
            }
        }

        cache('codingke_courses_'.$id,$res);
        return $res;
    }
    public static function getVideos($id){
        if(cache('codingke_videos_'.$id) != false) {
            return cache('codingke_videos_' . $id);
        }

        $html = codingke_http("http://old.codingke.com/course/".$id);
        preg_match_all('/<h2 class="tree.*\s*.*\s*.*\s*(.*)\s*<\/h2>/',$html,$temp,PREG_OFFSET_CAPTURE);
        if(empty($temp[0]))return null;
        foreach ($temp[1] as $key => $value) {
            $res[$key]['title'] = $value[0];
            if(isset($temp[1][$key+1][1])){
                $l = $temp[1][$key+1][1]-$temp[1][$key][1];
            }else{
                $l = 99999999;
            }
            $t = substr($html,$temp[1][$key][1],$l);
            preg_match_all("/<a .* id='lesson-(\d*)'.*\s*.*\s*<\/span>(.*)\s*<div .*>(.*)</",$t,$temp2);
            foreach ($temp2[1] as $key2 => $value2) {
                $res[$key]['list'][] = array('id'=>$temp2[1][$key2],'title'=>$temp2[2][$key2]);
            }
        }

        cache('codingke_videos_'.$id,$res);
        return $res;
    }
    public static function getInfo($cid,$vid){
        if(cache('codingke_info_'.$cid.'_'.$vid) != false) {
            return cache('codingke_info_'.$cid.'_'.$vid);
        }

        $json = codingke_http("http://old.codingke.com/course/".$cid."/lesson/".$vid);
        $temp = json_decode($json,true);
        if(!$temp['title']){
            return false;
        }
        $res['title'] = $temp['title'];
        $res['url'] = $temp['mediaHLSUri'];

        cache('codingke_info_'.$cid.'_'.$vid,$res);
        return $res;
    }
}