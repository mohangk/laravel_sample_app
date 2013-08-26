<?php

class LayoutTwigLoaderTest extends LibTest {

  public function test_getSource_when_no_template() {

    $loader = new LayoutTwigLoader();

    $this->setExpectedException('Twig_Error_Loader');

    $this->specify('it throws an error', function() use($loader) {
      $loader->getSource('does not exist');
    });

  }

  public function test_exists_when_no_template() {

    $loader = new LayoutTwigLoader();

    $this->specify('it returns false', function() use($loader) {
      $this->assertFalse($loader->exists('index2.twig'));
    });

  }

  public function test_getSource_when_template_exists() {

    $loader = new LayoutTwigLoader();

    $layout = new Layout(['name' =>'index.twig', 'content'=>'Test content']);
    $layout->save();

    $this->specify('it returns the correct template', function() use($loader) {
      $this->assertSame($loader->getSource('index.twig'), 'Test content');
    });
  }

  public function test_exists_when_template_exists() {

    $loader = new LayoutTwigLoader();

    $layout = new Layout(['name' =>'index.twig', 'content'=>'Test content']);
    $layout->save();

    $this->specify('it returns true', function() use($loader) {
      $this->assertTrue($loader->exists('index.twig'));
    });

  }

}
