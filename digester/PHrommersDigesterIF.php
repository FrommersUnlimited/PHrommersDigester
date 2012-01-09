<?php
namespace digester;
/**
 * PHrommersDigesterIF
 * 
 * Frommers XML feed Digester interface. 
 * Describes all the public methods that must be implemented by any Frommers
 * ODF XML feed munger. Responsible for connecting, parsing the remote XML and 
 * returning usable dictionaries
 */
interface PHrommersDigesterIF {

	/**
	 * 
	 * Returns the feed 'domain' name as a String
	 */
	public function get_domain();

	/**
	 * Retreives the ItemOfInterest IOI feed data as a simple dictionary
	 *
	 * @param The IOI id $id
	 * @return The associative array containing the IOI
	 */
	public function get_ioi($id);
	
	/**
	 * 
	 * Retrieves the POI by its item_of_interest ID
	 * 
	 * @param The itemOfInterestId $id
	 */
	public function get_poi($id);
	 
	/**
	 * Retrieves the event for a particular IOI id
	 * @param The event IOI id
	 */
	public function get_event($id);

	/**
	 * 
	 * Retrieves an Attraction by its ODF IOI id
	 * @param The attraction IOI id $id
	 */
	public function get_attraction($id);
	
	/**
	 * 
	 * Retrieves a Nightlife POI by its oDF id
	 * @param The Nightlife POI id $id
	 */
	public function get_nightlife($id);
	
	/**
	 * 
	 * Retrieves a Hotel by its ODF IOI id
	 * @param The Hotel IOI id $id
	 */
	public function get_hotel($id);
	
	/**
	 * 
	 * Retrieves a Restaurant by its ODF IOI id
	 * @param The Restaurant IOI id $id
	 */
	public function get_restaurant($id);
	
	/**
	 *
	 * Retrieves a Shop by its ODF IOI id
	 * @param The Shopping POI id $id
	 */
	public function get_shop($id);

	/**
	 *
	 * Perform the poi_search and return the array of results
	 * 
	 * @param dictionary of conditions $conditions
	 */
	public function poi_search($conditions=null);

	/**
	 *
	 * Perform the event_search and return the array of results
	 * 
	 * @param dictionary of conditions $conditions
	 */
	public function event_search($conditions=null);
	
	/**
	 *
	 * Load the location.feed when supplied with the locationID
	 * 
	 * @param int $id The location id of the feed to parse
	 * @return data the 'view-friendly' dictionary ready for use
	 */
	public function get_location($id);

	/**
	 *
	 * Load the destination_menu.feed (ie guide) when supplied with the locationID
	 *
	 * @param int $id The location id of the feed to parse
	 * @return data the 'view-friendly' dictionary of the destination_menu items
	*/
	public function get_guide($id);
	
}
