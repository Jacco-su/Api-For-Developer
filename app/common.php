<?php
function http($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}
function codingke_http($url){
    $cookie= "PHPSESSID=5ud81unj8o4ie2kvoo2tjbukj5; CNZZDATA1256018185=1207588728-1467977912-%7C1467977912; Hm_lvt_9f92046de4640f3c08cf26535ffdd93c=1467981036; Hm_lpvt_9f92046de4640f3c08cf26535ffdd93c=1467981052; looyu_id=7b2f5679aab9c4139d87d27a6197bcc533_20000323%3A1; looyu_20000323=v%3A7b2f5679aab9c4139d87d27a6197bcc533%2Cref%3A%2Cr%3A%2Cmon%3Ahttp%3A//m8103.looyu.com/monitor%2Cp0%3Ahttp%253A//old.codingke.com/";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIE,$cookie);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}
function jikexueyuan_http($url){
    $cookie= "yxadclose=ever-close; stat_uuid=1460104684229221246432; sensorsdata2015jssdkcross=%7B%22distinct_id%22%3A%22153f5425685314-07b7ca1b607b38-60547721-1fa400-153f542568631e%22%7D; gr_user_id=f681b34e-4720-47c4-8ac0-b6669e774d05; _ga=GA1.2.1713360682.1460127489; stat_fromWebUrl=; stat_ssid=1468935813792; undefined=; QINGCLOUDELB=84b10773c6746376c2c7ad1fac354ddfd562b81daa2a899c46d3a1e304c7eb2b|V4EnQ|V4EiU; looyu_20001269=v%3A885aacba02695dbd31ebce7da2fff88bf4%2Cref%3A%2Cr%3A%2Cmon%3Ahttp%3A//m9100.talk99.cn/monitor%2Cp0%3Ahttp%253A//my.jikexueyuan.com/user/setting/; gr_cs1_ab9fd76e-eb29-40e2-bbb4-b9c709f36164=uid%3A3684132; stat_isNew=0; gr_session_id_aacd01fff9535e79=ab9fd76e-eb29-40e2-bbb4-b9c709f36164; _99_mon=%5B0%2C0%2C0%5D; uname=loveFrankhe; uid=3684132; code=5YP349; authcode=fea165XOAWiT1uTGGvDDFqtJ%2B%2BJ5FM2Oljc0QH4Vue2d8Ak2zAVNhGurIj6pDS33dnIBgTV2aOnd7nJzeuPjwYaPLWN%2BUrU26%2BVvNPCesxSbIphiF78uNHi9rtj63%2FY; level_id=3; is_expire=0; domain=5045012563; connect.sid=s%3AZQnFwSsu12uhfdDB0BHzC6be2ZJ2KVTX.UHUd4L4aKcAk1u1I%2BP4pCyC0t7%2FgLM7wiF0SdsAwPkU; ohterlogin=qq; looyu_id=1eaabd6e1c2e00a9618c537731112a44e9_20001269%3A5";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIE,$cookie);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $ret = curl_exec($ch);
    curl_close($ch);
    return $ret;
}





