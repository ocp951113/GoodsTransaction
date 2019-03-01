<?php
	foreach($_FILES['file']['tmp_name'] as $k=>$v){
      if(is_uploaded_file($_FILES['file']['tmp_name'][$k])){
        $save='./picture/'.$_FILES['file']['name'][$k];
        if($result){
          move_uploaded_file($_FILES['file']['tmp_name'][$k],$save);
        }
      }
    }
	echo '上传成功';
?>
