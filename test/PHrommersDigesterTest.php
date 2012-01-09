<?php
require_once('simpletest/autorun.php');
require_once('digester/PHrommersDigester.php');

use digester\PHrommersDigester as Digester;
/**
 *
 * Test our Feed Slurpin' PHrommersDigester
 *
 * @author oaklandez
 *
 */
class PHrommersDigesterTest extends UnitTestCase {

  protected $slurper;

  function TestOdfFeedSlurping() {
    $this->slurper = new Digester();
  }

  function testDomain() {
    $this->assertEqual($this->slurper->get_domain(), 'demosite.frommers.biz');
  }

  // Get IOI basic Item with default attributess
  function testGetBasicItem() {

    $data = $this->slurper->get_ioi(206398);

    // IOI must exist
    $this->assertNotNull($data);

    // IOI must have a type
    $this->assertNotNull($data['type']);
  }

  // Get Event (IOI with Data information)
  function testGetEvent() {

    $data = $this->slurper->get_event(452160);
    $this->assertNotNull($data);
    $this->assertNotNull($data['id']);

    // Event must have display_location, display_date, start_date and end_date
    $this->assertNotNull($data['display_location']);
    $this->assertNotNull($data['display_date']);
    $this->assertNotNull($data['start_date']);
    $this->assertNotNull($data['end_date']);

  }

  // Get Attraction
  function testGetAttraction() {

    $data = $this->slurper->get_attraction(214195);
    $this->assertNotNull($data);
    $this->assertNotNull($data['id']);

    // Attractions must have extended_type_name and opening_hours
    $this->assertNotNull($data['extended_type_name']);
    $this->assertNotNull($data['opening_hours']);

  }

  // Get Hotel
  function testGetHotel() {

    $data = $this->slurper->get_hotel(191096);
    $this->assertNotNull($data);
    $this->assertNotNull($data['id']);

    // The additional Hotel-specific fields
    $this->assertNotNull($data['price_category']);
    $this->assertNotNull($data['room_info']);
    $this->assertNotNull($data['facilities']);
    $this->assertNotNull($data['credit_cards']);
    $this->assertNotNull($data['in_rooms']);
    $this->assertNotNull($data['pets']);

    // A known missing field (optional one)
    $this->assertFalse(isset($data['other']));

  }

  // Get Nightlife
  function testGetNightlife() {
    $data = $this->slurper->get_nightlife(234475);
    $this->assertNotNull($data);
    $this->assertNotNull($data['id']);

    // Nightlife POI must have extended_type_name
    $this->assertNotNull($data['extended_type_name']);
  }

  // Get Restaurant
  function testGetRestaurant() {
    $data = $this->slurper->get_restaurant(221952);
    $this->assertNotNull($data);
    $this->assertNotNull($data['id']);

    // Restaurant POI must have credit cards, reservations an cuisine
    $this->assertNotNull($data['credit_cards']);
    $this->assertNotNull($data['cuisine']);
  }

  // Get Shop
  function testGetShop() {

    $data = $this->slurper->get_shop(537797);
    $this->assertNotNull($data);
    $this->assertNotNull($data['id']);

    // Shops must have opening_hours
    $this->assertNotNull($data['opening_hours']);
  }

  // Get POIs search results
  function testGetPoiSearchResults() {

    $data = $this->slurper->poi_search();

    $this->assertEqual(1, $data['page']);
    $this->assertNotNull($data['total']);
    $this->assertEqual(50, $data['num_per_page']);

    $results = $data['results'];
    $this->assertTrue(count($results) > 0);

    foreach ($results as $row) {
      $this->assertNotNull($row['id']);
    }

  }

  // Get event search results
  function testGetEventSearchResults() {

    $data = $this->slurper->event_search();

    $this->assertEqual(1, $data['page']);
    $this->assertNotNull($data['total']);
    $this->assertEqual(50, $data['num_per_page']);

    $results = $data['results'];
    $this->assertTrue(count($results) > 0);

    foreach ($results as $row) {
      $this->assertNotNull($row['id']);
    }

  }

  // Get Location
  function testGetLocation() {

    $data = $this->slurper->get_location(150668); // NYC
    print_r($data, true);

    $this->assertEqual(150668, $data['id']);
    $this->assertNotNull($data['name']);

  }

  // Get Location
  function testGetGuide() {

    $guide = $this->slurper->get_guide(144869); // Amsterdam
    $this->assertNotNull($guide);
    $this->assertTrue($guide['name'] == 'Amsterdam');
    $this->assertTrue(count($guide['links']) > 1);
    //print_r($guide);

  }
}
