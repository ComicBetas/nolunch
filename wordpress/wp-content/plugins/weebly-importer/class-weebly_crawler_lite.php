<?php

libxml_use_internal_errors(true);

define('STATUS_DONE', 'DONE_CRAWLING');
define('STATUS_CRAWLING', 'CRAWLING');

class post_crawler extends crawler_base {

    private $crawler;
    private $post_date_format = 'm/d/Y';
    public $remove_style = true;
    public $remove_class = true;

    public function __construct($target_url, $remove_style_attr = true, $remove_class_attr = true) {
        parent::__construct($target_url);
        $this->remove_class = $remove_class_attr;
        $this->remove_style = $remove_style_attr;

        $contents = file_get_contents($this->root . $this->path);

        // 'Archives' section must be visible on the Weebly blog in order to make this type of crawling possible.
        if (strpos($contents,"class='blog-archive-list'") !== false) {
            $dom_doc = new DOMDocument();
            $dom_doc->loadHTML($contents);
            $xpath = new DOMXPath($dom_doc);
            $first_archive_link = $xpath->query("(//p[@class='blog-archive-list'])[1]/a[1]/@href")->item(0)->nodeValue;

            $dom_doc->loadHTMLFile($this->root . $first_archive_link);
            $xpath = new DOMXPath($dom_doc);
            $date = $xpath->query("(//p[@class='blog-date'])[1]")->item(0)->nodeValue;

            preg_match('#(\d+)-#', $first_archive_link, $matches);
            if (strpos($date, $matches[1] . "/") === 3) {
                $this->post_date_format = 'd/m/Y';
            }

            $this->crawler = new archive_crawler($this);
        }
    }

    /**
     * @return string Used for parsing comments date.
     */
    public function get_post_date_format() {
        return $this->post_date_format;
    }

    public function extract_post($xpath, $context = null) {
        if (!$context) {
            $context = $xpath->query("//table[@id='blogTable']//div[@class='blog-post']")->item(0);
        }

        $result['id'] = str_replace('blog-post-', '', $context->getAttribute('id'));

        $ahref = $xpath->query(".//h2[@class='blog-title']/a/@href", $context)->item(0)->nodeValue;
        if (strpos($ahref, "http://") === false) {
            $ahref = $this->root . $ahref;
        }
        $result['link'] = $ahref;

        $result['title'] = $xpath->query(".//h2[@class='blog-title']", $context)->item(0)->nodeValue;
        $result['content'] = $xpath->query(".//div[@class='blog-content']", $context)->item(0)->nodeValue;
        $result['raw_date'] = $xpath->query(".//p[@class='blog-date']", $context)->item(0)->nodeValue;

        $post_dt = DateTime::createFromFormat($this->post_date_format . ' H:i:s',
            $result['raw_date'] . ' 00:00:00', new DateTimeZone("UTC"));

        if ($post_dt === false) {
            $this->post_date_format = 'd/m/Y';
            $post_dt = DateTime::createFromFormat($this->post_date_format . ' H:i:s', $result['raw_date'] . ' 00:00:00',
                new DateTimeZone("UTC"));
        }

        $result['date'] = $post_dt;

        $content_node = $xpath->query(".//div[@class='blog-content']", $context)->item(0);

        $children  = $content_node->childNodes;
        $result['content'] = "";
        foreach ($children as $child) {
            $result['content'] .=  $child->ownerDocument->saveXML($child);
        }

        $result['content'] = str_replace("src=\"/uploads/", "src=\"" . $this->root . "/uploads/", $result['content']);
        $result['content'] = str_replace("href=\"/uploads/", "href=\"" . $this->root . "/uploads/", $result['content']);

        // Fix img urls (can be appended with ?number)
        preg_match_all('/<img[^>]* src=[\'"]?([^>\'" ]+)/', $result['content'], $img_src_matches);
        preg_match_all('/<a[^>]* href=[\'"]?([^>\'" ]+)/', $result['content'], $a_href_matches );

        $img_url_matches = array_merge($img_src_matches[1], $a_href_matches[1]);
        foreach ($img_url_matches as $img_src) {
            $replace_with = preg_replace('/\?.*$/', '', $img_src);
            if ($img_src != $replace_with) {
                $result['content'] = str_replace($img_src, $replace_with, $result['content']);
            }
        }

        $result['comments'] = $xpath->query(".//p[@class='blog-comments']/a/@href", $context)->item(0)->nodeValue;

        $comments_status = $xpath->query(".//p[@class='blog-comments']", $context)->item(0)->nodeValue;
        preg_match('/\d+/', $comments_status, $matches);
        $result['comment_count'] = $matches[0];

        return $result;
    }

    // Returns next post.
    public function next() {
        $post = $this->crawler->next();
        return $post;
    }

    // Return crawling statistics, such as number of posts processed.
    public function stats() {
        return $this->crawler->stats();
    }

    public function get_root() {
        return $this->root;
    }

    public function get_url() {
        return $this->root . $this->path;
    }
}


class crawler_base {
    protected $root;
    protected $path;

    public function get_root() {
        return $this->root;
    }

    public function get_path() {
        return $this->path;
    }

    public function __construct($target_url) {
        if (!parse_url($target_url, PHP_URL_SCHEME)) {
            $target_url = 'http://' . $target_url;
        }

        $parsed = parse_url($target_url);
        $this->root = isset($parsed["host"]) ? $parsed["host"] : $parsed["path"];
        $this->root = $parsed['scheme'] . '://' . $this->root;

        $this->path = '';
        if (isset($parsed['path'])) {
            $this->path = strlen($parsed['path']) > 1 ? $parsed['path'] : '';
        }
    }

    /**
     * Given initial page, visit all the others that exists and apply $callable
     * @param $anchor_dom_node
     * @param $bucket
     * @param $callable
     */
    public function crawl_paged_callback($anchor_dom_node, &$bucket, $callable) {
        $text = $anchor_dom_node->nodeValue;
        $rel_part = str_replace(" ", "+", $anchor_dom_node->getAttribute('href'));

        // Regex bellow functions like this:
        // http://example.com/1/archives/12-2013/1       ->  1
        // http://example.com/1/archives/12-2013/1.html  ->  1.html
        $initial_url = preg_replace('/\/(\d+(\.html)?)?$/', '', $this->root . $rel_part);
        $initial_url = $initial_url . '/1';

        // Categories shouldn't end with '.html' suffix.
        if (strpos($initial_url, "/category/") === false) {
            $initial_url = $initial_url . '.html';
        }

        // With blogs hosted on Weebly, we get empty doc
        // With custom domain we can get different response
        // So check if we got any posts to parse
        $url = $initial_url;

        while($contents = @file_get_contents($url)) {
            if ($contents === false) {
                break;
            }

            if (preg_match('/class=.blog-post./', $contents) !== 1) {
                break;
            }
            $bucket[] = call_user_func_array($callable, array($url, $text, $contents));

            $url = preg_replace_callback('/\/(\d+)(\.html)?$/', function($matches) {
                return '/' . ((int)$matches[1] + 1) . '.html';
            }, $url);
        }
    }
}


class archive_crawler {

    private $base;

    private $dom_doc;

    // Stack for storing archive URL, expected to be empty when we're done.
    private $archive_url_stack = array();

    // Stack for storing all of the posts inside current archive.
    private $post_stack = array();

    // How many archives have we processed so far?
    private $archive_pages_count = 0;

    // How many posts have we processed so far?
    private $post_count = 0;

    // In case we have many posts on the same date, we track the proper order using this array.
    private $dates = array();

    public function __construct(post_crawler $base) {
        $this->base = $base;
        $this->dom_doc = new DOMDocument();

        // Fill archive stack.
        $url = $base->get_root() . $base->get_path();
        $this->dom_doc->loadHTMLFile($url);
        $xpath = new DOMXPath($this->dom_doc);

        $archive_urls = $xpath->query("(//p[@class='blog-archive-list'])[1]/a");
        foreach($archive_urls as $url_part) {

            $base->crawl_paged_callback($url_part, $this->archive_url_stack, function($a_href) {
                return $a_href;
            });
        }

        // Save archive count for stats.
        $this->archive_pages_count = count($this->archive_url_stack);
    }

    public function next() {
        // We have processed everything.
        if (empty($this->archive_url_stack) && empty($this->post_stack)) {
            return false;
        }

        // Proceed to next archive if it's available and if we've processed last of it's posts.
        // This happens initially and during crawl, when the stack gets emptied
        $url = null;
        if (empty($this->post_stack)) {
            $url = array_shift($this->archive_url_stack);
        }

        // Check if we should move to next archive.
        if ($url) {
            // Fill posts stack.
            $this->fill_posts_stack($url);
        }

        // Process and return next post if available.
        $dom_el = array_shift($this->post_stack);
        if ($dom_el) {
            ++$this->post_count;
            $post = $this->base->extract_post(new DOMXPath($dom_el->ownerDocument), $dom_el);

            // We know what month we're dealing with so we can properly parse the raw date.
            $raw_date = $post['raw_date'];
            $post_dt = $post['date'];

            // This is a special handling for posts that were made on the same day.
            // With archives crawling we don't get any minutes/seconds info,
            // so we sort them in 5 minute intervals, which ensures proper ordering of the
            // posts.
            $this->dates[$raw_date] = isset($this->dates[$raw_date]) ? $this->dates[$raw_date] : 1140;
            $minutes = $this->dates[$raw_date] = $this->dates[$raw_date] - 5;
            $post_dt->add(new DateInterval(sprintf("PT%dM", $minutes)));
            $post['date'] = $post_dt;

            return $post;
        }

        // Normally we should not exit here.
        $msg = sprintf("weebly_crawler: premature exit. Unprocessed archives: %s, Posts left in stack %d",
            print_r($this->archive_url_stack, true), count($this->post_stack));
        error_log($msg);
        return false;
    }

    private function fill_posts_stack($url) {
        $html = file_get_contents($url);

        // http://stackoverflow.com/a/7131156/1009867
        // i - upper or lower case
        // s - a dot metacharacter in the pattern matches all characters, including newlines
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);

        $this->dom_doc->loadHTML($html);
        $xpath = new DOMXPath($this->dom_doc);
        $blog_post_xpath_str = "//div[contains(@id, 'blog-post') and @class='blog-post']";
        $posts = $xpath->query($blog_post_xpath_str);

        foreach ($posts as $post) {
            // Check if we got only partial post and get the whole one.
            $read_more_node = $xpath->query(".//div[@class='blog-read-more']/a/@href", $post);
            if ($read_more_node->length) {
                $read_more_target_url = $read_more_node->item(0)->nodeValue;
                if (strpos($read_more_target_url, "http://") === false) {
                    $read_more_target_url = $this->base->get_root() . $read_more_target_url;
                }
                $this->fill_posts_stack($read_more_target_url);
            } else {
                $this->post_stack[] = $post;
            }
        }
    }

    public function stats() {
        $status = empty($this->archive_url_stack) && empty($this->post_stack) ? STATUS_DONE : STATUS_CRAWLING;
        return array(
            'method' => 'archive',
            'status' => $status,
            'total_archives' => $this->archive_pages_count,
            'processed_archives' => $this->archive_pages_count - count($this->archive_url_stack),
            'processed_posts' => $this->post_count,
            'unprocessed_archives' => count($this->archive_url_stack),
            'processed_posts_stack'=> count($this->post_stack)
        );
    }
}
