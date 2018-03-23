<?
# File: my_translation.class.php
# BEWARE: This is a UTF-8 file.
error_reporting(E_NOTICE);

class My_Translation{
	# SQL Resultset variables:
	private $Connect;		// DB resource.
	private $Query;			// SQL Query.
	private $Result;			// SQL Resultset.

	# Debug variables:
	private $Error;			// Last MySQL error.

	# Translation variable and array:
	public $TranslationsArray = array();	// All translations of a page..
	public $LanguageID;							// Language code to use.


	# Initial constructor.
	function __construct($DB_Connection){
		$this -> Connect = $DB_Connection;
	}
 
	# Return last MySQL DB server error.
	function ErrorSee(){
	 	if ($this -> Error != null)
	 		return $this-> Error;
 		else
 			return false;
	}

	# Send a SQL statement to DB server and checks if runs well.
	function ExecuteQuery($Exec_Query, $con = null){
		if (empty($Exec_Query)){
			$this -> Error = "ERROR My_Translation class[ExecuteQuery()]: SQL Query is empty.";
			return false;  		
		}
 
    	// Comprueba que la sentencia se ha hecho.
        $this -> Query = mysql_query($Exec_Query, $this -> Connect);
        if(!$this -> Query){
        	$this -> Error = mysql_error();
    		return  false;
        } else {
        	return $this -> Query;
	   	}
    }

	# To get all queried data.
    function GetData($Get_Query){
    	if (empty($Get_Query)){
			$this -> Error = "ERROR My_Translation class[GetData()]: SQL Resultset name is empty.";
   			return false;
    	}
 
		$this -> Result = mysql_fetch_array($Get_Query, MYSQL_NUM);
		# print_r($this -> Result); # DEBUG

    	if($this -> Result){ // Comprueba si la consulta ha tenido éxito.
   			return $this -> Result;
   		} else {
 			$this -> Error = mysql_error();
  			return false;
   		}
    }

	# To detect and set an application language.
	function SetLanguage(){
		if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])){
			# echo 'DEBUG My_Translation class[SetLanguage()]: $HTTP_ACCEPT_LANGUAGE='.$_SERVER["HTTP_ACCEPT_LANGUAGE"].'<BR>'; # DEBUG
			$language = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
			$langPieces = explode("-", $language[0]);

			# Extract code language like "xx":
			if (strlen($language[0]) == 2){
				$BrowserLanguage = $language[0];
			} else {
				$BrowserLanguage = strtolower($langPieces[0]);
			}

			echo "DEBUG My_Translation class: SetLanguage() - Client language detected is: $BrowserLanguage <BR>"; # DEBUG

			# Set language environment:
			if ($this -> LanguageExists($BrowserLanguage)){
				setlocale(LC_ALL, $BrowserLanguage);
				# echo "DEBUG My_Translation class[SetLanguage()]: Client language detected is: $BrowserLanguage<BR>"; # DEBUG
			} else {
				setlocale(LC_ALL, "en");
				# echo "DEBUG My_Translation class[SetLanguage()]: Client language composed is: en<BR>"; # DEBUG
			}
		}
	}

	# To check if an language exists.
	function LanguageExists($lang){
		# Check if actual language exists:
		$sql = "SELECT id FROM translation_languages WHERE code='$lang'";
		if (!($query = $this ->ExecuteQuery($sql))){
			# echo "DEBUG My_Translation class[LanguageExists()]: Language code $lang does not exists.<BR>"; # DEBUG
			return false; # Language not found.
		}

		$valor = $this -> GetData($query);
		if (is_array($valor)){ # If some data arrived ...
			$this -> LanguageID = $valor[0];
			# echo "DEBUG My_Translation class[LanguageExists()]: Language ID: ".$this -> LanguageID."<BR>"; # DEBUG
			return true;
		} else {
			return false;
		}
	}

	# To get all translations (or originals contents) belonging to a page.
	function GetTranslations($PageID){
		unset($TranslationsArray); # Empty translations array first.

		$sql = "SELECT id, tag FROM translations WHERE language_id=".$this -> LanguageID." AND page_id=".$PageID;
		if(!($query = $this ->ExecuteQuery($sql))){
			exit ("ERROR My_Translation class[GetTranslations()]: ".$this -> ErrorSee().". language_id=".$this -> LanguageID.", page_id=".$PageID);
		} else {
			while ($valor = $this -> GetData($query)){
				# echo "DEBUG My_Translation class[GetTranslations()]: Got translation ID: ".$valor[0]."=".$valor[1]."<BR>"; # DEBUG
				$this -> TranslationsArray[$valor[0]] = $valor[1];
			}
		}
	}

	# To get an specific tag translated.
	function Tag($id){
		if (!isset($this -> TranslationsArray[$id])){ # If this array position it's undefined ...
			return "[Missing tag: $id]";
		} else { # This array position has data ...
			return $this -> TranslationsArray[$id];
		}
	}
}
?>
