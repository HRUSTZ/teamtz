<?
$action = $query[3];

if($action == 'add'){
  if($_POST[name] != '' && $_POST[text] != ''){
    $control = false;
    
    $name = $_POST[name];
    $text = $_POST[text];
    $date = date("Y-m-d H:i:s");
    if($_FILES[photo][error] != 0){
      $photo = '/files/news/default.jpg';
    } else{
      $photo = '/files/news/'.translate($_FILES[photo][name]);      
      if(!move_uploaded_file($_FILES['photo']['tmp_name'], ROOT.$photo)){
        $control = 'Ошибка при загрузке фотографии';
      }
    }
    
    if(!$control){
      $mysqli -> query("INSERT INTO News(name, text, photo, date) VALUES('$name', '$text', '$photo', '$date')");
      header('Location: /panel');
      exit();
    } else{
      echo ($control);
    }
  } else{
    echo('Незаполнены все поля');
  }
}

$title = 'Добавление новости';
$content = tpl('panel_news_add', $result);