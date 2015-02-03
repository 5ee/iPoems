<?php
function sortMultiArrayByKey($argArray, $argKey, $argOrder=SORT_DESC ){
        foreach ($argArray as $key => $row){
        $key_arr[$key] = $row[$argKey];
        }
        array_multisort($key_arr, $argOrder, $argArray);
        return $argArray;
 }
//--create random password--//
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

//
//function get_next_pic($database, $cat_id, $present_pic_id) {
//    $next_id = '';
//    $get_pics = $database->select("picture_poems_categories", "*", array("categories_id" => $cat_id));
//    $this_pic = array();
//
//    $count = 0;
//    if (!empty($get_pics)) {
//        foreach ($get_pics as $cat_pic) {
//            if (count($this_pic)) {
//                $next_id = $cat_pic['picture_poems_id'];
//                return $next_id;
//            } else {
//                if ($cat_pic['picture_poems_id'] == $present_pic_id) {
//                    $this_pic[] = 1;
//                }
//            }
//        }
//    }
//    return $next_id;
//}

//function get_prev_pic($database, $cat_id, $present_pic_id) {
//    $got_prev = false;
//    $prev_id = '';
//    $get_pics = $database->select("picture_poems_categories", "*", array("categories_id" => $cat_id));
//
//    $count = 0;
//    if (!empty($get_pics)) {
//        foreach ($get_pics as $cat_pic) {
//            if ($got_prev === true) {
//                return $prev_id;
//            } else {
//                if ($cat_pic['picture_poems_id'] == $present_pic_id) {
//                    $got_prev = true;
//                } else {
//                    $prev_id = $cat_pic['picture_poems_id'];
//                }
//            }
//        }
//    }
//    return $prev_id;
//}


//--fetch saved poems by user--//
function saved_poems($database, $user_id) {
    $saved_poems = array();
    $get_all_saved = $database->select("saves", "*", array("user_id" => $user_id));
    if(!empty($get_all_saved)){
        foreach($get_all_saved as $saved){
            $saved_poems[$saved['module_type']][] = $saved['module_id'];
        }
    }
    return $saved_poems;
}

//--get url--//
function get_url($database, $module, $id = null, $slug = null) {
    $get_aliases = $database->select('module_alias', '*');
    if (!empty($get_aliases)) {
        foreach ($get_aliases as $alias)
            $aliases[$alias['alias_name']] = $alias['module_name'];
    }
    $aliases_flip = array_flip($aliases);
    $url = main_url . "/" . ($aliases_flip[$module] ? $aliases_flip[$module] : $module);
    if ($id) {
        $url.="/" . $id;
    }
    if ($slug) {
        $url.="/" . $slug;
    }
    return $url;
}

//
//function alphabetically($topics, $options/* (MAX, ALPHABET, COUNT, ONLYCOUNT, LIMIT) */ = NULL) {
//    $alphabetically = array();
//    $start = 0;
//    $skipped = array();
//    asort($topics);
//    $a_z = range('a', 'z');
//    if (isset($options['LIMIT']) && is_numeric($options['LIMIT']))
//        $options['MAX'] = $options['LIMIT'];
//    if (isset($options['LIMIT']) && is_array($options['LIMIT'])) {
//        if (is_numeric($options['LIMIT'][0]) && is_numeric($options['LIMIT'][1])) {
//            $start = $options['LIMIT'][0];
//            $options['MAX'] = $options['LIMIT'][1];
//        }
//    }
//    //return $a_z;
//    foreach ($topics as $topic) {
//        if (isset($options['ALPHABET']) && $options['ALPHABET'] != '#') {
//            if (substr($topic['Author_slug'], 0, strlen($options['ALPHABET'])) == $options['ALPHABET']) {
//                if ($start != 0) {
//                    if (count($skipped[$options['ALPHABET']]) < $start) {
//                        $skipped[$options['ALPHABET']][] = $topic;
//                        continue;
//                    }
//                }
//                if (isset($options['MAX']) && is_numeric($options['MAX'])) {
//                    if (count($alphabetically[$options['ALPHABET']]['data']) < $options['MAX']) {
//                        $alphabetically[substr($topic['Author_slug'], 0, strlen($options['ALPHABET']))]['data'][] = $topic;
//                    }
//                } else {
//                    $alphabetically[$options['ALPHABET']]['data'][] = $topic;
//                }
//            }
//        } elseif (isset($options['ALPHABET']) && $options['ALPHABET'] == '#') {
//            if (!in_array(substr($topic['Author_slug'], 0, 1), $a_z)) {
//                if ($start != 0) {
//                    if (count($skipped['#']) < $start) {
//                        $skipped['#'][] = $topic;
//                        continue;
//                    }
//                }
//                if (isset($options['MAX']) && is_numeric($options['MAX'])) {
//                    if (count($alphabetically['#']['data']) < $options['MAX']) {
//                        $alphabetically['#']['data'][] = $topic;
//                    }
//                } else {
//                    $alphabetically['#']['data'][] = $topic;
//                }
//            }
//        } else {
//            if (in_array(substr($topic['Author_slug'], 0, 1), $a_z)) {
//                if ($start != 0) {
//                    if (count($skipped[substr($topic['Author_slug'], 0, 1)]) < $start) {
//                        $skipped[substr($topic['Author_slug'], 0, 1)][] = $topic;
//                        continue;
//                    }
//                }
//                if (isset($options['MAX']) && is_numeric($options['MAX'])) {
//                    if (count($alphabetically[substr($topic['Author_slug'], 0, 1)]['data']) < $options['MAX']) {
//                        $alphabetically[substr($topic['Author_slug'], 0, 1)]['data'][] = $topic;
//                    }
//                } else {
//                    $alphabetically[substr($topic['Author_slug'], 0, 1)]['data'][] = $topic;
//                }
//            } else {
//                if (isset($options['MAX']) && is_numeric($options['MAX'])) {
//                    if (count($alphabetically['#']['data']) < $options['MAX']) {
//                        $alphabetically['#']['data'][] = $topic;
//                    }
//                } else {
//                    $alphabetically['#']['data'][] = $topic;
//                }
//            }
//        }
//    }
//    ksort($alphabetically);
//    if (isset($options['COUNT']) && $options['COUNT'] === true) {
//        foreach ($alphabetically as $k => $v) {
//            $alphabetically[$k]['count'] = num_alpha_topics($k, $topics);
//        }
//    }
//    if (isset($options['ONLYCOUNT']) && $options['ONLYCOUNT'] === true) {
//        foreach ($alphabetically as $k => $v) {
//            $only_count[$k]['count'] = num_alpha_topics($k, $topics);
//        }
//        return $only_count;
//    }
//    return $alphabetically;
//}

//function num_alpha_topics($alphabet, $topics) {
//    $count = 0;
//    $a_z = range('a', 'z');
//    foreach ($topics as $topic) {
//        if ($alphabet != '#') {
//            if (substr($topic['Author_slug'], 0, strlen($alphabet)) == $alphabet) {
//                $count++;
//            }
//        } else {
//            if (!in_array(substr($topic['Author_slug'], 0, 1), $a_z)) {
//                $count++;
//            }
//        }
//    }
//    return $count;
//}

//--check topic id is exist--//
function is_topic($database, $topic_id) {
    return $database->has("topics", array("topic_id" => $topic_id));
}

//--get topic information--//
function get_topic($database, $topic_id) {
    return $database->get("topics", "*", array("topic_id" => $topic_id));
}

//function get_topic_quotes($database, $author_id, $options/* COUNT(true), LIMIT, ONLYCOUNT(true) */ = NULL) {
//    if (isset($options['ONLYCOUNT']) && $options['ONLYCOUNT'] === true) {
//        return $database->count('poems', array('author_id' => $author_id));
//    }
//    $return_data['data'] = $database->select('poems', '*', array('author_id' => $author_id));
//    if (isset($options['LIMIT'])) {
//        $return_data['data'] = $database->select('poems', '*', array('AND' => array('author_id' => $author_id, 'status' => 1), 'LIMIT' => $options['LIMIT']));
//    }
//
//    if (isset($options['COUNT']) && $options['COUNT'] === true) {
//        $return_data['count'] = $database->count('poems', array('AND' => array('author_id' => $author_id, 'status' => 1)));
//    }
//    return $return_data;
//}

function get_topic_poems($database, $topics_id, $options/* COUNT(true), LIMIT, ONLYCOUNT(true) */ = NULL) {
    if (isset($options['ONLYCOUNT']) && $options['ONLYCOUNT'] === true) {
        return $database->count('poems_topics', array('topics_id' => $topics_id));
    }
    $return_data['data'] = $database->select('poems_topics', '*', array('topics_id' => $topics_id));
    if (isset($options['LIMIT'])) {
        $return_data['data'] = $database->select('poems_topics', '*', array('topics_id' => $topics_id, 'LIMIT' => $options['LIMIT']));
    }

    if (isset($options['COUNT']) && $options['COUNT'] === true) {
        $return_data['count'] = $database->count('poems_topics', array('topics_id' => $topics_id));
        $return_data['present_count'] = count($return_data['data']);
    }
    if (!empty($return_data['data'])) {
        $poems_ids = array();
        foreach ($return_data['data'] as $poem_info) {
            if (!in_array($poem_info['poems_id'], $poems_ids)) {
                $poems_ids[] = $poem_info['poems_id'];
            }
        }
        $return_data['data'] = $poems_ids;
    }
    return $return_data;
}

//--get author information--//
function get_author($database, $author_id, $options = NULL) {
    $return_data = array();
    if (is_numeric($author_id)) {
        $return_data = $database->get('authors', '*', array('id' => $author_id));
    }
    return $return_data;
}

//--get poem information--//
function get_poem($database, $poem_id, $options = NULL) {
    $return_data = array();
    if (is_numeric($poem_id)) {
        $return_data = $database->get('poems', '*', array('id' => $poem_id));
    }
    return $return_data;
}

//--check poem id is exist--//
function check_poem($database, $poem_id) {
    return $database->has("poems", array("id" => $poem_id));
}

//--get all poems of author--//
function get_author_poems($database, $author_id, $options/* COUNT(true), LIMIT, ONLYCOUNT(true) */ = NULL) {
    if (isset($options['ONLYCOUNT']) && $options['ONLYCOUNT'] === true) {
        return $database->count('poems', array('author_id' => $author_id));
    }
    $return_data['data'] = $database->select('poems', '*', array('author_id' => $author_id));
    if (isset($options['LIMIT'])) {
        $return_data['data'] = $database->select('poems', '*', array('AND' => array('author_id' => $author_id, 'status' => 1), 'LIMIT' => $options['LIMIT']));
    }

    if (isset($options['COUNT']) && $options['COUNT'] === true) {
        $return_data['count'] = $database->count('poems', array('AND' => array('author_id' => $author_id, 'status' => 1)));
    }
    return $return_data;
}

/*
  function get_user_rated($database, $options = null){
  $get_top_rated = array(); $start = null; $limit = null;
  if(is_numeric($options) && $options != 0){

  }
  if(isset($options['LIMIT'])){
  if(is_numeric($options['LIMIT']) && $options['LIMIT'] != 0){
  $limit = $options['LIMIT'];
  } else if(is_array($options['LIMIT'])){
  if(is_numeric($options['LIMIT'][0])){
  $start = $options['LIMIT'][0];
  }
  if(is_numeric($options['LIMIT'][1]) && $options['LIMIT'][1] != 0){
  $limit = $options['LIMIT'][1];
  }
  }
  }

  $get_all = $database->select("ratings","*");
  if(!empty($get_all)){
  foreach($get_all as $all){
  $avg_rating = avg_rating($all['module_type'], $all['user_id'], $database);
  $all_module_data[$all['module_type']][$all['user_id']] = $avg_rating;
  }
  }

  //pr($all_module_data);
  foreach($all_module_data as $module_type=>$v){
  //arsort($all_module_data[$module_type]);
  $skipped = array();$modules = array();
  foreach($v as $user_id=>$rating){
  if($start){
  if(count($skipped) < $start){
  $skipped[] = $user_id;
  } else {
  if($limit){
  if(count($modules) < $limit){
  $modules[] = $user_id;
  }
  } else {
  $modules[] = $user_id;
  }
  }
  } else {
  if($limit){
  if(count($modules) < $limit){
  $modules[] = $user_id;
  }
  } else {
  $modules[] = $user_id;
  }
  }
  krsort($modules);
  $get_top_rated[$module_type] = $modules;
  }
  }
  if(isset($options['MODULE'])){
  $new_rated = array();
  if(!is_array($options['MODULE'])){
  $required_modules = explode(",",$options['MODULE']);
  } else {
  $required_modules = $options['MODULE'];
  }
  foreach($get_top_rated as $module_type => $v){
  if(in_array($module_type, $required_modules)){
  $new_rated[$module_type] = $v;
  }
  }
  $get_top_rated = $new_rated;
  }
  return $get_top_rated;
  } */

//--get poems rating given by user--//
function user_given_ratings($database, $user_id, $options = null) {
    $user_given_ratings = array();
    $get_user_poem = $database->select("ratings", "*", array("user_id" => $user_id));
    if (!empty($get_user_poem)) {
        foreach ($get_user_poem as $rated) {
            $user_given_ratings[$rated['module_type']][] = array('id' => $rated['module_id'], 'value' => $rated['value']);
        }
    }
    return $user_given_ratings;
}


//--get user info--//
function get_user_info($database) {
    $user_image = $database->select("users", "*", array("id" => $_SESSION['user_id']));
    return $user_image;
}

//--get add zones--//
function get_ad_zones($database) {
    $getads = $database->select("ad_zones", "*", array("status" => 1));
    return $getads;
}

//--insert user in database--//
function user_insert($database, $data) {
    $user_insert = $database->insert("users", $data);
    return $user_insert;
}

//--change password--//
function select_password($database, $user_email, $checkpassword) {
    $get_user = $database->select("users", "password", array("AND" => array("user_email" => $user_email, "password" => $checkpassword)));
    return $get_user;
}

//--update password--//
function update_password($database, $newpass, $user_email) {
    $updatepassword = $database->update("users", array("password" => $newpass), array("AND" => array("user_email" => $user_email)));
    return $updatepassword;
}

//--edit profile--//
function edit_profile($database, $data, $user_id) {
    $edit_profile = $database->update("users", $data, array("id" => $user_id));
    return $edit_profile;
}

//--insert submission--//
function insert_submission($database, $data) {
    $submission = $database->insert("submission", $data);
    return $submission;
}

//--view increment--//
function view_increment($database, $poem_id) {
    $update_poem = $database->update("poems", array("views[+]" => 1), array("id"=>$poem_id));
    return $update_poem;
}

//--author view increment--//
function author_view_increment($database, $author_id) {
    $update_poet = $database->update("authors", array("views[+]" => 1), array("id"=>$author_id));
    return $update_poet;
}

//--fetch all topics--//
function all_topics($database) {
    $all_topics = $database->select("topics","*");
    return $all_topics;
}

//--fetch all authors--//
function all_authors($database) {
    $all_authors = $database->select("authors","*");
    return $all_authors;
}

//--get all authors--//
function get_all_authors($database,$next_number,$perpage) {
    $get_poet = $database->select("authors","*", array('LIMIT'=>array($next_number,$perpage)));
    return $get_poet;
}
//--fetch all topic with limit--//
function all_topic($database) {
    $all_topics = $database->select("topics", "*", array("LIMIT" => 10, "ORDER" => "topic_id DESC"));
    return $all_topics;
}

//--fetch all author with limit--//
function all_author($database) {
    $all_authors = $database->select("authors", "*", array("LIMIT" => 10, "ORDER" => "id DESC"));
    return $all_authors;
}
//--get poem of the day--//
function poem_of_day($database) {
    $get_poem_of_day = $database->get('poems', '*', array("status" => 1));
    return $get_poem_of_day;
}

//--fetch all pages--//
function all_pages($database) {
    $all_pages = $database->select("pages", "*",array("ORDER"=>"id ASC"));
    return $all_pages;
}

//--get pages information--//
function page_info($database, $page_id) {
    $page_info = $database->select("pages","*", array("id"=>$page_id));
    return $page_info;
}

//--delete favourite poem and poet--//
function delete_favourite_poem($database, $module_id,$module_type,$user_id) {
    $delete_poem = $database->delete("ratings",array("AND"=>array("module_id"=>$module_id,"module_type"=>$module_type,"user_id"=>$user_id)));
    return $delete_poem;
}

//--delete saved poem and poet--//
function delete_saves_poem($database, $module_id,$module_type,$user_id) {
    $delete_poem = $database->delete("saves",array("AND"=>array("module_id"=>$module_id,"module_type"=>$module_type,"user_id"=>$user_id)));
    return $delete_poem;
}

//magic_fill($database, "poems", "topics", "topic_id", 20);
//magic_update($database, "poems", "topics", "topic_id");
//magic_fill($database, "poems", "categories", "category_id", 20);
//magic_update($database, "poems", "categories", "category_id");
?>
