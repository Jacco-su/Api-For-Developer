<?php
namespace app\api\model;

use think\Model;

class Jikexueyuan extends Model{
    public static function getType(){
        if(cache('jikexueyuan_type') != false) {
            return cache('jikexueyuan_type');
        }

        $html = jikexueyuan_http("http://www.jikexueyuan.com/course/");
        preg_match_all('/<dt class=\"hd\"><a cgid=\"\d+\" href=\"http:\/\/www\.jikexueyuan\.com\/course\/(\w+)\/\">(.*)<\/a><\/dt>/',$html,$temp,PREG_OFFSET_CAPTURE);
        foreach ($temp[1] as $key => $value) {
            $res[$key]['type'] = $value[0];
            $res[$key]['title'] = $temp[2][$key][0];
            if(isset($temp[1][$key+1][1])){
                $l = $temp[1][$key+1][1]-$temp[1][$key][1];
            }else{
                $l = 99999999;
            }
            $t = substr($html,$temp[1][$key][1],$l);
            preg_match_all('/<dt><a href=\"http:\/\/www\.jikexueyuan\.com\/course\/(\w+)\/\" cgid=\"\d+\">(.*)<\/a><\/dt>/',$t,$temp2,PREG_OFFSET_CAPTURE);
            $rest1 = [];
            foreach ($temp2[1] as $key2 => $value2) {
                $rest1[$key2] = [
                    'type'=>$temp2[1][$key2][0],
                    'title'=>$temp2[2][$key2][0],
                ];
                if(isset($temp2[1][$key2+1][1])){
                    $l2 = $temp2[1][$key2+1][1]-$temp2[1][$key2][1];
                }else{
                    $l2 = 99999999;
                }
                $t2 = substr($t,$temp2[1][$key2][1],$l2);
                preg_match_all('/<a href="http:\/\/www\.jikexueyuan\.com\/course\/(\w+)\/" cgid=\"\d+\">(.*)<\/a>/',$t2,$temp3);
                foreach ($temp3[1] as $key3 => $value3) {
                    $rest1[$key2]['list'][]=[
                        'type'=>$temp3[1][$key3],
                        'title'=>$temp3[2][$key3],
                    ];
                }
            }
            $res[$key]['list'] = $rest1;
        }

        cache('jikexueyuan_type',$res);
        return $res;
    }
    public static function getCourses($type='',$page=1){
        if(cache('jikexueyuan_courses_'.$type.'_'.$page) != false) {
            return cache('jikexueyuan_courses_'.$type.'_'.$page);
        }
        if($type==''){
            $url = "http://www.jikexueyuan.com/course/?pageNum=".$page;
        }else{
            $url = "http://www.jikexueyuan.com/course/".$type."/?pageNum=".$page;
        }
        $html = jikexueyuan_http($url);

        preg_match_all('/<h2 class=\"lesson-info-h2\"><a href=\"http:\/\/www\.jikexueyuan\.com\/course\/(\d+)\.html\" target=\"_blank\" jktag=\".*\">(.*)<\/a><\/h2>/',$html,$temp);
        preg_match_all('/<img src=\"(.*)\" class=\"lessonimg\"/',$html,$temp2);
        foreach ($temp[1] as $key => $value) {
            $res[] = [
                'id' => $temp[1][$key],
                'title' => $temp[2][$key],
                'img' => $temp2[1][$key],
            ];
        }

        cache('jikexueyuan_courses_'.$type.'_'.$page,$res);
        return $res;
    }
    public static function getVideos($id){
        if(cache('jikexueyuan_videos_'.$id) != false) {
            return cache('jikexueyuan_videos_' . $id);
        }

        $html = jikexueyuan_http("http://www.jikexueyuan.com/course/".$id.".html");
        preg_match_all('/\t<a href=\"http:\/\/www\.jikexueyuan\.com\/course\/(\d+)_(\d+)\.html\?ss=1\" jktag=\".*\">(.*)<\/a>/',$html,$temp);
        foreach ($temp[1] as $key => $value) {
            $res[] = [
                'cid' => $temp[1][$key],
                'vid' => $temp[2][$key],
                'title' => $temp[3][$key],
            ];;
        }

        cache('jikexueyuan_videos_'.$id,$res);
        return $res;
    }
    public static function getInfo($cid,$vid){
        if(cache('jikexueyuan_info_'.$cid.'_'.$vid) != false) {
            return cache('jikexueyuan_info_'.$cid.'_'.$vid);
        }

        $html = jikexueyuan_http("http://www.jikexueyuan.com/course/".$cid."_".$vid.".html?ss=1");
        preg_match('/<source src=\"(.*)\" type=\"video\/mp4\" \/>/',$html,$temp);
        preg_match('/<h1.*>(.*)<span class=\"jiu/',$html,$temp2);
        $res = [
            'title'=>$temp2[1],
            'url'=>$temp[1],
        ];

        cache('jikexueyuan_info_'.$cid.'_'.$vid,$res);
        return $res;
    }
}