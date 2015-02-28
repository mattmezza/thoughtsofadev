<?php
namespace Fleet;

use \ParsedownExtra;

/* General Blog Functions */
class BlogManager {

  private $articleDir;
  private $postPerPage;
  private $siteUrl;
  private $cache;

  public function __construct($articleDir, $postPerPage, $siteUrl, $cache) {
    $this->articleDir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $articleDir . DIRECTORY_SEPARATOR;
    $this->postPerPage = $postPerPage;
    $this->siteUrl = $siteUrl;
    $this->cache = $cache;
  }

  public function get_post_links() {
    $posts = $this->get_post_names();
    $links = array();
    foreach($posts as $k=>$v){
      $link = new \stdClass;
      $link->path = $v;
      $arr = explode('_', $v);
      $link->name = str_replace('.md', '', $arr[1]);
      $timestr = str_replace($this->articleDir,'',$arr[0]);
      $bits = explode('-', $timestr);
      $link->year = $bits[0];
      $link->month = $bits[1];
      $link->day = $bits[2];
      $date = strtotime($timestr);
      $link->url = $this->siteUrl . date('Y/m', $date).'/'.str_replace('.md','',$arr[1]);
      $links[] = $link;
    }
    return $links;
  }

  public function get_post_names() {
    $_cache = array();
    if(empty($_cache)){
      // Get the names of all the
      // posts (newest first):
      $_cache = array_reverse(glob($this->articleDir . "*.md"));
    }
    return $_cache;
  }

  public function get_posts($page = 1, $perpage = 0){
    if($perpage == 0){
      $perpage = $this->postPerPage;
    }
    $posts = $this->get_post_names();
    // Extract a specific page with results
    $posts = array_slice($posts, ($page-1) * $perpage, $perpage);
    $tmp = array();

    foreach($posts as $k=>$v){
      $post = new \stdClass;
      $parsedown = new ParsedownExtra();
      // Extract the date
      $arr = explode('_', $v);
      $post->date = strtotime(str_replace($this->articleDir,'',$arr[0]));

      // The post URL
      $post->url = $this->siteUrl . date('Y/m', $post->date).'/'.str_replace('.md','',$arr[1]);

      if($this->cache) {
        if(file_exists($v.".html")) {
          $postContent = file_get_contents($v.".html");
        } else {
          $postContent = file_get_contents($v);
        }
      } else {
        $postContent = file_get_contents($v);
      }
      $matches = array();
      $toCache = "";
      preg_match('/[\s\S]*[-]+:endmetadata:[-]+/', $postContent, $matches);
      # if we have metadata defined
      if(count($matches)>0){
        $toCache = $matches[0]."\n";
        $metadata = preg_replace('/[-]+:endmetadata:[-]+/', "", $matches[0]);
        $metas = explode("\n", $metadata);
        $metas = array_slice($metas, 0, count($metas) -1);
        foreach($metas as $meta) {
          $bits = explode("->", $meta);
          if($bits[0]=="tags") {
            $post->tags = array();
            $tags = explode(", ", $bits[1]);
            foreach($tags as $tag) {
              $post->tags[] = $tag;
            }
          } else if($bits[0] == "author") {
            $post->author = $bits[1];
            $biofile = dirname($this->articleDir) . DIRECTORY_SEPARATOR . 'biographies' . DIRECTORY_SEPARATOR . $bits[1] . ".md";
            if(file_exists($biofile)) {
              if($this->cache) {
                $m = array();
                preg_match('/[-]+:startbio:[-]+[\s\S]*[-]+:endbio:[-]+/', $postContent, $m);
                if(count($m)>0) {
                  // bio is cached...extracting
                  $post->authorbio = preg_replace('/[-]+:((start)|(end))bio:[-]+/', "", $m[0]);
                  $postContent = preg_replace('/[-]+:startbio:[-]+[\s\S]*[-]+:endbio:[-]+/', "", $postContent);
                } else {
                  $post->authorbio = $parsedown->text(file_get_contents($biofile));
                  $toCache .= "---:startbio:---\n".$post->authorbio."\n---:endbio:---\n";
                }
              } else {
                $post->authorbio = $parsedown->text(file_get_contents($biofile));
              }
            }
          } else {
            $key = $bits[0];
            $value = $bits[1];
            $post->{$key} = $value;
          }
        }
        $postContent = preg_replace('/[\s\S]*[-]+:endmetadata:[-]+/', "", $postContent);
        if($this->cache) {
          if(!file_exists($v.".html")) {
            $content = $parsedown->text($postContent);
            // write cache file
            file_put_contents($v.".html", $toCache.$content);
          } else {
            $content = $postContent;
          }
        } else {
          // Get the contents and convert it to HTML
          $content = $parsedown->text($postContent);
        }
      } else {
        if($this->cache) {
          if(!file_exists($v.".html")) {
            $content = $parsedown->text($postContent);
            // Extract the title and body
            $arr = explode('</h1>', $content);
            $post->title = str_replace('<h1>','',$arr[0]);
            $content = $arr[1];
            // write cache file
            file_put_contents($v.".html", $content);
          }
        } else {
          // Get the contents and convert it to HTML
          $content = $parsedown->text($postContent);
          // Extract the title and body
          $arr = explode('</h1>', $content);
          $post->title = str_replace('<h1>','',$arr[0]);
          $content = $arr[1];
        }
      }
      $post->body = $content;
      $tmp[] = $post;
    }
    return $tmp;
  }

  // Find post by year, month and name
  function find_post($year, $month, $name){

    foreach($this->get_post_names() as $index => $v){
      if( strpos($v, "$year-$month") !== false && strpos($v, $name.'.md') !== false){

        // Use the get_posts method to return
        // a properly parsed object

        $arr = $this->get_posts($index+1,1);
        return $arr[0];
      }
    }

    return false;
  }

  // Helper function to determine whether
  // to show the pagination buttons
  public function has_pagination($page = 1){
    $total = count($this->get_post_names());

    return array(
      'prev'=> $page > 1,
      'prevpage'=>$page-1,
      'next'=> $total > $page*$this->postPerPage,
      'nextpage'=>$page+1
    );
  }


  // Turn an array of posts into a JSON
  function generate_json($posts){
    return json_encode($posts);
  }

}
