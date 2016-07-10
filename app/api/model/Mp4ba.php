<?php
namespace app\api\model;

use think\Model;

class Mp4ba extends Model{
    public static function getCategory(){
        if(cache('mp4ba_category') != false) {
            return cache('mp4ba_category');
        }

        $html = http('http://www.mp4ba.com');
        preg_match_all('/<li><a href="index\.php\?sort_id=(\d+)">(.*)<\/a><\/li>/',$html,$temp);
        foreach ($temp[0] as $key => $value) {
            $res[] = array('id'=>$temp[1][$key],'title'=>$temp[2][$key]);
        }

        cache('mp4ba_category',$res,86400);
        return $res;
    }
    public static function getLists($category=0,$page=1){
        if(cache('mp4ba_lists_'.$category.'_'.$page) != false) {
            return cache('mp4ba_lists_'.$category.'_'.$page);
        }

        $html = http('http://www.mp4ba.com/index.php?sort_id='.$category.'&page='.$page);
        preg_match('/<a href=\".*\" class=\"pager-last active\" target=\"_self\">(\d+)<\/a>/',$html,$temp);
        if(isset($temp[1]))$maxpage[] = $temp[1];
        preg_match('/<span class="current">(\d+)<\/span>/',$html,$temp);
        if(isset($temp[1]))$maxpage[] = $temp[1];
        preg_match('/<a href=\".*\" target=\"_self\">(\d+)<\/a>/',$html,$temp);
        if(isset($temp[1]))$maxpage[] = $temp[1];
        $res['maxpage'] = max($maxpage);

        preg_match_all('/<a .*href=\"show\.php\?hash=(.*)\" target=\"_blank\">\r\n(.*)<\/a>/',$html,$temp);
        foreach ($temp[0] as $key => $value) {
            $res['list'][] = array('id'=>$temp[1][$key],'title'=>trim($temp[2][$key]));
        }

        cache('mp4ba_lists_'.$category.'_'.$page,$res);
        return $res;
    }
    public static function getItem($id){
        if(cache('mp4ba_item_'.$id) != false) {
            return cache('mp4ba_item_'.$id);
        }

        $html = http('http://www.mp4ba.com/show.php?hash='.$id);
        preg_match('/<title>(.*) - 高.*<\/title>/',$html,$temp);
        $res['title']=$temp[1];
        preg_match_all('/<div class="intro">/',$html,$temp,PREG_OFFSET_CAPTURE);
        $html2 = substr($html, $temp[0][0][1]);
        preg_match_all("/<img[^>]*\s*\" src=\"([^'\"]+)\" \/>/", $html2,$temp,PREG_OFFSET_CAPTURE);
        $res['cover']=$temp[1][0][0];
        for ($i=1; $i < count($temp[1]); $i++) {
            $res['preview'][] = $temp[1][$i][0];
        }
        $res['info'] = str_replace("\r","<br>",trim(strip_tags(substr($html2, $temp[0][0][1],$temp[1][count($temp[1])-1][1]-$temp[0][0][1]))));
        preg_match_all('/<a id=\"magnet\" href=\"(.*)\">使用磁力链下载<\/a>/',$html,$temp);
        $res['resource'][] = $temp[1][0];

        cache('mp4ba_item_'.$id,$res,86400);
        return $res;
    }
}