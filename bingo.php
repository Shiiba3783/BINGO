<?php

while($stdin = trim(fgets(STDIN))) {
    $stdin_array[] = $stdin;
}
// 標準入力読み込み

$S = $stdin_array[0];  // ビンゴカードサイズ　$S列×$S行

//
for($i=1; $i<=$S; $i++) {
    $val =  explode(' ', $stdin_array[$i]);
    for($j=1; $j<=$S; $j++) {
        $my_word[$i][$j]['name']= $val[$j-1];
        $my_word[$i][$j]['state'] = "no_hit"; 
    }
}
//  自分の単語$my_word、[$i]列・[$j]行目　$my_word[1][1]からスタート　終了[$S]列・[$S行]目

$N = $stdin_array[$S+1]; //  選ばれた単語$N行

//
for($k=1; $k<=$N; $k++) {
    $past_word[$k] = $stdin_array[$k+$S+1];
}
//  選ばれた単語$past_word、[$k]個目　$past_word[1]からスタート　終了[$N]個目

//
for($j=1; $j<=$S; $j++) {
    $colum_hit[$j] = 0;
}
$row_hit = 0;
$slash_hit_right = 0;
$slash_hit_left = 0;
$result = "no";
//　カウント初期値をセット

for($i=1; $i<=$S; $i++) {
    $row_hit = 0;
    for($j=1; $j<=$S; $j++) {
        for($k=1; $k<=$N; $k++) {
            if($my_word[$i][$j]['name'] === $past_word[$k]){
                $my_word[$i][$j]['state'] = "hit";
            }
        }
        //
        if($my_word[$i][$j]['state'] === "hit") {
            // 
            $row_hit ++;
            if($row_hit >= $S) {
                $result = "yes";
                break;
            }
            // 横判定
            // 
            $colum_hit[$j] ++;
            if($colum_hit[$j] >= $S) {
                $result = "yes";
                break;
            }
            //　縦判定
            //
            if($i === $j) {
                $slash_hit_right ++;
            }
            if($i+$j === $S+1)  {
                $slash_hit_left ++;
            }
            if($slash_hit_right >= $S || $slash_hit_left >= $S) {
            $result = "yes";
            break;
            }
            // 斜め判定
        }
        // ビンゴ判定
    }
}

print $result;

?>

