<?php
/**
 * CSVParser Class
 * 
 * Parses CSV file as a two dimensions array
 *
 * @author Sérgio Serra <a.sergio.serra@gmail.com>
 * @link http://www.github.com/woozy
 */	

class CSVParser {

	var $fields; /** column names (if available) **/
	var $fnames_on_first_line = true; /** if the first line contains field names **/
	var $separator            = ","; /** separator **/
	var $enclosure            = '"'; /** enclosure for each field **/
	var $limit                = 0; /** maximum size for each line. default 0 (no limit) **/
	var $lines                = array(); /** will hold file contents **/
	var $error                = null; /** will hold last error message (for debug) **/



	function parse( $path ) {

		$lines_f = fopen( $path, 'r' );


		if ( !$lines_f ) {

			$this->error = "Can't open file!";
			return false; 

		}

		if ( $this->fnames_on_first_line ) {

			$this->fields = fgetcsv( $lines_f, $this->limit, $this->separator, $this->enclosure );


			while( $data = fgetcsv($lines_f, $this->limit, $this->separator, $this->enclosure) ) {

	            $row = array();
	            foreach( $data as $id => $value ) {

	                $row[$this->fields[$id]] = $value;

	            }

	            $this->lines[] = $row;
	        } 

		} else {

			while( $data = fgetcsv($lines_f, $this->limit, $this->separator, $this->enclosure) ) {

	            $row = array();
	            foreach( $data as $id => $value ) {

	                $row[] = $value;

	            }

	            $this->lines[] = $row;
	        } 
		}

	}
}