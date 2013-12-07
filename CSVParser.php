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

	var $fields;                             // column names (if available)
	private $fnames_on_first_line = true;    // does first line contains column names? 
	private $separator            = ";";     // field separator
	private $enclosure            = '"';     // enclosure for each field
	private $row_max_size         = 0;       // maximum size for each line. default 0 (no limit)
	private $lines                = array(); // will hold file contents
	private $error                = null;    // will hold last error message (for debug purposes)
	private $row_limit			  = 0;       // maximum num lines to parse. default 0 (no limit) 



    public function setSeparator( $sep ) 
    {
        $this->separator = $sep;
    }
    
    public function setEnclosure( $enc ) 
    {
        $this->enclosure = $enc;
    }
    
    public function setRowMaxSize( $max ) 
    {
        $this->row_max_size = $max;
    }
    
    public function setRowLimit( $limit ) 
    {
        $this->row_limit = $limit;
    }
    
	public function parse( $path ) 
    {
		$lines_f = fopen( $path, 'r' );


		if ( !$lines_f ) {

			$this->error = "Can't open file!";
			return false; 

		}

		if ( $this->fnames_on_first_line ) {

			$this->fields = fgetcsv( $lines_f, $this->row_max_size, $this->separator, $this->enclosure );


			while( $data = fgetcsv($lines_f, $this->row_max_size, $this->separator, $this->enclosure) ) {

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

		return $this->lines;

	}

	public function next() {

		//moves to the next data if row_limit > 0 

	}


	public function dump() {


		//dump file to html table
	}
}