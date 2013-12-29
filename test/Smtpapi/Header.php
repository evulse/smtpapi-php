<?php 

class SmtpapiTest_Header extends PHPUnit_Framework_TestCase {
  
  public function testConstructionHeader() {
    $header = new Smtpapi\Header();
    $this->assertEquals(get_class($header), "Smtpapi\Header");
  }

  public function testHasAToJsonStringMethod() {
    $header = new Smtpapi\Header();

    $this->assertEquals('{}', $header->toJsonString());
  }

  public function testAddTo() {
    $header = new Smtpapi\Header();

    $header->addTo('addTo@mailinator.com');
    $this->assertEquals('{"to":["addTo@mailinator.com"]}', $header->toJsonString());
  }

  public function testAddSubstitution() {
    $header = new Smtpapi\Header();

    $header->addSubstitution('sub', array('val'));
    $this->assertEquals('{"sub":{"sub":["val"]}}', $header->toJsonString());
  }

  public function testSetUniqueArgs() {
    $header = new Smtpapi\Header();

    $header->setUniqueArgs(array('set_unique_argument_key' => 'set_unique_argument_value'));
    $this->assertEquals('{"unique_args":{"set_unique_argument_key":"set_unique_argument_value"}}', $header->toJsonString());
  }

  public function testAddUniqueArgs() {
    $header = new Smtpapi\Header();

    $header->addUniqueArgs('add_unique_argument_key', 'add_unique_argument_value');
    $header->addUniqueArgs('add_unique_argument_key_2', 'add_unique_argument_value_2');
    $this->assertEquals('{"unique_args":{"add_unique_argument_key":"add_unique_argument_value","add_unique_argument_key_2":"add_unique_argument_value_2"}}', $header->toJsonString());
  }

  public function testSetCategory() {
    $header = new Smtpapi\Header();

    $header->setCategory('setCategory');
    $this->assertEquals('{"category":["setCategory"]}', $header->toJsonString());
  }

  public function testAddCategory() {
    $header = new Smtpapi\Header();

    $header->addCategory('addCategory');
    $header->addCategory('addCategory2');
    $this->assertEquals('{"category":["addCategory","addCategory2"]}', $header->toJsonString());
  }

  public function testSetSections() {
    $header = new Smtpapi\Header();

    $header->setSections(array('set_section_key' => 'set_section_value'));
    $this->assertEquals('{"section":{"set_section_key":"set_section_value"}}', $header->toJsonString());
  }

  public function testAddSection() {
    $header = new Smtpapi\Header();

    $header->addSection('set_section_key', 'set_section_value');
    $header->addSection('set_section_key_2', 'set_section_value_2');
    $this->assertEquals('{"section":{"set_section_key":"set_section_value","set_section_key_2":"set_section_value_2"}}', $header->toJsonString());
  }

  public function testSetFilterSetting() {
    $header = new Smtpapi\Header();

    $filter = array( 
      'footer' => array( 
        'setting' => array( 
          'enable' => 1,
          "text/plain" => 'You can haz footers!'
        )
      )
    ); 

    $header->setFilterSetting($filter);
    $this->assertEquals('{"filters":{"footer":{"setting":{"enable":1,"text/plain":"You can haz footers!"}}}}', $header->toJsonString());
  }

  public function testAddFilterSetting() {
    $header = new Smtpapi\Header();

    $header->addFilterSetting('footer', 'text/html', '<strong>boo</strong>');
    $this->assertEquals('{"filters":{"footer":{"settings":{"text/html":"<strong>boo</strong>"}}}}', $header->toJsonString());
  }

}
