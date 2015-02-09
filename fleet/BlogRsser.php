<?php
namespace Fleet;
use \Suin\RSSWriter\Feed;
use \Suin\RSSWriter\Channel;
use \Suin\RSSWriter\Item;

class BlogRsser {

  private $blogTitle;
  private $blogDescription;
  private $siteUrl;

  public function __construct($blogTitle, $blogDescription, $siteUrl) {
    $this->blogTitle = $blogTitle;
    $this->blogDescription = $blogDescription;
    $this->siteUrl = $siteUrl;
  }

  // Turn an array of posts into an RSS feed
  public function generate_rss($posts){

    $feed = new Feed();
    $channel = new Channel();

    $channel
      ->title($this->blogTitle)
      ->description($this->blogDescription)
      ->url($this->siteUrl)
      ->appendTo($feed);

    foreach($posts as $p){

      $item = new Item();
      $item
        ->title($p->title)
        ->description($p->body)
        ->url($p->url)
        ->appendTo($channel);
    }

    echo $feed;
  }

}
