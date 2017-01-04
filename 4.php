<?php
mb_internal_encoding('utf-8');
error_reporting(E_ALL);


function api_vk_answer($url) {
  $get_vk_answer = file_get_contents($url);
  $arr_vk = json_decode($get_vk_answer, true);
  $result = $arr_vk["response"];
  return $result;
}


function get_vk_posts() {
  $notes = api_vk_answer('https://api.vk.com/method/newsfeed.search?q=%22%D1%81%20%D0%BD%D0%BE%D0%B2%D1%8B%D0%BC%20%D0%B3%D0%BE%D0%B4%D0%BE%D0%BC%22');
  array_shift($notes);

  $ready_notes = array();
  foreach ($notes as $note) {
    if (array_key_exists("attachment", $note)) {
      if ($note["attachment"]["type"] === "photo") {
        $ready_notes[] = create_note($note);
      }
    }
  }

  $ready_notes = sorted($ready_notes);
  return $ready_notes;
}


function create_note($note) {
  $html_note["id"] = $note["id"];
  $html_note["name"] = get_name($note["id"]);
  $html_note["date"] = date('d.m.Y H:i', $note["date"]);
  if ($note["text"] != null) {
    $html_note["text"] = get_text($note["text"]);
  }
  else {
    $html_note["text"] = 'Нет описания.';
  }
  $html_note["image"] = $note["attachment"]["photo"]["src"];
  $html_note["likes"] = $note["likes"]["count"];

  return $html_note;
}


function get_name($id) {
  $url = 'https://api.vk.com/method/users.get?user_id=' . $id . '&v=5.52';
  $name = api_vk_answer($url);
  return $name[0]["first_name"] . ' ' . $name[0]["last_name"];
}


function get_text($text) {
  $text = five_words($text);
  $punctuation = array('.', ',', '?', '!', ':', ';', '(', ')');
  $stop = mb_strlen($text) - 1;
  foreach ($punctuation as $mark) {
    if (mb_strpos($text, $mark) != false) {
      if (mb_strpos($text, $mark) < $stop){
        $stop = mb_strpos($text, $mark);
      }
    }
  }
  if ($text[$stop] === ".") {
    return mb_substr($text, 0, $stop);
  }
  else {
    return mb_substr($text, 0, $stop) . '...';
  }
}


function five_words($text) {
  $short_text = '';
  $text_arr = explode(' ', $text);
  if (count($text_arr) >= 5) {
    for ($i = 0; $i < 5; $i++) {
      $short_text = $short_text . $text_arr[$i] . ' ';
    }
  }
  else {
    for ($i = 0; $i < count($text_arr); $i++) {
      $short_text = $short_text . $text_arr[$i] . ' ';
    }
  }
  return $short_text;
}


function sorted($note_arr) {
  if (count($note_arr) <= 1) {
    return $note_arr;
  }
  else {
    $mid = (int) (count($note_arr) / 2);
    $note_arr1 = array_slice($note_arr, 0, $mid);
    $note_arr2 = array_slice($note_arr, $mid);
    $sorted_arr1 = sorted($note_arr1);
    $sorted_arr2 = sorted($note_arr2);
    if ($sorted_arr2[0]["likes"] <= $sorted_arr1[count($sorted_arr1) - 1]["likes"]) {
      return array_merge($sorted_arr1, $sorted_arr2);
    }
    else {
      return array_merge($sorted_arr2, $sorted_arr1);
    }
  }
}

echo <<<HTML
<!DOCTYPE html>
<html>
<head>
  <link href="style.css" rel="stylesheet">
</head>
<body>
HTML;

foreach (get_vk_posts() as $note) {
  echo '<div class="post">
    <h2>
      <a href="http://vk.com/id' . $note['id'] . '">
      ' . $note['name'] . '
      </a>
    </h2>
    <div class="text">
      <span class="time">
        ' . $note['date'] . '
      </span>
      </br>
      ' . $note['text'] . '
      </br>
      <span class="likes">
        &#9829;' . $note['likes'] . '
      </span>
    </div>
    <img src="' . $note['image'] . '">
  </div>';
};

echo <<<HTML
</body>
</html>
HTML;
