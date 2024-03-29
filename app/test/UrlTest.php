<?php
require_once implode('/', [PATH_MODEL, 'Test.php']);
require_once implode('/', [PATH_MODEL, 'Service.php']);
require_once implode('/', [PATH_CORE_CLASS, 'Url.php']);

class UrlTest extends Test {
	
	public function testFullUrl() {
		$base = 'http://qiita.com/taiyop/items/050c6749fb693dae8f82';
		$target = 'https://qiita-image-store.s3.amazonaws.com/0/16795/2014491b-ec06-65ff-823c-8e6fe0dfbac8.png';
		$url = Url::parseRelative($base, $target);
		$this->assertEquals($target, $url->url);
		$this->assertEquals('images/a6a1c2fd431960fcc1f145a8869ba81b/2014491b-ec06-65ff-823c-8e6fe0dfbac8.png', Service::kindlePath($url), 'フルURLパス -> 相対パス');
	}
	
	public function testSchemeLessUrl() {
		$base = 'http://qiita.com/taiyop/items/050c6749fb693dae8f82';
		$target = '//qiita-image-store.s3.amazonaws.com/0/16795/2014491b-ec06-65ff-823c-8e6fe0dfbac8.png';
		$url = Url::parseRelative($base, $target);
		$this->assertEquals('http:' . $target, $url->url);
		$this->assertEquals('images/a6a1c2fd431960fcc1f145a8869ba81b/2014491b-ec06-65ff-823c-8e6fe0dfbac8.png', Service::kindlePath($url), 'フルURLパス -> 相対パス');
	}
	
	public function testFullPath() {
		$base = 'http://qiita.com/taiyop/items/050c6749fb693dae8f82';
		$target = '/0/16795/2014491b-ec06-65ff-823c-8e6fe0dfbac8.png';
		$url = Url::parseRelative($base, $target);
		$this->assertEquals('http://qiita.com/0/16795/2014491b-ec06-65ff-823c-8e6fe0dfbac8.png', $url->url);
		$this->assertEquals('images/c2a20fd2d51d83ff9b2757481b6f84fe/2014491b-ec06-65ff-823c-8e6fe0dfbac8.png', Service::kindlePath($url), 'フルURLパス -> 相対パス');
	}
	
	public function testRelativeUrl() {
		$base = 'http://shimizuyu.jp/index.html#facilities';
		$target = 'images/btn_s01_f2.jpg';
		$url = Url::parseRelative($base, $target);
		$this->assertEquals('http://shimizuyu.jp/images/btn_s01_f2.jpg', $url->url);
		$this->assertEquals('images/f1007d1b4276d2bc9f5f01f9144dc2f0/btn_s01_f2.jpg', Service::kindlePath($url));
		
		$target = './images/btn_s01_f2.jpg';
		$url = Url::parseRelative($base, $target);
		$this->assertEquals('http://shimizuyu.jp/images/btn_s01_f2.jpg', $url->url);
		$this->assertEquals('images/f1007d1b4276d2bc9f5f01f9144dc2f0/btn_s01_f2.jpg', Service::kindlePath($url));
	}
	
}
