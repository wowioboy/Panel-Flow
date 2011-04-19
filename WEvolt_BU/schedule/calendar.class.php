<?php

################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 #
## --------------------------------------------------------------------------- #
##  ApPHP Calendar version 3.0.3                                               #
##  Developed by:  ApPhp <info@apphp.com>                                      #
##  Last modified: 29.11.2009 08:30                                            #
##  License:       GNU LGPL v.3                                                #
##  Site:          http://www.apphp.com/php-calendar/                          #
##  Copyright:     ApPHP Calendar (c) 2009. All rights reserved.               #
##                                                                             #
##  Additional modules (embedded):                                             #
##  -- (Javascript - Draggable Elements)                                       #
##     Paranoid Ferret Productions              http://www.switchonthecode.com #
##                                                                             #
################################################################################


class Calendar{
	
	
	// PUBLIC
	// --------
	// __construct()
	// __destruct()
	// Show()
	// SetCalendarDimensions
	// SetCaption
	// SetWeekStartedDay
	// SetWeekDayNameLength
	// ShowWeekNumberOfYear
	// SetTimeZone
	// GetCurrentTimeZone
	// SetDefaultView
	// SetSundayColor
	// SetTimeFormat
	// SetSubmissionType
	// SetCssStyle
	// SetAddEventFormType
	// SetCachingParameters
	// Debug
	//
	// STATIC
	// ----------
	// Version
	// GetDefaultTimeZone
	// 
	// PRIVATE
	// --------
	// SetDefaultParameters
	// GetCurrentParameters
	// DrawCssStyle
	// DrawJsFunctions
	// InitializeJsFunctions
	// DrawMessages
	// DrawYear
	// DrawMonth	
	// DrawMonthSmall
	// DrawWeek
	// DrawDay
	// DrawTypesChanger
	// DrawDateJumper
	// DrawTodayJumper	
	// --------
	// SetLanguage
	// StartCaching
	// FinishCaching
	// GetEventsList
	// IsYear
	// IsMonth
	// IsDay
	// ConvertToDecimal
	// GetFormattedMicrotime
	

	//--- PUBLIC DATA MEMBERS --------------------------------------------------
	public $error;
	
	//--- PROTECTED DATA MEMBERS -----------------------------------------------
	protected $weekDayNameLength;
	
	//--- PRIVATE DATA MEMBERS -------------------------------------------------
	private  $arrWeekDays;
	private  $arrMonths;
	private  $arrViewTypes;
	private  $defaultView;
	private  $defaultAction;
	private  $showControlPanel;
	
	private  $arrParameters;
	private  $arrToday;
	private  $prevYear;
	private  $nextYear;
	private  $prevMonth;
	private  $nextMonth;
	private  $prevWeek;
	private  $nextWeek;
	private  $prevDay;
	private  $nextDay;
	
	private  $isDrawNavigation;
	private  $isWeekNumberOfYear;
	
	private  $crLt;	
	private  $caption;		
	private  $calWidth;		
	private  $calHeight;
	private  $cellHeight;
	
	private  $timezone;
	private  $timeFormat;
	
	private  $langName;
	private  $lang;
	
	private  $submissionType;

	private  $isDemo;	
	private  $isDebug;
	private  $arrMessages;
	private  $arrErrors;
    private  $startTime;
	private  $endTime;
	
	private  $addEventFormType;
	
	private  $isCachingAllowed;
	private  $cacheLifetime;
	private  $cacheDir;
	private  $maxCacheFiles;

	static private $version = "3.0.3";
	
		
	//--------------------------------------------------------------------------
    // CLASS CONSTRUCTOR
	//--------------------------------------------------------------------------
	function __construct()
	{
		$this->defaultView   = "monthly";
		$this->defaultAction = "view";
		$this->showControlPanel = true;
	
		// possible values 1,2,....7
		$this->weekStartedDay = 1;
		
		$this->weekDayNameLength = "short"; // short|long

		$this->langName = "en";
		$this->SetLanguage();
		
		$this->arrWeekDays = array();
		$this->arrWeekDays[0] = array("short"=>$this->lang["sun"], "long"=>$this->lang["sunday"]);
		$this->arrWeekDays[1] = array("short"=>$this->lang["mon"], "long"=>$this->lang["monday"]);
		$this->arrWeekDays[2] = array("short"=>$this->lang["tue"], "long"=>$this->lang["tuesday"]);
		$this->arrWeekDays[3] = array("short"=>$this->lang["wed"], "long"=>$this->lang["wednesday"]);
		$this->arrWeekDays[4] = array("short"=>$this->lang["thu"], "long"=>$this->lang["thursday"]);
		$this->arrWeekDays[5] = array("short"=>$this->lang["fri"], "long"=>$this->lang["friday"]);
		$this->arrWeekDays[6] = array("short"=>$this->lang["sat"], "long"=>$this->lang["satarday"]);
		
		$this->arrMonths = array();
		$this->arrMonths["1"] = $this->lang["months"][1];
		$this->arrMonths["2"] = $this->lang["months"][2];
		$this->arrMonths["3"] = $this->lang["months"][3];
		$this->arrMonths["4"] = $this->lang["months"][4];
		$this->arrMonths["5"] = $this->lang["months"][5];
		$this->arrMonths["6"] = $this->lang["months"][6];
		$this->arrMonths["7"] = $this->lang["months"][7];
		$this->arrMonths["8"] = $this->lang["months"][8];
		$this->arrMonths["9"] = $this->lang["months"][9];
		$this->arrMonths["10"] = $this->lang["months"][10];
		$this->arrMonths["11"] = $this->lang["months"][11];
		$this->arrMonths["12"] = $this->lang["months"][12];
		
		$this->arrViewTypes = array();
		$this->arrViewTypes["daily"]   = $this->lang["daily"];
		$this->arrViewTypes["weekly"]  = $this->lang["weekly"];
		$this->arrViewTypes["monthly"] = $this->lang["monthly"];
		$this->arrViewTypes["yearly"]  = $this->lang["yearly"];
		
		$this->arrParameters = array();
		$this->SetDefaultParameters();

		$this->arrToday  = array();
		$this->prevYear  = array();
		$this->nextYear  = array();
		$this->prevMonth = array();
		$this->nextMonth = array();
		$this->prevWeek  = array();
		$this->nextWeek  = array();
		$this->prevDay   = array();
		$this->nextDay   = array();
		
		$this->isDrawNavigation = true;
		$this->isWeekNumberOfYear = true;
		
		$this->crLt = "\n";
		$this->caption = "";
		$this->calWidth = "800px";
		$this->calHeight = "470px";
		$this->celHeight = number_format(((int)$this->calHeight)/6, "0")."px";
		
		$this->timezone = self::GetDefaultTimeZone();
		$this->timeFormat = "24";
		
		$this->submissionType = "post";
		
		$this->cssStyle = "blue";
		$this->addEventFormType = "floating";

		$this->isCachingAllowed = true;
		$this->cacheLifetime = 5; // in minutes
		$this->cacheDir = "cache/";
		$this->maxCacheFiles = 100;

		$this->isDemo = false;	
		$this->isDebug = false;
		$this->arrMessages = array();
		$this->arrErrors = array();
	
	}
	
	//--------------------------------------------------------------------------
    // CLASS DESTRUCTOR
	//--------------------------------------------------------------------------
    function __destruct()
	{
		// echo 'this object has been destroyed';
    }

	
	//==========================================================================
    // PUBLIC DATA FUNCTIONS
	//==========================================================================			
	/**
	 *	Show Calendar 
	 *
	*/	
	function Show($DB)
	{
		//ob_start();
		$event_action = isset($_REQUEST['hid_event_action']) ? $_REQUEST['hid_event_action'] : "";
		$event_id     = isset($_REQUEST['hid_event_id']) ? $_REQUEST['hid_event_id'] : "";
		$jump_year 	= isset($_REQUEST['jump_year']) ? $_REQUEST['jump_year'] : "";
		$jump_month	= isset($_REQUEST['jump_month']) ? $_REQUEST['jump_month'] : "";
		$jump_day 	= isset($_REQUEST['jump_day']) ? $_REQUEST['jump_day'] : "";
		$view_type 	= isset($_REQUEST['view_type']) ? $_REQUEST['view_type'] : "";
		
        // start calculating running time of a script
        $this->startTime = 0;
		$this->DB = $DB;
        $this->endTime = 0;
        if($this->isDebug){
            $this->startTime = $this->GetFormattedMicrotime();
        }        

		$this->HandleEvents();
		$this->GetCurrentParameters();
		$this->DrawCssStyle();
		$this->DrawJsFunctions();

		echo "<form name='frmCalendar' id='frmCalendar' action='".$this->arrParameters["current_file"]."' method='".$this->submissionType."'>".$this->crLt;
		echo "<input type='hidden' id='hid_event_action' name='hid_event_action' value='' />".$this->crLt;
		echo "<input type='hidden' id='hid_event_id' name='hid_event_id' value='' />".$this->crLt;
	    echo "<input type='hidden' id='hid_action' name='hid_action' value='' />".$this->crLt;
		echo "<input type='hidden' id='hid_view_type' name='hid_view_type' value='' />".$this->crLt;
		echo "<input type='hidden' id='hid_year' name='hid_year' value='' />".$this->crLt;
		echo "<input type='hidden' id='hid_month' name='hid_month' value='' />".$this->crLt;
		echo "<input type='hidden' id='hid_day' name='hid_day' value='' />".$this->crLt;
		
		if($event_action == "events_add" ||
			$event_action == "events_edit" ||
			$event_action == "events_delete" ||
			$event_action == "events_update" ||
			$event_action == "events_management"){
			echo "<input type='hidden' id='view_type' name='view_type' value='".$view_type."' />".$this->crLt;
			echo "<input type='hidden' id='jump_year' name='jump_year' value='".$jump_year."' />".$this->crLt;
			echo "<input type='hidden' id='jump_month' name='jump_month' value='".$jump_month."' />".$this->crLt;
			echo "<input type='hidden' id='jump_day' name='jump_day' value='".$jump_day."' />".$this->crLt;			
		}
		
		echo "<div id='calendar' style='width:".$this->calWidth."; background-color:#cfdcea;'>".$this->crLt;		
		//echo "<div class='types_changer'>".$this->DrawTypesChanger(false)."</div>";
		// draw calendar header
        /*
		echo "<table id='calendar_header'>".$this->crLt;
		echo $this->DrawMessages(false);		
		echo "<tr>";
		echo "<th class='caption_left'>".$this->DrawTodayJumper(false)."</th>";
		echo "<th class='caption'>".$this->caption."</th>";
		echo "<th class='types_changer'>".$this->DrawTypesChanger(false)."</th>";
		echo "</tr>".$this->crLt;

		if($this->showControlPanel){
			echo "<tr>";			
			echo "<th class='caption_left' colspan='3' valign='bottom'>
				    <table align='left'><tr>
					<td><img src='style/".$this->cssStyle."/images/add_event.png' border='0' /></td>
					<td><a href=\"javascript:__doPostBack('view', '".$this->arrParameters["view_type"]."', '".$this->arrParameters['year']."', '".$this->arrParameters['month']."', '".$this->arrParameters['day']."', 'events_add')\"><b>Add Event</b></a></td>
					<td>|</td>
					<td><img src='style/".$this->cssStyle."/images/manage_events.png' border='0' /></td>
					<td><a href=\"javascript:__doPostBack('view', '".$this->arrParameters["view_type"]."', '".$this->arrParameters['year']."', '".$this->arrParameters['month']."', '".$this->arrParameters['day']."', 'events_management')\"><b>Manage Events</b></a></td>
					</tr></table>
				  </th>";
			echo "</tr>".$this->crLt;			
		}		
		echo "</table>";
		*/
		switch($event_action)
		{			
			case "events_add":
				$this->DrawEventsAddForm();
				break;			
			case "events_edit":
				$this->DrawEventsEditForm($event_id);
				break;			
			case "events_management":
			case "events_delete":
			case "events_update":
				$this->DrawEventsManagement();
				break;
			case "events_insert":
			default:
				switch($this->arrParameters["view_type"])
				{			
					case "daily":
						$this->DrawDay();
						break;
					case "weekly":
						$this->DrawWeek();
						break;
					case "yearly":
						$this->DrawYear();
						break;			
					default:
					case "monthly":				
						$this->DrawMonth();
						break;
				}			
				break;
		}						
		
		echo "</div>".$this->crLt;
		echo "</form>".$this->crLt;
		$this->InitializeJsFunctions();
		
		if($this->isDebug){
			$this->endTime = $this->GetFormattedMicrotime();

			echo "<div style='width:".$this->calWidth."; margin: 10px auto; text-align:left; color:#000096;'>";
			echo "Debug Info: (Total running time: ".round((float)$this->endTime - (float)$this->startTime, 6)." sec.) <br />========<br />";
			echo "GET: <br />--------<br />";
			echo "<pre>";
			print_r($_GET);
			echo "</pre><br />";
			echo "POST: <br />--------<br />";
			echo "<pre>";
			print_r($_POST);
			echo "</pre><br />";
			echo "SQL: <br />--------<br />";
			$this->DrawErrors();
			echo "</div>";
		}		
		
        echo $this->crLt;
		
		//ob_end_flush();		
	}	
	
	/**
	 *	Set calendar dimensions
	 *  	@param $width
	 *  	@param $height
	*/	
	function SetCalendarDimensions($width = "", $height = "")
	{
		$this->calWidth = ($width != "") ? $width : "800px";
		$this->calHeight = ($height != "") ? $height : "470px";
		$this->celHeight = number_format(((int)$this->calHeight)/6, "0")."px";
	}

	/**
	 *	Check if parameters is 4-digit year
	 *  	@param $year - string to be checked if it's 4-digit year
	*/	
	function SetCaption($caption_text = "")
	{
		$this->caption = $caption_text;	
	}
	
	/**
	 *	Set week started day
	 *  	@param $started_day - started day of week 1...7
	*/	
	function SetWeekStartedDay($started_day = "1")
	{
		if(is_numeric($started_day) && (int)$started_day >= 1 && (int)$started_day <= 7){
			$this->weekStartedDay = (int)$started_day;				
		}
	}

	/**
	 *	Set week day name length 
	 *  	@param $length_name - "short"|"long"
	*/	
	function SetWeekDayNameLength($length_name = "short")
	{
		if(strtolower($length_name) == "long"){
			$this->weekDayNameLength = "long";
		}
	}
	
	/**
	 *	Set week day name length 
	 *  	@param $length_name - "short"|"long"
	*/	
	function ShowWeekNumberOfYear($show = true)
	{
		if($show === true || strtolower($show) == "true"){
			$this->isWeekNumberOfYear = true;
		}else{
			$this->isWeekNumberOfYear = false;
		}
	}
	
	/**
	 *	Set timezone
	 *		@param $timezone
	*/	
	function SetTimeZone($timezone = "")
	{
		if($timezone != ""){
			$this->timezone = $timezone;
			date_default_timezone_set($this->timezone); 
		}
	}

	/**
	 *	Get current timezone 
	*/	
	function GetCurrentTimeZone()
	{
		return $this->timezone;
	}
	
	/**
	 *	Set default calendar view
	 *		@param $default_view
	*/	
	function SetDefaultView($default_view = "monthly")
	{
		if(array_key_exists($default_view, $this->arrViewTypes)){
			$this->defaultView = $default_view;
		}
	}
	
	/**
	 *	Set Sunday color
	 *		@param $default_view
	*/	
	function SetSundayColor($color = false)
	{
		$this->sundayColor = ($color === true || $color == "true") ? true : false;
	}
	
	/**
	 *	Set time format
	 *		@param $time_format
	*/	
	function SetTimeFormat($time_format = "24")
	{
		$this->timeFormat = (strtoupper($time_format) == "AM/PM") ? "AP/PM" : "24";
	}	

	/**
	 *	Set form submission type
	 *		@param $submission_type
	*/	
	function SetSubmissionType($submission_type = "post")
	{
		if(strtolower($submission_type) == "get") $this->submissionType = "get";
		else $this->submissionType = "post";
	}

	/**
	 *	Set CSS style
	 *		@param $style
	*/	
	function SetCssStyle($style = "blue")
	{		
		if(strtolower($style) == "green") $this->cssStyle = "green";
		else $this->cssStyle = "blue";
	}
	
	/**
	 *	Set Add Event form type
	 *		@param $type
	*/	
	function SetAddEventFormType($type = "blue")
	{		
		if(strtolower($type) == "floating") $this->addEventFormType = "floating";
		else $this->addEventFormType = "popup";
	}
	
	/**
	 *	Set Caching Parameters
	 *		@param $allowed
	 *		@param $lifetime
	*/	
	function SetCachingParameters($allowed, $lifetime = "5")
	{		
		if(strtolower($allowed) == "true" || $allowed === true) $this->isCachingAllowed = true;
		else $this->isCachingAllowed = false;
		// timeout in minutes
		if(is_numeric($lifetime) && $lifetime < 24*60){			
			$this->cacheLifetime = $lifetime;
		}else{
			$this->cacheLifetime = 5; 
		}
	}	
	
	/**
	 *	Set debug mode
	 *		@param $mode
	*/	
	function Debug($mode = false)
	{
		if($mode === true || strtolower($mode) == "true") $this->isDebug = true;
	}
	
	//==========================================================================
    // STATIC
	//==========================================================================		
	/**
	 *	Return current version
	*/	
	static function Version()
	{
		return self::$version;
	}
	
	/**
	 *	Return default time zone
	*/	
	static function GetDefaultTimeZone()
	{
		return date_default_timezone_get();  
	}

	
	//==========================================================================
    // PRIVATE DATA FUNCTIONS
	//==========================================================================		
	/**
	 *	Set default parameters
	 *
	*/	
	function SetDefaultParameters()
	{
		$this->arrParameters["year"]  = date("Y");
		$this->arrParameters["month"] = date("m");
		$this->arrParameters["month_full_name"] = date("F");
		$this->arrParameters["day"]   = date("d");
		$this->arrParameters["fulldate"]   = date("Y-m-d 00:00:00");
		$this->arrParameters["view_type"] = $this->defaultView;
		$this->arrParameters["action"] = "display";
		$this->arrToday = getdate();

		// get current file
		$this->arrParameters["current_file"] = $_SERVER["SCRIPT_NAME"];
		$parts = explode('/', $this->arrParameters["current_file"]);
		$this->arrParameters["current_file"] = $parts[count($parts) - 1];		
	}

	/**
	 *	Get current parameters - read them from URL
	 *
	*/	
	function GetCurrentParameters()
	{		
		$year 		= (isset($_REQUEST['hid_year']) && $this->IsYear($_REQUEST['hid_year'])) ? $_REQUEST['hid_year'] : date("Y");
		$month 		= (isset($_REQUEST['hid_month']) && $this->IsMonth($_REQUEST['hid_month'])) ? $_REQUEST['hid_month'] : date("m");
		$day 		= (isset($_REQUEST['hid_day']) && $this->IsDay($_REQUEST['hid_day'])) ? $_REQUEST['hid_day'] : date("d");
		$view_type 	= (isset($_REQUEST['hid_view_type']) && array_key_exists($_REQUEST['hid_view_type'], $this->arrViewTypes)) ? $_REQUEST['hid_view_type'] : $this->defaultView;
	
		$cur_date = getdate(mktime(0,0,0,$month,$day,$year));
		
		$this->arrParameters["year"]  = $cur_date['year'];
		$this->arrParameters["month"] = $this->ConvertToDecimal($cur_date['mon']);
		$this->arrParameters["month_full_name"] = $cur_date['month'];
		$this->arrParameters["day"]   = $day;
		$this->arrParameters["view_type"] = $view_type;
		$this->arrParameters["action"] = "view";
		$this->arrToday = getdate();
		
		///print_r($this->arrParameters);

		$this->prevYear = getdate(mktime(0,0,0,$this->arrParameters['month'],$this->arrParameters["day"],$this->arrParameters['year']-1));
		$this->nextYear = getdate(mktime(0,0,0,$this->arrParameters['month'],$this->arrParameters["day"],$this->arrParameters['year']+1));

		$this->prevMonth = getdate(mktime(0,0,0,$this->arrParameters['month']-1,$this->arrParameters["day"],$this->arrParameters['year']));
		$this->nextMonth = getdate(mktime(0,0,0,$this->arrParameters['month']+1,$this->arrParameters["day"],$this->arrParameters['year']));
         
		$this->prevWeek = getdate(mktime(0,0,0,$this->arrParameters['month'],$this->arrParameters["day"]-7,$this->arrParameters['year']));
		$this->nextWeek = getdate(mktime(0,0,0,$this->arrParameters['month'],$this->arrParameters["day"]+7,$this->arrParameters['year']));
		
		$this->prevDay = getdate(mktime(0,0,0,$this->arrParameters['month'],$this->arrParameters["day"]-1,$this->arrParameters['year']));
		$this->nextDay = getdate(mktime(0,0,0,$this->arrParameters['month'],$this->arrParameters["day"]+1,$this->arrParameters['year']));
	}

	/**
	 *	Handle events - proccess events: insert, edit or delete
	 *
	*/	
	function HandleEvents()
	{
		$event_action 		= isset($_REQUEST['hid_event_action']) ? $_REQUEST['hid_event_action'] : "";
		$event_id 		    = isset($_REQUEST['hid_event_id']) ? $_REQUEST['hid_event_id'] : "";


		$sel_event 			= isset($_REQUEST['sel_event']) ? $_REQUEST['sel_event'] : "";
		$event_name 		= isset($_REQUEST['event_name']) ? $_REQUEST['event_name'] : "";
		$sel_event_name		= isset($_REQUEST['sel_event_name']) ? $_REQUEST['sel_event_name'] : "";
		$event_description 	= isset($_REQUEST['event_description']) ? $_REQUEST['event_description'] : "";

		$event_from_hour 	= isset($_REQUEST['event_from_hour']) ? $_REQUEST['event_from_hour'] : "";
		$event_from_day 	= isset($_REQUEST['event_from_day']) ? $_REQUEST['event_from_day'] : "";
		$event_from_month 	= isset($_REQUEST['event_from_month']) ? $_REQUEST['event_from_month'] : "";
		$event_from_year 	= isset($_REQUEST['event_from_year']) ? $_REQUEST['event_from_year'] : "";
		$start_date         = $event_from_year."-".$event_from_month."-".$event_from_day." ".$event_from_hour;
		
		$event_to_hour 		= isset($_REQUEST['event_to_hour']) ? $_REQUEST['event_to_hour'] : "";
		$event_to_day 		= isset($_REQUEST['event_to_day']) ? $_REQUEST['event_to_day'] : "";
		$event_to_month 	= isset($_REQUEST['event_to_month']) ? $_REQUEST['event_to_month'] : "";
		$event_to_year 		= isset($_REQUEST['event_to_year']) ? $_REQUEST['event_to_year'] : "";
		$finish_date        = $event_to_year."-".$event_to_month."-".$event_to_day." ".$event_to_hour;

		if($this->isDemo && $event_action != ""){ 
			$this->arrMessages[] = "<font color='#a20000'>".$this->lang['msg_this_operation_blocked']."</font>";
			return false;
		}
			
		if($event_action == "add"){
			// insert single event
			$insert_id = false;
			if($sel_event == "new"){
				$sql = "INSERT INTO "._DB_PREFIX."events (ID, Name, Description) VALUES (NULL, '".$event_name."', '".$event_description."') ";
				$insert_id = database_void_query($sql);
			}else if($sel_event == "current"){
				$insert_id = $sel_event_name;
			}
			if($insert_id != false){
				$sql = "INSERT INTO "._DB_PREFIX."calendar (ID, EventID, EventDate, EventTime) VALUES ";
				$current_date = $start_date;
				$offset = 0;
				while($current_date < $finish_date){
					$current = getdate(mktime($this->ParseHour($event_from_hour)+$offset,0,0,$event_from_month,$event_from_day,$event_from_year));
					$curr_date = $current['year']."-".$this->ConvertToDecimal($current['mon'])."-".$this->ConvertToDecimal($current['mday']);
					$curr_time = $this->ConvertToHour($current['hours']);
					$current_date = $curr_date." ".$curr_time;
					
					if($current_date < $finish_date){
						if($offset > 0) $sql .= ", ";
						$sql .= "(NULL, ".(int)$insert_id.", '".$curr_date."', '".$curr_time."')";
					}
					$offset++;
				}
				if(!database_void_query($sql)){
					if($this->isDebug) $this->arrErrors[] = $sql."<br />".mysql_error();					
					$this->arrMessages[] = "<font color='#a20000'>".$this->lang['error_inserting_new_events']."</font>";
				}else{
					$this->arrMessages[] = "<font color='#00a200'>".$this->lang['success_new_event_was_added']."</font>";
					$this->DeleteCache();					
				}
			}else{
				if($this->isDebug) $this->arrErrors[] = $sql."<br />".mysql_error();					
				$this->arrMessages[] = "<font color='#a20000'>".$this->lang['error_inserting_new_events']."</font>";
			}
		}else if($event_action == "delete"){
			// delete single event
			$sql = "DELETE FROM "._DB_PREFIX."calendar WHERE ID = ".(int)$event_id;			
			if(!database_void_query($sql)){
				if($this->isDebug) $this->arrErrors[] = $sql."<br />".mysql_error();					
				$this->arrMessages[] = "<font color='#a20000'>".$this->lang['error_deleting_event']."</font>";
			}else{
				$this->arrMessages[] = "<font color='#00a200'>".$this->lang['success_event_was_deleted']."</font>";
				$this->DeleteCache();									
			}
		}else if($event_action == "events_insert"){
			// insert events
			$sql = "INSERT INTO "._DB_PREFIX."events (ID, Name, Description) VALUES (NULL, '".$event_name."', '".$event_description."')";
			$insert_id = database_void_query($sql);	
			if($insert_id != false){
				$this->arrMessages[] = "<font color='#00a200'>".$this->lang['success_new_event_was_added']."</font>";
			}else{
				if($this->isDebug) $this->arrErrors[] = $sql."<br />".mysql_error();					
				$this->arrMessages[] = "<font color='#a20000'>".$this->lang['error_inserting_new_events']."</font>";
			}
		}else if($event_action == "events_update"){
			// update events
			$sql = "UPDATE "._DB_PREFIX."events SET Name='".$event_name."', Description='".$event_description."' WHERE ID = ".(int)$event_id;
			if(database_void_query($sql)){
				$this->arrMessages[] = "<font color='#00a200'>".$this->lang['success_event_was_updated']."</font>";
			}else{
				if($this->isDebug) $this->arrErrors[] = $sql."<br />".mysql_error();					
				$this->arrMessages[] = "<font color='#a20000'>".$this->lang['error_updating_event']."</font>";
			}			
		}else if($event_action == "events_delete"){
			// delete event from Events table
			$sql = "DELETE FROM "._DB_PREFIX."events WHERE ID = ".(int)$event_id;			
			if(!database_void_query($sql)){
				if($this->isDebug) $this->arrErrors[] = $sql."<br />".mysql_error();					
				$this->arrMessages[] = "<font color='#a20000'>".$this->lang['error_deleting_event']."</font>";
			}else{
				$this->arrMessages[] = "<font color='#00a200'>".$this->lang['success_event_was_deleted']."</font>";
				$this->DeleteCache();									
			}
		}
	}
	

	/**
	 *	Draw CSS style
	 *
	*/	
	private function DrawCssStyle()
	{
		echo "<link href='style/".$this->cssStyle."/style.css' rel='stylesheet' type='text/css' />".$this->crLt;		
	}

	/**
	 *	Draw javascript functions
	 *
	*/	
	private function DrawJsFunctions()
	{
		echo "<script type='text/javascript'>".$this->crLt;
		echo "<!--\n
			GL_jump_day   = '".$this->arrToday["mday"]."';
			GL_jump_month = '".$this->ConvertToDecimal($this->arrToday["mon"])."';
			GL_jump_year  = '".$this->arrToday["year"]."';
			GL_view_type  = '".$this->defaultView."';
			GL_today_year = '".$this->arrToday["year"]."';
			GL_today_mon  = '".$this->ConvertToDecimal($this->arrToday["mon"])."';
			GL_today_mday = '".$this->arrToday["mday"]."';
		\n//-->".$this->crLt;
		echo "</script>".$this->crLt;
		echo "<script type='text/javascript' src='js/calendar.js'></script>".$this->crLt;
		if($this->addEventFormType == "floating"){
			echo "<script type='text/javascript' src='js/draggable.js'></script>".$this->crLt;
		}
	}
	
	/**
	 *	Initialize javascript functions
	 *
	*/	
	private function InitializeJsFunctions()
	{
		if($this->addEventFormType == "floating"){
			echo "<script type='text/javascript'>\n";
			echo "<!--\n
				function initialize()
				{
				    ///obj = new dragObject('exampleA', null, new Position(0,0), new Position(570,200), null, null, exampleAEnd, false);
				    addEventDragObject = new dragObject('divAddEvent', 'divAddEvent_Header');
				}
				initialize();	
			\n//-->\n";
			echo "</script>";			
		}		
	}
	
	
	/**
	 *	Draw system messages
	 *
	*/	
	private function DrawMessages()
	{		
		if(count($this->arrMessages) > 0){
			echo "<tr>";
			foreach($this->arrMessages as $key){
				echo "<th class='caption_center' colspan='3'>".$key."</th>".$this->crLt;
			}
			echo "</tr>";
		}
	}
	
	/**
	 *	Draw system errors
	 *
	*/	
	private function DrawErrors()
	{		
		if(count($this->arrErrors) > 0){
			foreach($this->arrErrors as $key){
				echo "<span>".$key."</span><br />".$this->crLt;
			}
		}
	}

	/**
	 *	Draw yearly calendar
	 *
	*/	
	private function DrawYear()
	{
		// start caching
		$cachefile = $this->cacheDir."yearly-".$this->arrParameters['year'].".cch";
		if($this->isCachingAllowed){
			if($this->StartCaching($cachefile)) return true;
		}

		$this->celHeight = "20px";
		echo "<table class='year_container'>".$this->crLt;
		echo "<tr>".$this->crLt;
			echo "<th colspan='3'>";
				echo "<table class='table_navbar'>".$this->crLt;
				echo "<tr>";
				echo "<th class='tr_navbar_left' valign='middle'>
					  ".$this->DrawDateJumper(false, false, false)."
					  </th>".$this->crLt;
				echo "<th class='tr_navbar'></th>".$this->crLt;
				echo "<th class='tr_navbar_right'>				
					  <a href=\"javascript:__doPostBack('view', 'yearly', '".$this->prevYear['year']."', '".$this->arrParameters['month']."', '".$this->arrParameters['day']."')\">".$this->prevYear['year']."</a> |
					  <a href=\"javascript:__doPostBack('view', 'yearly', '".$this->nextYear['year']."', '".$this->arrParameters['month']."', '".$this->arrParameters['day']."')\">".$this->nextYear['year']."</a>
					  </th>".$this->crLt;
				echo "</tr>".$this->crLt;
				echo "</table>".$this->crLt;
			echo "</td>".$this->crLt;
		echo "</tr>".$this->crLt;

		echo "<tr>";
		for($i = 1; $i <= 12; $i++){
			echo "<td align='center' valign='top'>";
			echo "<a href=\"javascript:__doPostBack('view', 'monthly', '".$this->arrParameters['year']."', '".$this->ConvertToDecimal($i)."', '".$this->arrParameters['day']."')\"><b>".$this->arrMonths["$i"]."</b></a>";
			$this->DrawMonthSmall($this->arrParameters['year'], $this->ConvertToDecimal($i));
			echo "</td>";
			if(($i != 1) && ($i % 3 == 0)) echo "</tr><tr>";
		}
		echo "</tr>";
		echo "<tr><td nowrap height='5px'></td></tr>";
		echo "</table>";

		// finish caching
		if($this->isCachingAllowed) $this->FinishCaching($cachefile);			
	}

	/**
	 *	Draw monthly calendar
	 *
	*/	
	private function DrawMonth()
	{
		// start caching
		$cachefile = $this->cacheDir."monthly-".$this->arrParameters['year']."-".$this->arrParameters['month'].".cch";
		if($this->isCachingAllowed){
			if($this->StartCaching($cachefile)) return true;
		}
	
		// today, first day and last day in month
		$firstDay = getdate(mktime(0,0,0,$this->arrParameters['month'],1,$this->arrParameters['year']));
		$lastDay  = getdate(mktime(0,0,0,$this->arrParameters['month']+1,0,$this->arrParameters['year']));

		$arrEventsCount = $this->GetEventCountForMonth($this->arrParameters['year'], $this->arrParameters['month']);
		$actday = 0;
		
		///echo "<pre>";
		///print_r($arrEventsCount);
		///echo "</pre>";

		
		// Create a table with the necessary header informations
		echo "<table class='month'>".$this->crLt;
		echo "<tr>";
			if($this->isWeekNumberOfYear) echo "<th colspan='8'>";
			else echo "<th colspan='7'>";
				echo "<table class='table_navbar'>".$this->crLt;
				echo "<tr>";
				echo "<th class='tr_navbar_left'>
					  ".$this->DrawDateJumper(false)."	
					  </th>".$this->crLt;
				echo "<th class='tr_navbar'>";
				echo " <a href=\"javascript:__doPostBack('view', 'monthly', '".$this->prevMonth['year']."', '".$this->ConvertToDecimal($this->prevMonth['mon'])."', '".$this->arrParameters['day']."')\">&laquo;&laquo;</a> ";
				echo $this->arrParameters['month_full_name']." - ".$this->arrParameters['year'];
				echo " <a href=\"javascript:__doPostBack('view', 'monthly', '".$this->nextMonth['year']."', '".$this->ConvertToDecimal($this->nextMonth['mon'])."', '".$this->arrParameters['day']."')\">&raquo;&raquo;</a> ";
				echo "</th>".$this->crLt;
				echo "<th class='tr_navbar_right'>				
					  <a href=\"javascript:__doPostBack('view', 'monthly', '".$this->prevYear['year']."', '".$this->arrParameters['month']."', '".$this->arrParameters['day']."')\">".$this->prevYear['year']."</a> |
					  <a href=\"javascript:__doPostBack('view', 'monthly', '".$this->nextYear['year']."', '".$this->arrParameters['month']."', '".$this->arrParameters['day']."')\">".$this->nextYear['year']."</a>
					  </th>".$this->crLt;
				echo "</tr>".$this->crLt;
				echo "</table>".$this->crLt;
			echo "</td>".$this->crLt;
		echo "</tr>".$this->crLt;
		echo "<tr class='tr_days'>".$this->crLt;
			if($this->isWeekNumberOfYear) echo "<td class='th_wn'></td>".$this->crLt;
			for($i = $this->weekStartedDay-1; $i < $this->weekStartedDay+6; $i++){
				echo "<td class='th'>".$this->arrWeekDays[($i % 7)][$this->weekDayNameLength]."</td>".$this->crLt;
			}
		echo "</tr>".$this->crLt;		
		
		// Display the first calendar row with correct positioning
		if ($firstDay['wday'] == 0) $firstDay['wday'] = 7;
		$max_empty_days = $firstDay['wday']-($this->weekStartedDay-1);		
		if($max_empty_days < 7){
			echo "<tr class='tr' style='height:".$this->celHeight.";'>".$this->crLt;
			if($this->isWeekNumberOfYear){
				$parts = explode("-", (date("Y-m-d-W", mktime(0,0,0,$this->arrParameters["month"],1-$max_empty_days,$this->arrParameters["year"]))));
				echo "<td class='td_wn'>";
				echo "<a href=\"javascript:__doPostBack('view', 'weekly', '".$parts[0]."', '".$parts[1]."', '".$parts[2]."')\">";
				echo $parts[3];
				echo "</a>";
				echo "</td>".$this->crLt;
			}
			for($i = 1; $i <= $max_empty_days; $i++){
				echo "<td class='td_empty'>&nbsp;</td>".$this->crLt;
			}			
			for($i = $max_empty_days+1; $i <= 7; $i++){
				$actday++;
				if (($actday == $this->arrToday['mday']) && ($this->arrToday['mon'] == $this->arrParameters["month"])) {
					$class = " class='td_actday'";			
				} else if ($actday == $this->arrParameters['day']){				
					$class = " class='td_selday'";				
				} else {
					$class = " class='td'";
				} 
				echo "<td$class>";
				echo "<a href=\"javascript:__doPostBack('view', 'daily', '".$this->arrParameters["year"]."', '".$this->arrParameters["month"]."', '".$this->ConvertToDecimal($actday)."')\">".$actday."</a>";
				echo "<br />";
				$events_count = $arrEventsCount[$this->ConvertToDecimal($actday)];
				echo ($events_count > 0) ? (($events_count > 1) ? $events_count." events" : $events_count." event") : "";
				echo "</td>".$this->crLt;
			}
			echo "</tr>".$this->crLt;
		}
		
		//Get how many complete weeks are in the actual month
		$fullWeeks = floor(($lastDay['mday']-$actday)/7);
		
		for ($i=0;$i<$fullWeeks;$i++){
			echo "<tr class='tr' style='height:".$this->celHeight.";'>".$this->crLt;
			if($this->isWeekNumberOfYear){
				$parts = explode("-", (date("Y-m-d-W", mktime(0,0,0,$this->arrParameters["month"],$actday+1,$this->arrParameters["year"]))));				
				echo "<td class='td_wn'>";
				echo "<a href=\"javascript:__doPostBack('view', 'weekly', '".$parts[0]."', '".$parts[1]."', '".$parts[2]."')\">";
				echo $parts[3];
				echo "</a>";
				echo "</td>".$this->crLt;
			}
			for ($j=0;$j<7;$j++){
				$actday++;
				if (($actday == $this->arrToday['mday']) && ($this->arrToday['mon'] == $this->arrParameters["month"])) {
					$class = " class='td_actday'";
				} else if ($actday == $this->arrParameters['day']){				
					$class = " class='td_selday'";				
				} else if ($this->arrWeekDays[($j % 7)]["short"] == "Sun") {
					$class = ($this->sundayColor) ? " class='td_sunday'" : " class='td'";				
				} else {
					$class = " class='td'";
				}				
				echo "<td$class>";
				echo "<a href=\"javascript:__doPostBack('view', 'daily', '".$this->arrParameters["year"]."', '".$this->arrParameters["month"]."', '".$this->ConvertToDecimal($actday)."')\">".$actday."</a>";
				echo "<br />";
			    $events_count = $arrEventsCount[$this->ConvertToDecimal($actday)];
				echo ($events_count > 0) ? (($events_count > 1) ? $events_count." events" : $events_count." event") : "";
				echo "</td>".$this->crLt;
			}
			echo "</tr>".$this->crLt;
		}
		
		//Now display the rest of the month
		if ($actday < $lastDay['mday']){
			echo "<tr class='tr' style='height:".$this->celHeight.";'>".$this->crLt;
			if($this->isWeekNumberOfYear){
				$parts = explode("-", (date("Y-m-d-W", mktime(0,0,0,$this->arrParameters["month"],$actday+1,$this->arrParameters["year"]))));								
				echo "<td class='td_wn'>";
				echo "<a href=\"javascript:__doPostBack('view', 'weekly', '".$parts[0]."', '".$parts[1]."', '".$parts[2]."')\">";
				echo $parts[3];
				echo "</a>";
				echo "</td>".$this->crLt;
			}

			for ($i=0; $i<7;$i++){
				$actday++;
				if (($actday == $this->arrToday['mday']) && ($this->arrToday['mon'] == $this->arrParameters["month"])) {
					$class = " class='td_actday'";
				} else if ($this->arrWeekDays[($i % 7)]["short"] == "Sun") {
					$class = ($this->sundayColor) ? " class='td_sunday'" : " class='td'";				
				} else {
					$class = " class='td'";
				}				
				if ($actday <= $lastDay['mday']){
					echo "<td$class>";
					echo "<a href=\"javascript:__doPostBack('view', 'daily', '".$this->arrParameters["year"]."', '".$this->arrParameters["month"]."', '".$this->ConvertToDecimal($actday)."')\">".$actday."</a>";
					echo "<br />";
					$events_count = $arrEventsCount[$this->ConvertToDecimal($actday)];
					echo ($events_count > 0) ? (($events_count > 1) ? $events_count." events" : $events_count." event") : "";
					echo "</td>".$this->crLt;
				} else {
					echo "<td class='td_empty'>&nbsp;</td>".$this->crLt;
				}
			}					
			echo "</tr>".$this->crLt;
		}		
		echo "</table>".$this->crLt;

		// finish caching
		if($this->isCachingAllowed) $this->FinishCaching($cachefile);			
	}

	/**
	 *	Draw small monthly calendar
	 *
	*/	
	private function DrawMonthSmall($year = "", $month = "")
	{
		if($month == "") $month = $this->arrParameters['month'];
		if($year == "") $year = $this->arrParameters['year'];
		$week_rows = 0;
		$actday = 0;
		
		// today, first day and last day in month
		$firstDay = getdate(mktime(0,0,0,$month,1,$year));
		$lastDay  = getdate(mktime(0,0,0,$month+1,0,$year));
		
		// create a table with the necessary header informations
		echo "<table class='month_small'>".$this->crLt;
		echo "<tr class='tr_small_days'>".$this->crLt;
			if($this->isWeekNumberOfYear) echo "<td class='th_small_wn'></td>".$this->crLt;
			for($i = $this->weekStartedDay-1; $i < $this->weekStartedDay+6; $i++){
				echo "<td class='th_small'>".$this->arrWeekDays[($i % 7)]["short"]."</td>".$this->crLt;		
			}
		echo "</tr>".$this->crLt;
		
		// display the first calendar row with correct positioning
		if ($firstDay['wday'] == 0) $firstDay['wday'] = 7;
		$max_empty_days = $firstDay['wday']-($this->weekStartedDay-1);		
		if($max_empty_days < 7){
			echo "<tr class='tr_small' style='height:".$this->celHeight.";'>".$this->crLt;
			if($this->isWeekNumberOfYear) echo "<td class='td_small_wn'>".date("W", mktime(0,0,0,$month,1-$max_empty_days,$year))."</td>".$this->crLt;			
			for($i = 1; $i <= $max_empty_days; $i++){
				echo "<td class='td_small_empty'>&nbsp;</td>".$this->crLt;
			}			
			for($i = $max_empty_days+1; $i <= 7; $i++){
				$actday++;
				if (($actday == $this->arrToday['mday']) && ($this->arrToday['mon'] == $month) && ($this->arrToday['year'] == $year)) {
					$class = " class='td_small_actday'";			
				} else {
					$class = " class='td_small'";
				} 
				echo "<td$class>$actday</td>".$this->crLt;
			}
			echo "</tr>".$this->crLt;
			$week_rows++;
		}
		
		// get how many complete weeks are in the actual month
		$fullWeeks = floor(($lastDay['mday']-$actday)/7);
		
		for ($i=0;$i<$fullWeeks;$i++){
			echo "<tr class='tr_small' style='height:".$this->celHeight.";'>".$this->crLt;
			if($this->isWeekNumberOfYear) echo "<td class='td_small_wn'>".date("W", mktime(0,0,0,$month,$actday,$year))."</td>".$this->crLt;			
			for ($j=0;$j<7;$j++){
				$actday++;
				if (($actday == $this->arrToday['mday']) && ($this->arrToday['mon'] == $month) && ($this->arrToday['year'] == $year)) {
					$class = " class='td_small_actday'";
				} else {
					$class = " class='td_small'";
				}
				echo "<td$class>$actday</td>".$this->crLt;
			}
			echo "</tr>".$this->crLt;
			$week_rows++;			
		}
		
		// now display the rest of the month
		if ($actday < $lastDay['mday']){
			echo "<tr class='tr_small' style='height:".$this->celHeight.";'>".$this->crLt;
			if($this->isWeekNumberOfYear) echo "<td class='td_small_wn'>".date("W", mktime(0,0,0,$month,$actday,$year))."</td>".$this->crLt;			
			for ($i=0; $i<7;$i++){
				$actday++;
				if (($actday == $this->arrToday['mday']) && ($this->arrToday['mon'] == $month) && ($this->arrToday['year'] == $year)) {
					$class = " class='td_small_actday'";
				} else {
					$class = " class='td_small'";
				}				
				if ($actday <= $lastDay['mday']){
					echo "<td$class>$actday</td>".$this->crLt;
				} else {
					echo "<td class='td_small_empty'>&nbsp;</td>".$this->crLt;
				}
			}					
			echo "</tr>".$this->crLt;
			$week_rows++;
		}
		
		// complete last line
		if($week_rows < 5){
			echo "<tr class='tr_small' style='height:".$this->celHeight.";'>".$this->crLt;
			if($this->isWeekNumberOfYear) echo "<td class='td_small_wn'></td>".$this->crLt;
			for ($i=0; $i<7;$i++){
				echo "<td class='td_small_empty'>&nbsp;</td>".$this->crLt;
			}					
			echo "</tr>".$this->crLt;
			$week_rows++;			
		}
		
		echo "</table>".$this->crLt;
		
	}	

	/**
	 *	Draw weekly calendar
	 *
	*/	
	private function DrawWeek()
	{
		// start caching
		$cachefile = $this->cacheDir."weekly-".$this->arrParameters['year']."-".$this->arrParameters["month"]."-".$this->arrParameters["day"].".cch";
		if($this->isCachingAllowed){
			if($this->StartCaching($cachefile)) return true;
		}

		// today, first day and last day in month
		$firstDay = getdate(mktime(0,0,0,$this->arrParameters['month'],1,$this->arrParameters['year']));
		$lastDay  = getdate(mktime(0,0,0,$this->arrParameters['month']+1,0,$this->arrParameters['year']));
		
		// Create a table with the necessary header informations
		echo "<table class='month' border=0>".$this->crLt;
		echo "<tr>".$this->crLt;
		echo "<th colspan='7'>".$this->crLt;
			echo "<table border=0 width='100%'>".$this->crLt;
			echo "<tr>";
			echo "<th class='tr_navbar_left'>".$this->DrawDateJumper(false)."</th>";				  
			echo "<th class='tr_navbar'>";
            // draw Month Year - Month Year line
			if($this->arrParameters['year'] != $this->nextWeek['year']){
				echo $this->prevWeek['month']." ".$this->arrParameters['year']." - ".$this->nextWeek['month']." ".$this->nextWeek['year'];
			}else{
				$month = (int)$this->arrParameters['month'];
				echo $this->arrMonths["$month"].(($month != $this->nextWeek['mon']) ? " - ".$this->nextWeek['month'] : "")." ".$this->arrParameters['year'];
			}
			echo "</th>".$this->crLt;
			echo "<th class='tr_navbar_right'>				
				  <a href=\"javascript:__doPostBack('view', 'weekly', '".$this->prevWeek['year']."', '".$this->ConvertToDecimal($this->prevWeek['mon'])."', '".$this->ConvertToDecimal($this->prevWeek['mday'])."')\">".$this->ConvertToDecimal($this->prevWeek['mday'])."th ".$this->prevWeek['month']."</a> |
				  <a href=\"javascript:__doPostBack('view', 'weekly', '".$this->nextWeek['year']."', '".$this->ConvertToDecimal($this->nextWeek['mon'])."', '".$this->ConvertToDecimal($this->nextWeek['mday'])."')\">".$this->ConvertToDecimal($this->nextWeek['mday'])."th ".$this->nextWeek['month']."</a>
				  </th>".$this->crLt;
			echo "</tr>".$this->crLt;
			echo "</table>".$this->crLt;			  
		echo "</th>".$this->crLt;
		echo "</tr>".$this->crLt;
		echo "<tr class='tr_days'>".$this->crLt;
			for($i = $this->weekStartedDay-1; $i < $this->weekStartedDay+6; $i++){
				$week_day = date("w", mktime(0,0,0,$this->arrParameters["month"],$this->arrParameters["day"]+$i,$this->arrParameters["year"]));
				echo "<td class='th'>".$this->arrWeekDays[($week_day % 7)][$this->weekDayNameLength]."</td>";						
			}
		echo "</tr>".$this->crLt;
		
		// Display the first calendar row with correct positioning
		echo "<tr>".$this->crLt;
		if ($firstDay['wday'] == 0) $firstDay['wday'] = 7;
		$actday = 0;
		for($i = 0; $i <= 6; $i++){
			$actday = date("d", mktime(0,0,0,$this->arrParameters["month"],$this->arrParameters["day"]+$i,$this->arrParameters["year"]));
			$actmon = date("n", mktime(0,0,0,$this->arrParameters["month"],$this->arrParameters["day"]+$i,$this->arrParameters["year"]));
			$week_day = date("w", mktime(0,0,0,$this->arrParameters["month"],$this->arrParameters["day"]+$i,$this->arrParameters["year"]));
			
			if (($actday == $this->arrToday['mday']) && ($this->arrToday['mon'] == $this->arrParameters["month"])) {
				$class = " class='td_actday_w'";
			} else if ($this->arrWeekDays[($week_day % 7)]["short"] == "Sun") {
				$class = ($this->sundayColor) ? " class='td_sunday_w'" : " class='td_w'";				
			} else {				
				$class = " class='td_w'";
			}
			echo "<td$class>".$this->crLt;
				
				// prepare events for this day of week
				$sql = "SELECT
							"._DB_PREFIX."calendar.ID,
							"._DB_PREFIX."calendar.EventDate,
							"._DB_PREFIX."calendar.EventTime,
							DATE_FORMAT("._DB_PREFIX."calendar.EventTime, '%H') as event_time_formatted,
							"._DB_PREFIX."events.Name,
							"._DB_PREFIX."events.Description
						FROM "._DB_PREFIX."calendar
							INNER JOIN "._DB_PREFIX."events ON "._DB_PREFIX."calendar.EventID = "._DB_PREFIX."events.ID
						WHERE
							"._DB_PREFIX."calendar.EventDate = '".$this->arrParameters['year']."-".$this->ConvertToDecimal($actmon)."-".$actday."' 
						ORDER BY "._DB_PREFIX."calendar.ID ASC";
						
				$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);
				
				$arrEvents = array(
					"00"=>array(), "01"=>array(), "02"=>array(), "03"=>array(), "04"=>array(), "05"=>array(), "06"=>array(), "07"=>array(), "08"=>array(), "09"=>array(), "10"=>array(), "11"=>array(),
					"12"=>array(), "13"=>array(), "14"=>array(), "15"=>array(), "16"=>array(), "17"=>array(), "18"=>array(), "19"=>array(), "20"=>array(), "21"=>array(), "22"=>array(), "23"=>array());
					 
				foreach($result[0] as $key => $val){
					$arrEvents[$val['event_time_formatted']][] = array("id"=>$val['ID'], "name"=>$val['Name']);
				}
			
				echo "<table width='100%' border='0' cellpadding='0' celspacing='0'>".$this->crLt;
				echo "<tr class='td_header'><td align='left' colspan='2'><b><a href=\"javascript:__doPostBack('view', 'daily', '".$this->arrParameters["year"]."', '".$this->ConvertToDecimal($actmon)."', '".$actday."')\">".$this->arrMonths[$actmon]." $actday</a></b></td></tr>".$this->crLt;
				for($i_hour=0; $i_hour<24; $i_hour++){
					echo "<tr>";
					echo "<td align='left' width='".(($this->timeFormat == "24") ? "45px" : "64px")."'>".$this->ConvertToHour($i_hour, true)." <a href=\"javascript:__CallAddEventForm('divAddEvent', '".$this->arrParameters["year"]."', '".$this->ConvertToDecimal($actmon)."', '".$actday."', '".$this->ConvertToHour($i_hour)."');\" title='".$this->lang["add_new_event"]."'>+</a></td>";
					echo "<td align='left' style='font-weight:normal;'>";
					echo $this->GetEventsList($arrEvents[$this->ConvertToDecimal($i_hour)], (($this->timeFormat == "24") ? 7 : 4));
					echo "</td>";
					echo "</tr>".$this->crLt;
				}
				echo "</table>".$this->crLt;
			echo "</td>".$this->crLt;
		}
		echo "</tr>".$this->crLt;
		echo "</table>".$this->crLt;		

		$this->DrawEventForm();

		// finish caching
		if($this->isCachingAllowed) $this->FinishCaching($cachefile);			
	}

	/**
	 *	Draw daily calendar
	 *
	*/	
	private function DrawDay()
	{
		// start caching
		$cachefile = $this->cacheDir."daily-".$this->arrParameters['year']."-".$this->arrParameters["month"]."-".$this->arrParameters["day"].".cch";
		if($this->isCachingAllowed){
			if($this->StartCaching($cachefile)) return true;
		}
		$SearchDate = $this->arrParameters['year']."-".$this->arrParameters['month']."-".$this->arrParameters['day'];
		
		$sql = "SELECT c.*, e.*	 
				from pf_calendar as c
				LEFT JOIN pf_events as e on c.EventID=e.ID
				where c.UserID='".$_SESSION['userid']."' and
				(c.EventDate = '$SearchDate' or (c.EntryStart <= '$SearchDate' and c.EntryEnd >= '$SearchDate') or c.EntryType ='notify')
				order by c.EventDate";  
				
		
		/*$sql = "SELECT c.*, e.* from pf_calendar
					"._DB_PREFIX."calendar.ID,
					"._DB_PREFIX."calendar.EventDate,
					"._DB_PREFIX."calendar.EventTime,
					DATE_FORMAT("._DB_PREFIX."calendar.EventTime, '%H') as event_time_formatted,					
					"._DB_PREFIX."events.Name,
					"._DB_PREFIX."events.Description
				FROM "._DB_PREFIX."calendar
					INNER JOIN "._DB_PREFIX."events ON "._DB_PREFIX."calendar.EventID = "._DB_PREFIX."events.ID
				WHERE
					"._DB_PREFIX."calendar.EventDate = '".$this->arrParameters['year']."-".$this->arrParameters['month']."-".$this->arrParameters['day']."' 
				ORDER BY "._DB_PREFIX."calendar.ID ASC";
			*/	
		$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);
		
		/*
		$arrEvents = array(
		    "00"=>array(), "01"=>array(), "02"=>array(), "03"=>array(), "04"=>array(), "05"=>array(), "06"=>array(), "07"=>array(), "08"=>array(), "09"=>array(), "10"=>array(), "11"=>array(),
			"12"=>array(), "13"=>array(), "14"=>array(), "15"=>array(), "16"=>array(), "17"=>array(), "18"=>array(), "19"=>array(), "20"=>array(), "21"=>array(), "22"=>array(), "23"=>array());
             */
			 
		
		
		// Create a table with the necessary header informations
		echo "<div align=\"center\"><table>
<tr>
<td align=\"center\"><a href=\"javascript:__doPostBack('view', 'daily', '".$this->prevDay['year']."', '".$this->ConvertToDecimal($this->prevDay['mon'])."', '".$this->ConvertToDecimal($this->prevDay['mday'])."')\"><img id=\"cal_left_arrow\"src=\"/images/cal_left_arrow.png\" width=\"34\" height=\"33\" onmouseover=\"roll_over(this, '/images/cal_left_arrow_over.png')\" onmouseout=\"roll_over(this, '/images/cal_left_arrow.png')\" class=\"navbuttons\" border=\"0\"/></a></td>
<td background=\"/images/calendar_button_bg.png\" width=\"144\" height=\"52\" align=\"center\" ><img id=\"cal_day_button\"src=\"/images/cal_day_button.png\" onclick=\"javascript:__doPostBack('view','daily')\" onmouseover=\"roll_over(this, '/images/cal_day_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_day_button.png')\" class=\"navbuttons\"/><img id=\"cal_month_button\"src=\"/images/cal_week_button.png\" onclick=\"javascript:__doPostBack('view','weekly')\"  onmouseover=\"roll_over(this, '/images/cal_week_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_week_button.png')\" class=\"navbuttons\"/><img id=\"cal_month_button\"src=\"/images/cal_month_button.png\" onclick=\"javascript:__doPostBack('view','monthly')\" onmouseover=\"roll_over(this, '/images/cal_month_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_month_button.png')\" class=\"navbuttons\"/></td><td background=\"/images/calendar_button_bg.png\" width=\"144\" height=\"52\" align=\"center\"><a href=\"/myvolt/".trim($_SESSION['username'])."/\"><img id=\"cal_my_button\" src=\"/images/cal_my_button.png\" border=\"0\" onmouseover=\"roll_over(this, '/images/cal_my_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_my_button.png')\" class=\"navbuttons\"/></a><a href=\"/".trim($_SESSION['username'])."/\"><img src=\"/images/cal_w3_button.png\" id=\"cal_w3_button\" onmouseover=\"roll_over(this, '/images/cal_w3_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_w3_button.png')\" class=\"navbuttons\" border=\"0\"/></a><img id=\"call_all_button\" src=\"/images/cal_all_button.png\" onmouseover=\"roll_over(this, '/images/cal_all_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_all_button.png')\" class=\"navbuttons\" border=\"0\"/></td>
<td><a href=\"javascript:__doPostBack('view', 'daily', '".$this->nextDay['year']."', '".$this->ConvertToDecimal($this->nextDay['mon'])."', '".$this->ConvertToDecimal($this->nextDay['mday'])."')\"><img id=\"cal_right_button\" src=\"/images/cal_right_arrow.png\" width=\"34\" height=\"33\" onmouseover=\"roll_over(this, '/images/cal_right_arrow_over.png')\" onmouseout=\"roll_over(this, '/images/cal_right_arrow.png')\" class=\"navbuttons\" border=\"0\")/></a>&nbsp;<img src=\"/images/cal_plus_button.png\" id=\"cal_plus_button\" onmouseover=\"roll_over(this, '/images/cal_plus_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_plus_button.png')\" class=\"navbuttons\"/></td>
</tr>
</table>";

echo "<table>
<tr>
<td><a href=\"/schedule/index.php?filter=reminder\"><img id=\"cal_reminder_filter\"src=\"/images/cal_reminders_button.png\" onmouseover=\"roll_over(this, '/images/cal_reminders_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_reminders_button.png')\" class=\"navbuttons\" border=\"0\"/></a><a href=\"/schedule/index.php?filter=events\"><img id=\"cal_event_filter\"src=\"/images/cal_events_button.png\" onmouseover=\"roll_over(this, '/images/cal_events_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_events_button.png')\" class=\"navbuttons\" border=\"0\"/></a><a href=\"/schedule/index.php?filter=overdue\"><img id=\"cal_overdue_filter\"src=\"/images/cal_overdue_button.png\" onmouseover=\"roll_over(this, '/images/cal_overdue_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_overdue_button.png')\" class=\"navbuttons\" border=\"0\"/></a><a href=\"/schedule/index.php\"><img id=\"cal_all_filter\"src=\"/images/cal_all_select.png\" onmouseover=\"roll_over(this, '/images/cal_all_select_over.png')\" onmouseout=\"roll_over(this, '/images/cal_all_select.png')\" class=\"navbuttons\" border=\"0\"/></a></td><td valign=\"top\"><select name=\"txtWordFilter\" style=\"width:150px;\" onchange='window.location = this.options[this.selectedIndex].value;' \"><option value=\"\">--select</option><option value=\"index.php?key=todo\">To Dos</option></select></td></tr></table></div>";
		echo "<table class='day_navigation' width='100%' border='0' cellpadding='0' celspacing='0'>".$this->crLt;
		echo "<tr>";
		echo "<th class='tr_navbar_left'>
			  ".$this->DrawDateJumper(false)."	
			  </th>".$this->crLt;
		echo "<th class='tr_navbar'>";
		
		//echo " <a href=\"javascript:__doPostBack('view', 'daily', '".$this->prevDay['year']."', '".$this->ConvertToDecimal($this->prevDay['mon'])."', '".$this->ConvertToDecimal($this->prevDay['mday'])."')\">&laquo;&laquo;</a> ";
		echo $this->arrParameters['month_full_name']." ".$this->arrParameters['day'].", ".$this->arrParameters['year'];
		//echo " <a href=\"javascript:__doPostBack('view', 'daily', '".$this->nextDay['year']."', '".$this->ConvertToDecimal($this->nextDay['mon'])."', '".$this->ConvertToDecimal($this->nextDay['mday'])."')\">&raquo;&raquo;</a> ";
		echo "</th>".$this->crLt;
		echo "<th class='tr_navbar_right' colspan='2'>				
			  <a href=\"javascript:__doPostBack('view', 'daily', '".$this->prevWeek['year']."', '".$this->prevWeek['mon']."', '".$this->ConvertToDecimal($this->prevWeek['mday'])."')\">".$this->ConvertToDecimal($this->prevWeek['mday'])."th ".$this->prevWeek['month']."</a> |
			  <a href=\"javascript:__doPostBack('view', 'daily', '".$this->nextWeek['year']."', '".$this->nextWeek['mon']."', '".$this->ConvertToDecimal($this->nextWeek['mday'])."')\">".$this->ConvertToDecimal($this->nextWeek['mday'])."th ".$this->nextWeek['month']."</a>
			  </th>".$this->crLt;
		echo "</tr>".$this->crLt;
		echo "</table>".$this->crLt; 

		echo "<table class='day' width='100%' border='0' cellpadding='0' celspacing='0'>".$this->crLt;
		for($i_hour=0; $i_hour<24; $i_hour++){
			if($this->ConvertToDecimal($i_hour) == $this->arrToday['hours']) {
				$td_acthour_d = " class='td_acthour_d_h'";
				$td_d = " class='td_acthour_d'";
			} else {
				$td_acthour_d = " class='td_d_h'";
				$td_d = " class='td_d'";
			}
			echo "<tr>".$this->crLt;
			echo "<td".$td_acthour_d."><b>".$this->ConvertToHour($i_hour, true)."</b></td>".$this->crLt;
			echo "<td".$td_d.">  <a href=\"javascript:__CallAddEventForm('divAddEvent', '".$this->arrParameters["year"]."', '".$this->arrParameters["month"]."', '".$this->arrParameters["day"]."', '".$this->ConvertToHour($i_hour)."');\" title='Add New Event'>+</a> ";
           echo $this->GetEventsList($arrEvents[$this->ConvertToDecimal($i_hour)]);
			echo "</td>".$this->crLt;
			echo "</tr>".$this->crLt;
		}
		echo "</table>".$this->crLt;
		foreach($result[0] as $key => $val){
			$CalID = $val['ID'];
			echo $this->GetCalendarItems($CalID);
/////CHANGE THE ARRAY HERE TO INCLUDE EVERYTHING ELSE Username, Reminder Type, PRoject ID, etc
			//$arrEvents[][] = array("Title"=>$val['Title'], "EventID"=>$val['EventID']);
			
			
			
		}
		

	
		$this->DrawEventForm();

		// finish caching
		if($this->isCachingAllowed) $this->FinishCaching($cachefile);			
	}

	/**
	 *	Draw events additing form
	 *
	*/	
	private function DrawEventsAddForm()
	{
		// draw Add Event Form from template
		$content = file_get_contents("template/events_add_form.tpl");			   			   
        if($content !== false){
			echo $content;
		}
	}	

	/**
	 *	Draw events editing form
	 *
	*/	
	private function DrawEventsEditForm($event_id)
	{
		// draw Edit Event Form from template
		$content = file_get_contents("template/events_edit_form.tpl");			   			   
        if($content !== false){

			$sql = "SELECT
						"._DB_PREFIX."events.ID,
						"._DB_PREFIX."events.Name,
						"._DB_PREFIX."events.Description
					FROM "._DB_PREFIX."events
					WHERE "._DB_PREFIX."events.ID = ".(int)$event_id;
					
			$result = database_query($sql, _DATA_ONLY, _FIRST_ROW_ONLY, _FETCH_ASSOC);
			if(!empty($result)){
				$content = str_replace("{h:event_id}", $result["ID"], $content);
				$content = str_replace("{h:event_name}", $result["Name"], $content);
				$content = str_replace("{h:event_description}", $result["Description"], $content);
				echo $content;
			}
		}
	}	
	

	/**
	 *	Draw events management
	 *
	*/	
	private function DrawEventsManagement()
	{
		$sql = "SELECT
					"._DB_PREFIX."events.ID,
					"._DB_PREFIX."events.Name,
					"._DB_PREFIX."events.Description
				FROM "._DB_PREFIX."events
				ORDER BY "._DB_PREFIX."events.ID ASC
				LIMIT 0, 1000";
				
		$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);
		$content = file_get_contents("template/events_management_row.tpl");			   			   
		
		echo "<fieldset style='margin-top:20px; padding-bottom:7px;'>
			  <legend><b>Events Management</b></legend>
			  <table align='center' width='100%'>
			  <tr>
				<th></th>
				<th align='left'>Event Name</th>
				<th align='left'>Event Description</th>
				<th align='center'>Actions</th>
			  </tr>";
		$events_count = 0;	  
		foreach($result[0] as $key => $val){
			$temp_content = $content;
			$events_count++;
			$temp_content = str_replace("{h:event_id}", $val["id"], $temp_content);
			$temp_content = str_replace("{h:event_num}", $events_count.". ", $temp_content);
			$temp_content = str_replace("{h:event_name}", $val["name"], $temp_content);
			$temp_content = str_replace("{h:event_description}", $val["description"], $temp_content);
            echo $temp_content;
		}		
		
		echo "</table>
		      </fieldset>";
	}	

	/**
	 *	Draw event form
	 *	
	*/	
	private function DrawEventForm(){
		// draw Add Event Form from template
		$sql = "SELECT
					"._DB_PREFIX."events.ID,
					"._DB_PREFIX."events.Name,
					"._DB_PREFIX."events.Description
				FROM "._DB_PREFIX."events
				ORDER BY "._DB_PREFIX."events.ID ASC
				LIMIT 0, 1000";
				
		$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);

		$content = file_get_contents("template/add_event_form.tpl");
		
        if($content !== false){
			$content = str_replace("{h:on_mousedown_header}", (($this->addEventFormType == "floating") ? " onmousedown='grab(this, event)'" : ""), $content);
			$content = str_replace("{h:class_move}", (($this->addEventFormType == "floating") ? " move" : ""), $content);
			$content = str_replace("{h:on_mousedown_body}", (($this->addEventFormType == "floating") ? " onmousedown='grab(false, event);'" : ""), $content);
			$content = str_replace("{h:ddl_from}", $this->DrawDateTime("from", $this->arrParameters["year"], $this->arrParameters["month"], $this->arrParameters["day"], $this->arrToday['hours'], false), $content);
			$content = str_replace("{h:ddl_to}", $this->DrawDateTime("to", $this->arrParameters["year"], $this->arrParameters["month"], $this->arrParameters["day"], $this->arrToday['hours'], false), $content);
			
			$ddl_event_name = "";
			foreach($result[0] as $key => $val){
				$ddl_event_name .= "<option value='".$val["ID"]."'>".$val["Name"]."</option>";
			}
			$content = str_replace("{h:ddl_event_name}", $ddl_event_name, $content);
			echo $content;
		}
	}

	/**
	 *	Draw calendar types changer
	 *  	@param $draw - draw or return
	*/	
	private function DrawTypesChanger($draw = true)
	{
		$result ="<table>
<tr>
<td><img id=\"cal_left_arrow\"src=\"/images/cal_left_arrow.png\" width=\"34\" height=\"33\" onmouseover=\"roll_over(this, '/images/cal_left_arrow_over.png')\" onmouseout=\"roll_over(this, '/images/cal_left_arrow.png')\" class=\"navbuttons\"/></td>
<td background=\"/images/calendar_button_bg.png\" width=\"144\" height=\"52\" align=\"center\" ><img id=\"cal_day_button\"src=\"/images/cal_day_button.png\" onclick=\"javascript:__doPostBack('view','daily')\" onmouseover=\"roll_over(this, '/images/cal_day_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_day_button.png')\" class=\"navbuttons\"/><img id=\"cal_month_button\"src=\"/images/cal_week_button.png\" onclick=\"javascript:__doPostBack('view','weekly')\"  onmouseover=\"roll_over(this, '/images/cal_week_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_week_button.png')\" class=\"navbuttons\"/><img id=\"cal_month_button\"src=\"/images/cal_month_button.png\" onclick=\"javascript:__doPostBack('view','monthly')\" onmouseover=\"roll_over(this, '/images/cal_month_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_month_button.png')\" class=\"navbuttons\"/></td><td background=\"/images/calendar_button_bg.png\" width=\"144\" height=\"52\" align=\"center\"><a href=\"/myvolt/".trim($_SESSION['username'])."/\"><img id=\"cal_my_button\" src=\"/images/cal_my_button.png\" border=\"0\" onmouseover=\"roll_over(this, '/images/cal_my_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_my_button.png')\" class=\"navbuttons\"/></a><a href=\"/".trim($_SESSION['username'])."/\"><img src=\"/images/cal_w3_button.png\" id=\"cal_w3_button\" onmouseover=\"roll_over(this, '/images/cal_w3_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_w3_button.png')\" class=\"navbuttons\" border=\"0\"/></a><img id=\"call_all_button\" src=\"/images/cal_all_button.png\" onmouseover=\"roll_over(this, '/images/cal_all_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_all_button.png')\" class=\"navbuttons\" border=\"0\"/></td>
<td><img id=\"cal_right_button\" src=\"/images/cal_right_arrow.png\" width=\"34\" height=\"33\" onmouseover=\"roll_over(this, '/images/cal_right_arrow_over.png')\" onmouseout=\"roll_over(this, '/images/cal_right_arrow.png')\" class=\"navbuttons\"/>&nbsp;<img src=\"/images/cal_plus_button.png\" id=\"cal_plus_button\" onmouseover=\"roll_over(this, '/images/cal_plus_button_over.png')\" onmouseout=\"roll_over(this, '/images/cal_plus_button.png')\" class=\"navbuttons\"/></td>
</tr>
</table>";


		//$result = "<select class='form_select' name='view_type' id='view_type' onchange=\"javascript:__doPostBack('view', this.value)\">";
		//foreach($this->arrViewTypes as $key => $val){
			//$result .= "<option value='".$key."'".(($this->arrParameters['view_type'] == $key) ? " selected='selected'" : "").">".$val."</option>";
		//}
		//$result .= "</select>";
		
		if($draw){
			echo $result;
		}else{
			return $result;
		}
	}

	/**
	 *	Draw today jumper
	 *  	@param $draw - draw or return
	*/	
	private function DrawTodayJumper($draw = true)
	{
		$result = "<input class='form_button' type='button' value='Today' onclick=\"javascript:__JumpTodayDate()\" />";
		if($draw){
			echo $result;
		}else{
			return $result;
		}
	}
	
	/**
	 *	Draw date jumper
	 *  	@param $draw - draw or return
	*/	
	private function DrawDateJumper($draw = true, $draw_day = true, $draw_month = true, $draw_year = true)
	{
		$result = "";
		
		// draw days ddl
		if($draw_day){
			$result = "<select class='form_select' name='jump_day' id='jump_day'>";
			for($i=1; $i <= 31; $i++){
				$i_converted = $this->ConvertToDecimal($i);
				$result .= "<option value='".$i_converted."'".(($this->arrParameters["day"] == $i_converted) ? " selected='selected'" : "").">".$i_converted."</option>";
			}
			$result .= "</select> ";			
		}else{
			$result .= "<input type='hidden' name='jump_day' id='jump_day' value='".$this->arrToday["mday"]."' />";			
		}

		// draw months ddl
		if($draw_month){			
			$result .= "<select class='form_select' name='jump_month' id='jump_month'>";
			for($i=1; $i <= 12; $i++){
				$i_converted = $this->ConvertToDecimal($i);
				$result .= "<option value='".$i_converted."'".(($this->arrParameters["month"] == $i_converted) ? " selected='selected'" : "").">".$this->arrMonths[$i]."</option>";
			}
			$result .= "</select> ";			
		}else{
			$result .= "<input type='hidden' name='jump_month' id='jump_month' value='".$this->ConvertToDecimal($this->arrToday["mon"])."' />";			
		}

		// draw years ddl
		if($draw_year){			
			$result .= "<select class='form_select' name='jump_year' id='jump_year'>";
			for($i=$this->arrParameters["year"]-10; $i <= $this->arrParameters["year"]+10; $i++){
				$result .= "<option value='".$i."'".(($this->arrParameters["year"] == $i) ? " selected='selected'" : "").">".$i."</option>";
			}
			$result .= "</select> ";
		}else{
			$result .= "<input type='hidden' name='jump_year' id='jump_year' value='".$this->arrToday["year"]."' />";			
		}
		
		$result .= "<input class='form_button' type='button' value='Go' onclick='__JumpToDate()' />";
		
		if($draw){
			echo $result;
		}else{
			return $result;
		}
	}

	/**
	 *	Draw datetime calendar
	 *  	@param $draw - draw or return
	 *  	@param $type - from|to
	*/	
	private function DrawDateTime($type = "from", $year = "", $month = "", $day = "", $hour = "", $draw = true)
	{
		$result = ""; 
		
		// draw days ddl
		$result = "<select class='form_select' name='event_".$type."_day' id='event_".$type."_day'>";
		for($i=1; $i <= 31; $i++){
			$i_converted = $this->ConvertToDecimal($i);
			$result .= "<option value='".$i_converted."'".(($day == $i_converted) ? " selected='selected'" : "").">".$i_converted."</option>";
		}
		$result .= "</select> ";			

		// draw months ddl
		$result .= "<select class='form_select' name='event_".$type."_month' id='event_".$type."_month'>";
		for($i=1; $i <= 12; $i++){
			$i_converted = $this->ConvertToDecimal($i);
			$result .= "<option value='".$i_converted."'".(($month == $i_converted) ? " selected='selected'" : "").">".$this->arrMonths[$i]."</option>";
		}
		$result .= "</select> ";			

		// draw years ddl
		$result .= "<select class='form_select' name='event_".$type."_year' id='event_".$type."_year'>";
		for($i=$year-10; $i <= $year+10; $i++){
			$result .= "<option value='".$i."'".(($year == $i) ? " selected='selected'" : "").">".$i."</option>";
		}
		$result .= "</select> ";		
		
		// draw hours ddl
		$result .= "<select class='form_select' name='event_".$type."_hour' id='event_".$type."_hour'>";
		for($i=0; $i < 24; $i++){
			$i_converted = $this->ConvertToDecimal($i);
			$i_converted_hour = $this->ConvertToHour($i);
			$i_converted_hour_formated = $this->ConvertToHour($i, true);
			$result .= "<option value='".$i_converted_hour."'".(($hour == $i_converted) ? " selected='selected'" : "").">".(($this->timeFormat == "24") ? $i_converted_hour : $i_converted_hour_formated)."</option>";
		}
		$result .= "</select> ";			

		if($draw){
			echo $result;
		}else{
			return $result;
		}
	}
	
	/**
	 *	Delete all cache files
	*/	
	function DeleteCache(){
		if ($hdl = opendir($this->cacheDir)){
			while (false !== ($obj = @readdir($hdl))){
				if($obj == '.' || $obj == '..'){ 
					continue; 
				}
				@unlink($this->cacheDir.$obj);
			}
		}
	}


	////////////////////////////////////////////////////////////////////////////
	// Auxilary
	////////////////////////////////////////////////////////////////////////////
	/**
	 *	Set language
	*/	
	private function SetLanguage()
	{
        if (file_exists('languages/'.$this->langName.'.php')) {            
            include_once('languages/'.$this->langName.'.php');
            if(function_exists('setLanguage')){
                $this->lang = setLanguage();
            }else{									
				if($this->isDebug) $this->arrErrors[] = "Your language interface option is turned on, but the system was failed to open correctly stream: <b>'languages/".$this->langName.".php'</b>. <br />The structure of the file is corrupted or invalid. Please check it or return the language option to default value: <b>'en'</b>!";					
			}
    	}else{
			if($this->isDebug) $this->arrErrors[] = "Your language interface option is turned on, but the system was failed to open stream: <b>'languages/".$this->langName.".php'</b>. <br />No such file or directory. Please check it or return the language option to default value: <b>'en'</b>!";					
    	}
	}
               

	/**
	 *	Check chache files
	*/	
	private function CheckCacheFiles()
	{		
		$files_count = 0;
		$oldest_file_name = "";
		$oldest_file_time = date("Y-m-d H:i:s");
		if ($hdl = opendir($this->cacheDir)){
			while (false !== ($obj = @readdir($hdl))){
				if($obj == '.' || $obj == '..'){ 
					continue; 
				}
				$file_time = date("Y-m-d H:i:s", filectime($this->cacheDir.$obj));
				if($file_time < $oldest_file_time){
					$oldest_file_time = $file_time;
					$oldest_file_name = $this->cacheDir.$obj;
				}				
				$files_count++;
			}
		}		
		if($files_count > $this->maxCacheFiles){
			@unlink($oldest_file_name);		
		}
	}

	/**
	 *	Start Caching of page
	 *  	@param $cachefile - name of file to be cached
	*/	
	private function StartCaching($cachefile)
	{
        if($cachefile != "" && file_exists($cachefile)) {        
            // minutes - how many time save the cache
            $cachetime = (int)$this->cacheLifetime * 60;     
            // Serve from the cache if it is younger than $cachetime
            if (file_exists($cachefile) && (filesize($cachefile) > 0) && ((time() - $cachetime) < filemtime($cachefile))){
                // the page has been cached from an earlier request
                // output the contents of the cache file
                include_once($cachefile); 
                echo "<!-- Generated from cache at ".date('H:i', filemtime($cachefile))." -->".$this->crLt;
                return true;
            }        
        }
        // start the output buffer
        ob_start();
	}
	
	/**
	 *	Finish Caching of page
	 *  	@param $cachefile - name of file to be cached
	*/	
	private function FinishCaching($cachefile)
	{
		if($cachefile != ""){
			// open the cache file for writing
			$fp = fopen($cachefile, 'w'); 
			// save the contents of output buffer to the file
			fwrite($fp, ob_get_contents());
			// close the file
			fclose($fp); 
			// Send the output to the browser
			ob_end_flush();
			// check if we exeeded max number of cache files
			$this->CheckCacheFiles();
		}
	}

	/**
	 *	Returns list of events for certain hour
	 *  	@param $events - array of events
	*/	
	


	private function GetContentUpdates($ContentID, $ContentType) {
		
		
		if ($ContentType == 'user') {
			
			$sql = "SELECT avatar,username,tags from users where encryptid='".$ContentID."'";
			$UserArray = $this->DB->queryUniqueObject($sql);
			
			$string = '<td><img src="/includes/round_images_inc.php?source='.$UserArray->avatar.'&radius=20&colour=e9eef4" width="50"></td><td>'.$UserArray->username.'<br/>'.$UserArray->Tags.'<br/>';
			
			$sql = "SELECT count(*) from feed_items where CreateDate='".$this->arrParameters['fulldate']."'";
			$NumFeedUpdates = $this->DB->queryUniqueValue($sql);
			
			$UpdateString .= 'W3UPDATES: '.$NumFeedUpdates.'<br/>';
			$sql = "SELECT count(*) from pf_blog_posts where PublishDate='".$this->arrParameters['fulldate']."' and UserID='".$_SESSION['userid']."'";
			$NumBlogPosts = $this->DB->queryUniqueValue($sql);
			//$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);
			$UpdateString .= 'BLOG POSTS: '.$NumBlogPosts.'<br/>';
			$NumberofUpdates = $NumFeedUpdates+$NumBlogPosts;
			
			$string .= 'Number of Updates: '.$NumberofUpdates.'&nbsp;&nbsp;&nbsp;View Hide<div id="update_box_'.$ContentID.'" style="display:none;">'.$UpdateString.'</div></td>';
		
		} else {
		
			$sql = "SELECT * from comics where comiccrypt='".$ContentID."'";
			$ComicArray = $this->DB->queryUniqueObject($sql);
			
			$string = '<td><img src="/includes/round_images_inc.php?source='.$ComicArray->thumb.'&radius=20&colour=e9eef4" width="50"></td><td>'.$ComicArray->title.'<br/>'.$UserArray->tags.'<br/>';
		
			$sql = "SELECT count(*) from pf_blog_posts where PublishDate='".$this->arrParameters['fulldate']."' and ComicID='$ContentID'";
			$NumBlogPosts = $this->DB->queryUniqueValue($sql);
			
			//$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);
			$UpdateString .= 'BLOG POSTS: '.$NumBlogPosts.'<br/>';
			
			$sql = "SELECT count(*) from characters where CreateDate='".$this->arrParameters['fulldate']."' and ComicID='$ContentID'";
			$NumCharacterPosts = $this->DB->queryUniqueValue($sql);
			
			//$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);
			$UpdateString .= 'CHARACTERS: '.$NumCharacterPosts.'<br/>';
			
			$sql = "SELECT count(*) from comic_pages where PublishDate='".$this->arrParameters['fulldate']."' and ComicID='$ContentID'";
			$NumPageUpdates = $this->DB->queryUniqueValue($sql);
			
			//$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);
			$UpdateString .= 'CHARACTERS: '.$NumPageUpdates.'<br/>';
			
			$NumberofUpdates = $NumPageUpdates+$NumBlogPosts+NumCharacterPosts;
			
			$string .= 'Number of Updates: '.$NumberofUpdates.'&nbsp;&nbsp;&nbsp;View Hide<div id="update_box_'.$ContentID.'" style="display:none;">'.$UpdateString.'</div></td>';
		
		}

		return $String;
	
	
	}
/*
	private function GetCalendarItems($CalID)
	{
	
				$sql = "SELECT c.*, e.*, u.avatar, u.username
				from pf_calendar as c
				LEFT JOIN pf_events as e on c.EventID=e.ID
				join users as u on c.UserID=u.encryptid
				where c.UserID='".$_SESSION['userid']."' and ID='$CalID'"; 
			$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);
		$output = '
			
	<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td id="updateBox_TL"></td>

	<td id="updateBox_T" valign="bottom">
	<td id="updateBox_TR"></td>
	<td id="boxcontent" colspan="3">
	<table><tr>';
	
		foreach($result[0] as $key => $cal){
		
			$EntryType =  $cal['EntryType'];
			
			switch($EntryType) {
				case 'notify':
					//$this->GetContentUpdates($cal['ContentID'],$cal['ContentType']);
				break;
				
				case 'reminder':
				break;
				
				case 'event':
				break;
				
				case 'todo':
				break;
			
			
			
			}
		// PUT ALL THE LISTING INFORMATION IN HERE THUMBNAILS, ETC
			//if($output != "") $output .= ", ";
			//$output .= $cal['name'];
			//if($max_length == "") $output .= " <a href='javascript:void(0);' onclick=\"__DeleteEvent('".$cal['id']."');\" title='Click to delete'><img src='style/".$this->cssStyle."/images/delete.gif' title='Click to delete' style='border:0px;vertical-align:middle;' alt='' /></a>";
		//}
		//if($max_length != "" && strlen($output) > $max_length){
			//$output = "<label title='".$output."' style='cursor:help;'>".substr($output, 0, $max_length)."...</label>";
		//}
		
		$output .= '</tr></table></td></tr>
		<tr>
		<td id="updateBox_BL"></td>

	<td id="updateBox_B" valign="bottom">
	<td id="updateBox_BR"></td>
	</tr>
	</table>';
		return $output;
	}	
	
	*/
	private function GetEventsList($events = array(), $max_length = "")
	{
		$output = "";
		foreach($events as $key => $cal){
		
		// PUT ALL THE LISTING INFORMATION IN HERE THUMBNAILS, ETC
			if($output != "") $output .= ", ";
			$output .= $cal['name'];
			if($max_length == "") $output .= " <a href='javascript:void(0);' onclick=\"__DeleteEvent('".$cal['id']."');\" title='Click to delete'><img src='style/".$this->cssStyle."/images/delete.gif' title='Click to delete' style='border:0px;vertical-align:middle;' alt='' /></a>";
		}
		if($max_length != "" && strlen($output) > $max_length){
			$output = "<label title='".$output."' style='cursor:help;'>".substr($output, 0, $max_length)."...</label>";
		}
		return $output;
	}	
				
	/**
	 *	Returns count of events for the certain day
	 *  	@param $event_date - day of events
	*/	
	private function GetEventCountForDay($event_date = "")
	{
		// prepare events for this day of week
		$sql = "SELECT
					"._DB_PREFIX."calendar.EventDate,
					"._DB_PREFIX."calendar.EventTime,
					DATE_FORMAT("._DB_PREFIX."calendar.EventTime, '%H') as event_time_formatted,
					"._DB_PREFIX."events.Name,
					"._DB_PREFIX."events.Description
				FROM "._DB_PREFIX."calendar
					INNER JOIN "._DB_PREFIX."events ON "._DB_PREFIX."calendar.EventID = "._DB_PREFIX."events.ID
				WHERE
					"._DB_PREFIX."calendar.EventDate = ".$event_date." 
				GROUP BY "._DB_PREFIX."events.ID";
		return database_query($sql, _ROWS_ONLY);
	}

	/**
	 *	Returns count of events for the certain month
	 *  	@param $event_year - $year of events
	 *  	@param $event_month - $month of events
	*/	
	private function GetEventCountForMonth($event_year = "", $event_month = "")
	{
		// prepare events for this day of week
		$sql = "SELECT
					GROUP_CONCAT(DISTINCT "._DB_PREFIX."events.ID ORDER BY "._DB_PREFIX."events.ID ASC SEPARATOR '-') as cnt,
					"._DB_PREFIX."calendar.EventDate,
					SUBSTRING("._DB_PREFIX."calendar.EventDate, 9, 2) as day
				FROM "._DB_PREFIX."calendar
					INNER JOIN "._DB_PREFIX."events ON "._DB_PREFIX."calendar.EventID = "._DB_PREFIX."events.ID
				WHERE
					SUBSTRING("._DB_PREFIX."calendar.EventDate, 1, 4) =  '".$event_year."' AND 
					SUBSTRING("._DB_PREFIX."calendar.EventDate, 6, 2) =  '".$event_month."' 
				GROUP BY
					SUBSTRING("._DB_PREFIX."calendar.EventDate, 9, 2)";
		$result = database_query($sql, _DATA_AND_ROWS, _ALL_ROWS, _FETCH_ASSOC);
		$arrEventsCount = array(
			"01"=>0, "02"=>0, "03"=>0, "04"=>0, "05"=>0, "06"=>0, "07"=>0, "08"=>0, "09"=>0, "10"=>0, "11"=>0, "12"=>0, "13"=>0, "14"=>0, "15"=>0,
			"16"=>0, "17"=>0, "18"=>0, "19"=>0, "20"=>0, "21"=>0, "22"=>0, "23"=>0, "24"=>0, "25"=>0, "26"=>0, "27"=>0, "28"=>0, "29"=>0, "30"=>0, "31"=>0);
			 
		foreach($result[0] as $key => $val){
			$cnt_array = explode("-", $val['cnt']);
			$arrEventsCount[$val['day']] = count($cnt_array);
		}		
		return $arrEventsCount;
	}

	/**
	 *	Check if parameters is 4-digit year
	 *  	@param $year - string to be checked if it's 4-digit year
	*/	
	private function IsYear($year = "")
	{
		if(!strlen($year) == 4 || !is_numeric($year)) return false;
		for($i = 0; $i < 4; $i++){
			if(!(isset($year[$i]) && $year[$i] >= 0 && $year[$i] <= 9)){
				return false;	
			}
		}
		return true;
	}

	/**
	 *	Check if parameters is month
	 *  	@param $month - string to be checked if it's 2-digit month
	*/	
	private function IsMonth($month = "")
	{
		if(!strlen($month) == 2 || !is_numeric($month)) return false;
		for($i = 0; $i < 2; $i++){
			if(!(isset($month[$i]) && $month[$i] >= 0 && $month[$i] <= 9)){
				return false;	
			}
		}
		return true;
	}

	/**
	 *	Check if parameters is day
	 *  	@param $day - string to be checked if it's 2-digit day
	*/	
	private function IsDay($day = "")
	{
		if(!strlen($day) == 2 || !is_numeric($day)) return false;
		for($i = 0; $i < 2; $i++){
			if(!(isset($day[$i]) && $day[$i] >= 0 && $day[$i] <= 9)){
				return false;	
			}
		}
		return true;
	}

	/**
	 *	Convert to decimal number with leading zero
	 *  	@param $number
	*/	
	private function ConvertToDecimal($number)
	{
		return (($number < 0) ? "-" : "").((abs($number) < 10) ? "0" : "").abs($number);
	}

	/**
	 *	Convert to hour formar with leading zero
	 *  	@param $number
	*/	
	private function ConvertToHour($number, $use_format = false)
	{
		if($use_format){
			if($this->timeFormat == "24"){
				return (($number < 10) ? "0" : "").$number.":00";	
			}else{
				return (($number <= 12) ? $number : ($number - 12)).":00 ".(($number < 12) ? "AM" : "PM");	
			}
		}else{
			return (($number < 10) ? "0" : "").$number.":00";	
		}		
	}
	
	/**
	 *	Parse hour from hour format string
	 *  	@param $hour
	*/	
	private function ParseHour($hour)
	{
		$hour_array = explode(":", $hour);
		return (isset($hour_array[0]) ? $hour_array[0] : "0");
	}	

	/**
	 *	Get formatted microtime
	*/	
    private function GetFormattedMicrotime(){
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }

}
?>