<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class evquickbase {

	private $schema, $qb;
	private $field_ids = array(
		"CA_NAME" => 66,
		"ACCOUNT" => 6,
		"EVENT_DATE" => 7,
		"EVENT_NAME" => 8,
		"EVENT_TYPE" => 16,
		"EVENT_DESC" => 9,
		"ATTEND" => 36,
		"EFFORT" => 41,
		"EFFECT" => 42,
		"TURNOUT" => 43,
		"AGAIN" => 44,
		"MORE5" => 76,
		"TREASURER" => 122
		);
		
	public function __construct()
    {
		  log_message('debug', 'evquickbase.php library constructor');
    	$CI =& get_instance();
    	$CI->load->library('quickbase');
    	$this->qb = $CI->quickbase;
    	$this->schema = $this->qb->get_schema();  
    }
    
	private function xml_to_array($xml){
		$array = array();
		foreach ($xml->children() as $child) {
			if ($child == "...Select Name...")
				continue;
			$array[]=$child;
		}
		return $array;
	}
	
	public function get_schema()
    {
	    return $this->schema;
    }
	
	public function get_cas() {
	
		$ca_xml = $this->schema->table->fields->field[2]->choices;
		$ca_array = $this->xml_to_array($ca_xml);
		return $ca_array;
	}
	
	public function get_accounts() {
		$account_xml = $this->schema->table->fields->field[1]->choices;
		$account_array = $this->xml_to_array($account_xml);
		return $account_array;
	}
	
	public function get_event_types() {
		$types_xml = $this->schema->table->fields->field[6]->choices;
		$types_array = $this->xml_to_array($types_xml);
		return $types_array;
	}
	
	public function get_treasurers() {
		return array('ev_lowrise', 'ev_highrise');
	//	return array(
	//		array('EV Highrises/Lowrises Treasurer', 'ev_lowrise'),
	//		array('EV Studios/Midrise Treasurer', 'ev_highrise')
	//		);
	}
	
	public function xmlObjToArr($obj) { 
        $namespace = $obj->getDocNamespaces(true); 
        $namespace[NULL] = NULL; 
        
        $children = array(); 
        $attributes = array(); 
        $name = strtolower((string)$obj->getName()); 
        
        $text = trim((string)$obj); 
        if( strlen($text) <= 0 ) { 
            $text = NULL; 
        } 
        
        // get info for all namespaces 
        if(is_object($obj)) { 
            foreach( $namespace as $ns=>$nsUrl ) { 
                // atributes 
                $objAttributes = $obj->attributes($ns, true); 
                foreach( $objAttributes as $attributeName => $attributeValue ) { 
                    $attribName = strtolower(trim((string)$attributeName)); 
                    $attribVal = trim((string)$attributeValue); 
                    if (!empty($ns)) { 
                        $attribName = $ns . ':' . $attribName; 
                    } 
                    $attributes[$attribName] = $attribVal; 
                } 
                
                // children 
                $objChildren = $obj->children($ns, true); 
                foreach( $objChildren as $childName=>$child ) { 
                    $childName = strtolower((string)$childName); 
                    if( !empty($ns) ) { 
                        $childName = $ns.':'.$childName; 
                    } 
                    $children[$childName][] = $this->xmlObjToArr($child); 
                } 
            } 
        } 
        
        return array(
            'text'=>$text, 
            'attributes'=>$attributes, 
            'children'=>$children 
        ); 
    } 

    private function contains($search_str, $main_str)
    {
    	return strpos($main_str, $search_str) !== false;
    }

    private function filter_by_account($event, $accounts)
    {
	    foreach ($accounts as $acct)
	    {
		    if ($this->contains($acct, $event[14]))
		    	return true;
	    }
	    return false;
	    
    }
	
	public function get_events()
	{
	
		// committes are 30-34 in the 'Account' field in Quickbase
		$committes = array('30', '31', '32', '33', '34');
	
		$queries = array(
		
			array(
				'fid' => '7',
				'ev'  => 'OAF',
				'cri' => 'today',
				)
		);
		$clist = '8.7.126.127.128.129.130.135.131.133.132.9.66.134.6';
		$results = $this->qb->do_query($queries, $qid=0, $qname=0, $clist, $slist='7', $fmt = 'structured', $options = "so-AA.gb-XX"); 
		$results = $results->table->records;
		
		$arr = $this->xmlObjToArr($results);
		
		//print_r($arr["children"]["record"]);
		
		$events = array();
		foreach ($arr["children"]["record"] as $event)
		{
			$events[] = $event['children']['f'];
		}
		
		$new_events=array();
		foreach ($events as $event)
		{
			$nevent = array();
			foreach ($event as $item)
			{
				$nevent[] = $item['text'];
			}
			if ($this->filter_by_account($nevent, $committes))
				$new_events[] = $nevent;
		}
		return $new_events;//$this->xml_to_array($results);
	}
	
	
	public function add_event($account, $ca_name, $event_date, $event_name, $event_type,
		$event_description, $treasurer, $event_copay, $event_start_time, $event_end_time,
		$event_location, $meetup_time, $meetup_location, $rsvp_link, $rsvp_date, $rsvp_time,
		$ca_email, $attend=0, $effort='3-average',$effect='3',$turnout='3',$again='3-maybe', 
		$more5='no') {
		
		$field_ids = array(
		"CA_NAME" => 66,
		"ACCOUNT" => 6,
		"EVENT_DATE" => 7,
		"EVENT_NAME" => 8,
		"EVENT_TYPE" => 16,
		"EVENT_DESC" => 9,
		"ATTEND" => 36,
		"EFFORT" => 41,
		"EFFECT" => 42,
		"TURNOUT" => 43,
		"AGAIN" => 44,
		"MORE5" => 76,
		"TREASURER" => 122,
		"EVENT_COPAY" => 135,
		"EVENT_START_TIME" => 126,
		"EVENT_END_TIME" => 127,
		"EVENT_LOCATION" => 128,
		"MEETUP_TIME" => 129,
		"MEETUP_LOCATION" => 130,
		"RSVP_LINK" => 131,
		"RSVP_DATE" => 132,
		"RSVP_TIME" => 133,
		"CA_EMAIL" => 134
		);

		$fields = array(
	            array(
	                'fid'   => $field_ids['ACCOUNT'],
	                'value' => $account),
	            array(
	                'fid'   => $field_ids['CA_NAME'],
	                'value' => $ca_name),
	            array(
	            	'fid'   => $field_ids['EVENT_DATE'],
	            	'value' => $event_date),
	            	
	            array(
	                'fid'   => $field_ids['EVENT_NAME'],
	                'value' => $event_name),
	            array(
	                'fid'   => $field_ids['EVENT_TYPE'],
	                'value' => $event_type),
	            array(
	            	'fid'   => $field_ids['EVENT_DESC'],
	            	'value' => $event_description),
	            array(
	                'fid'   => $field_ids['ATTEND'],
	                'value' => $attend),
	            array(
	                'fid'   => $field_ids['EFFORT'],
	                'value' => $effort),
	            array(
	            	'fid'   => $field_ids['EFFECT'],
	            	'value' => $effect),
	            array(
	                'fid'   => $field_ids['TURNOUT'],
	                'value' => $turnout),
	            array(
	                'fid'   => $field_ids['AGAIN'],
	                'value' => $again),
	            array(
	            	'fid'   => $field_ids['MORE5'],
	            	'value' => $more5),
	            array(
	            	'fid'	=> $field_ids['TREASURER'],
	            	'value' => $treasurer),
	            array(
	            	'fid'   => $field_ids['EVENT_COPAY'],
	            	'value' => $event_copay),
	            array(
	            	'fid'   => $field_ids['EVENT_START_TIME'],
	            	'value' => $event_start_time),
	            array(
	            	'fid'   => $field_ids['EVENT_END_TIME'],
	            	'value' => $event_end_time),
	            array(
	            	'fid'   => $field_ids['EVENT_LOCATION'],
	            	'value' => $event_location),
	            array(
	            	'fid'   => $field_ids['MEETUP_TIME'],
	            	'value' => $meetup_time),
	            array(
	            	'fid'   => $field_ids['MEETUP_LOCATION'],
	            	'value' => $meetup_location),
	            array(
	            	'fid'   => $field_ids['RSVP_LINK'],
	            	'value' => $rsvp_link),
	            array(
	            	'fid'   => $field_ids['RSVP_DATE'],
	            	'value' => $rsvp_date),
	            array(
	            	'fid'   => $field_ids['RSVP_TIME'],
	            	'value' => $rsvp_time),
	            array(
	            	'fid'   => $field_ids['CA_EMAIL'],
	            	'value' => $ca_email)	
	            );
	    $ret = $this->qb->add_record($fields);
	    $ret = $this->xml_to_array($ret);
	    if ($ret[1] == 0)
	    {
			return '';
	    }
	    else {
		    return $ret[3];
	    }
	}
	
}
?>