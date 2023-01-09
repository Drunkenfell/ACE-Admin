<?php

$approvedDataTypes = array(
	"PAYMENT_TYPE"			=>		array("ALPHA","ALPHA_CODE"),
	"LANGUAGE"				=>		array("ALPHA","ALPHA_CODE"),
	"INQ_MODE"				=>		array("ALPHA","ALPHA_CODE","WORD","DICTIONARY_WORD","NAME"),
	"RESTYPE"				=>		array("ALPHA","ALPHA_CODE","WORD","DICTIONARY_WORD","NAME"),
	"DATETIME"				=>		array("NUMERIC"),
	"INQTYPE"				=>		array("ALPHA","ALPHA_CODE","WORD","DICTIONARY_WORD","NAME"),
	"PROCESSOR_ID"			=>		array("ALPHA","ALPHA_CODE","WORD","NAME","COMPANY_NAME"),
	"MERNO"					=>		array("NUMERIC","POSTAL"),
	"USERNAME"				=>		array("NUMERIC","POSTAL","ALPHA","ALPHA_CODE","WORD","DICTIONARY_WORD","NAME","COMPANY_NAME"),
	"PWD"					=>		array("NUMERIC","POSTAL","PASSWORD","ALPHA","ALPHA_CODE","WORD","DICTIONARY_WORD","NAME","COMPANY_NAME"),
	"TEST"					=>		array("WORD","DICTIONARY_WORD","NAME"),
	"BILLNO"				=>		array("NUMERIC","POSTAL","ALPHA","ALPHA_CODE","WORD","NAME"),
	"FIRST_NAME"			=>		array("WORD","WORDS","NAME","FULL_NAME"),
	"LAST_NAME"				=>		array("WORD","WORDS","NAME","FULL_NAME"),
	"NAME"					=>		array("WORD","WORDS","NAME","FULL_NAME"),
	"ADDRESS_1"				=>		array("WORDS","WORD","NAME","PHYSICAL_ADDRESS"),
	"ADDRESS_2"				=>		array("WORDS","WORD","NAME","PHYSICAL_ADDRESS"),
	"CITY"					=>		array("WORDS","WORD","NAME","FULL_NAME","CITY_NAME"),
	"STATE"					=>		array("ALPHA_CODE","WORD","NAME","STATE"),
	"POSTAL_CODE"			=>		array("NUMERIC","POSTAL"),
	"COUNTRY"				=>		array("WORD","ALPHA_CODE","STATE","COUNTRY"),
	"SHIPPING_FIRST_NAME"	=>		array("WORD","WORDS","NAME","FULL_NAME"),
	"SHIPPING_LAST_NAME"	=>		array("WORD","WORDS","NAME","FULL_NAME"),
	"SHIPPING_NAME"			=>		array("WORD","WORDS","NAME","FULL_NAME"),
	"SHIPPING_ADDRESS_1"	=>		array("WORDS","WORD","NAME","PHYSICAL_ADDRESS"),
	"SHIPPING_ADDRESS_2"	=>		array("WORDS","WORD","NAME","PHYSICAL_ADDRESS"),
	"SHIPPING_CITY"			=>		array("WORDS","WORD","NAME","FULL_NAME"),
	"SHIPPING_STATE"		=>		array("ALPHA_CODE","STATE"),
	"SHIPPING_POSTAL_CODE"	=>		array("NUMERIC","POSTAL"),
	"SHIPPING_COUNTRY"		=>		array("WORD","ALPHA_CODE","COUNTRY"),
	"SHIPPING"				=>		array("NUMERIC","CURRENCY"),
	"EMAIL"					=>		array("EMAIL"),
	"PHONE"					=>		array("NUMERIC","POSTAL","PHONE"),
	"DOB"					=>		array("NUMERIC","POSTAL","PHONE"),
	"CC_NUMBER"				=>		array("PAN"),
	"CVV"					=>		array("NUMERIC"),
	"CVV2"					=>		array("NUMERIC"),
	"CC_EXP"				=>		array("NUMERIC","EXP_DATE"),
	"CC_HASH"				=>		array("NUMERIC"),
	"CURRENCY"				=>		array("ALPHA_CODE"),
	"AMOUNT"				=>		array("NUMERIC","CURRENCY"),
	"ACTION_TYPE"			=>		array("ALPHA_CODE","WORD","NAME"),
	"IP_ADDRESS"			=>		array("IP_ADDRESS","IPv4","IPv6"),
	"IPADDRESS"				=>		array("IP_ADDRESS"),
	//"INQUIRYIP"			=>		array("IP_ADDRESS"),
	"INQUIRER"				=>		array("IP_ADDRESS")
	
);

$months=[
	"jan"=>1,
	"feb"=>2,
	"mar"=>3,
	"apr"=>4,
	"may"=>5,
	"jun"=>6,
	"jul"=>7,
	"aug"=>8,
	"sep"=>9,
	"oct"=>10,
	"nov"=>11,
	"dec"=>12
];

$dataTypes = array(
	'Data' => array(
			"NUMERIC"				=> 		"^\d+\.?\d?$",
			"CURRENCY"				=> 		"^[$]?[0-9,]+\.{1}\d{2}$",
			
			"ALPHA"					=> 		"^[a-zA-Z]$",
			'WORDS'					=> 		"(?(?=[\s]{1,})((?=[AEIOUaeiou]{1})))(^[a-zA-Z\s]{5,})$",
			'WORD'					=> 		"(?(?=[AEIOUaeiou]{1}))(^[a-zA-Z]{3,20}$)",
			
			'ALPHA_CODE'			=> 		"^[A-Z]([A-Z1-9]){1,3}$",
			'ALPHANUMERIC_CODE'		=> 		"^(?=.*?[a-zA-Z0-9])(?=.*?[0-9])(?=.*?[a-zA-Z])+$"
	),
	
	
	'Location' => array(
			"PHYSICAL_ADDRESS"		=>		"^[0-9\.\,\#\- \/]{1,8}\s{1}[\w\d\.\,\#\-  ]{3,15}|^[\w\.\,\#\- ]{2,15}\s{1}[0-9\.\,\#\- ]{1,8}",
			
			'US_STATE'				=> "^((AL)|(AK)|(AS)|(AZ)|(AR)|(CA)|(CO)|(CT)|(DE)|(DC)|(FM)|(FL)|(GA)|(GU)|(HI)|(ID)|(IL)|(IN)|(IA)|(KS)|(KY)|(LA)|(ME)|(MH)|(MD)|(MA)|(MI)|(MN)|(MS)|(MO)|(MT)|(NE)|(NV)|(NH)|(NJ)|(NM)|(NY)|(NC)|(ND)|(MP)|(OH)|(OK)|(OR)|(PW)|(PA)|(PR)|(RI)|(SC)|(SD)|(TN)|(TX)|(UT)|(VT)|(VI)|(VA)|(WA)|(WV)|(WI)|(WY))$",
			
			//"POSTAL_CODE(AU)"		=>		"^(0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2})$",
			"POSTAL(BE)"			=>		"^[1-9]{1}[0-9]{3}$",
			"POSTAL(CA)"			=>		"^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ])\ {0,1}(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$",
			"POSTAL(DE)"			=>		"\b((?:0[1-46-9]\d{3})|(?:[1-357-9]\d{4})|(?:[4][0-24-9]\d{3})|(?:[6][013-9]\d{3}))\b",
			"POSTAL(DK)"			=>		"^([D-d][K-k])?( |-)?[1-9]{1}[0-9]{3}$",
			"POSTAL(ES)"			=>		"^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$",
			"POSTAL(FR)"			=>		"^(F-)?((2[A|B])|[0-9]{2})[0-9]{3}$",
			"POSTAL(IN)"			=>		"^\d{6}$",
			"POSTAL(IT)"			=>		"^(V-|I-)?[0-9]{5}$",
			"POSTAL(NL)"			=>		"^[1-9][0-9]{3}\s?([a-zA-Z]{2})?$",
			"POSTAL(SE)"			=>		"^(s-|S-){0,1}[0-9]{3}\s?[0-9]{2}$",
			"POSTAL(US)"			=>		"^\d{5}([\-]?\d{4})+$",
			"POSTAL(UK)"			=>		"^(GIR|[A-Z]\d[A-Z\d]??|[A-Z]{2}\d[A-Z\d]??)[ ]??(\d[A-Z]{2})$"
	),
	
	
	'Identity' => array(
			'NAME'					=> 		"(^[A-Z]{1}[a-z]{1,}$)",
			'COMPANY_NAME'			=> 		"(^[A-Z]{1,2}[a-z']+[A-Z]+[a-z]+)",
			'FULL_NAME'				=> 		"(^[A-Z]{1}[a-z']+\s[a-zA-Z]+((([\s\.'])|([a-z']+))|[a-z']+[a-zA-Z']+))",
			'EMAIL'					=> 		"^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$",
			'IP_ADDRESS' 			=> 		'(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)',
			//'IPv4'		 			=> 		'(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)',
			'IPv6'		 			=> 		'(([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))',
			'US_SSN'				=> 		'^(?!000)([0-6]\d{2}|7([0-6]\d|7[012]))([ -]?)(?!00)\d\d\3(?!0000)\d{4}$',
			'US_PHONE'				=> 		"^(?:1(?:[. -])?)?(?:\((?=\d{3}\)))?([2-9]\d{2})(?:(?<=\(\d{3})\))? ?(?:(?<=\d{3})[.-])?([2-9]\d{2})[. -]?(\d{4})(?: (?i:ext)\.? ?(\d{1,5}))?$"
	),
	
	
	'Accounts' => array(
			'PAN(PLAIN_TEXT)' 		=>		'^((4\d{3})|(5[1-5]\d{2})|(6011))-?\d{4}-?\d{4}-?\d{4}|3[4,7]\d{13}$',
			'PASSWORD'				=>		"^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$",
			'PAN(256B)'				=>		"^[a-zA-Z0-9+=\/]{44}$",
			'EXP_DATE'				=> 		"^((0[1-9])|(1[0-2]))[\/\.\-]*((0[8-9])|(1[1-9]))$"
	),
	
	
	'Security' => array(
			'VARIABLES(STRING)'		=>		'^[&]?([\w\d]+[=]{1}[\w\d]+[&]{1})+',
			'MALICIOUS_SCRIPT' 		=> 		'(script)|(&lt;)|(&gt;)|(%3c)|(%3e)|(SELECT) |(UPDATE) |(INSERT) |(DELETE)|(GRANT) |(REVOKE)|(UNION)|(&amp;lt;)|(&amp;gt;)'
	)
	
);

$countryCodes = array(
	"2-Digit"				=>		array(
										"AD"	=>		"Andorra",
										"AE"	=>		"United Arab Emirates",
										"AF"	=>		"Afghanistan",
										"AG"	=>		"Antigua and Barbuda",
										"AI"	=>		"Anguilla",
										"AL"	=>		"Albania",
										"AM"	=>		"Armenia",
										"AO"	=>		"Angola",
										"AQ"	=>		"Antarctica",
										"AR"	=>		"Argentina",
										"AS"	=>		"American Samoa",
										"AT"	=>		"Austria",
										"AU"	=>		"Australia",
										"AW"	=>		"Aruba",
										"AX"	=>		"Aland Islands",
										"AZ"	=>		"Azerbaijan",
										
										"BA"	=>		"Bosnia and Herzegovina",
										"BB"	=>		"Barbados",
										"BD"	=>		"Bangladesh",
										"BE"	=>		"Belgium",
										"BF"	=>		"Berkina Faso",
										"BG"	=>		"Bulgaria",
										"BH"	=>		"Bahrain",
										"BI"	=>		"Berundi",
										"BJ"	=>		"Benin",
										"BL"	=>		"Saint Barthelemy",
										"BM"	=>		"Bermuda",
										"BN"	=>		"Brunei Darussalam",
										"BO"	=>		"Plurinational State of Bolivia",
										"BQ"	=>		"Sint Eustatius and Saba Bonaire",
										"BR"	=>		"Brazil",
										"BS"	=>		"Bahamas",
										"BT"	=>		"Bhutan",
										"BV"	=>		"Bouvet Island",
										"BW"	=>		"Botswana",
										"BY"	=>		"Belarus",
										"BZ"	=>		"Belize",
										
										"CA"	=>		"Canada",
										"CC"	=>		"Cocos (Keeling) Islands",
										"CD"	=>		"Democratic Republic of the Congo",
										"CF"	=>		"Central African Republic",
										"CG"	=>		"Congo",
										"CH"	=>		"Switzerland",
										"CI"	=>		"Cote D'lvoire",
										"CK"	=>		"Cook Islands",
										"CL"	=>		"Chile",
										"CM"	=>		"Cameroon",
										"CN"	=>		"China",
										"CO"	=>		"Columbia",
										"CR"	=>		"Costa Rica",
										"CU"	=>		"Cuba",
										"CV"	=>		"Cabo Verde",
										"CW"	=>		"Curacao",
										"CX"	=>		"Christmas Island",
										"CY"	=>		"Cyprus",
										"CZ"	=>		"Czech Republic",
										
										"DE"	=>		"Germany",
										"DJ"	=>		"Djibouti",
										"DK"	=>		"Denmark",
										"DM"	=>		"Dominica",
										"DO"	=>		"Dominican Republic",
										"DZ"	=>		"Algeria",
										
										"EC"	=>		"Ecuador",
										"EE"	=>		"Estonia",
										"EG"	=>		"Egypt",
										"EH"	=>		"Western Sahara",
										"ER"	=>		"Eritrea",
										"ES"	=>		"Spain",
										"ET"	=>		"Ethiopia",
										
										"FI"	=>		"Finland",
										"FJ"	=>		"Fiji",
										"FK"	=>		"Falkland Islands (Malvinas)",
										"FM"	=>		"Federated States of Micronesia",
										"FO"	=>		"Faroe Islands",
										"FR"	=>		"France",
										
										"GA"	=>		"Gabon",
										"GB"	=>		"United Kingdom",
										"GD"	=>		"Grenada",
										"GE"	=>		"Georgia",
										"GF"	=>		"French Guiana",
										"GG"	=>		"Guernsey",
										"GH"	=>		"Ghana",
										"GI"	=>		"Gibraltar",
										"GL"	=>		"Greenland",
										"GM"	=>		"Gambia",
										"GN"	=>		"Guinea",
										"GP"	=>		"Guadeloupe",
										"GQ"	=>		"Equatorial Guinee",
										"GR"	=>		"Greece",
										"GS"	=>		"Southe Georgia and the South Sandwich Islands",
										"GT"	=>		"Guatemala",
										"GU"	=>		"Guam",
										"GW"	=>		"Guinea-Bissau",
										"GY"	=>		"Guyana",
										
										"HK"	=>		"Hong Kong",
										"HM"	=>		"Heard Island and McDonald Island",
										"HN"	=>		"Honduras",
										"HR"	=>		"croatia",
										"HT"	=>		"Haiti",
										"HU"	=>		"Hungary",
										
										"ID"	=>		"Indonesia",
										"IE"	=>		"Ireland",
										"IL"	=>		"Israel",
										"IM"	=>		"Isle of Man",
										"IN"	=>		"India",
										"IO"	=>		"British Indian Ocean Territory",
										"IQ"	=>		"Iraq",
										"IR"	=>		"Iran, Islamic Republic of",
										"IS"	=>		"Iceland",
										"IT"	=>		"Italy",
										
										"JE"	=>		"Jersey",
										"JM"	=>		"Jamaica",
										"JO"	=>		"Jordan",
										"JP"	=>		"Japan",
										
										"KE"	=>		"Kenya",
										"KG"	=>		"Ktrgyzstan",
										"KH"	=>		"Cambodia",
										"KI"	=>		"Kirbati",
										"KM"	=>		"Comoros",
										"KN"	=>		"Saint Kitts and Nevis",
										"KP"	=>		"Korea, Democratic People's Republic of",
										"KR"	=>		"Republic of Korea",
										"KW"	=>		"Kuwait",
										"KY"	=>		"Cayman Islands",
										"KZ"	=>		"Kazakhstan",
										
										"LA"	=>		"Lao People's Democratic republic",
										"LB"	=>		"Lebanon",
										"LC"	=>		"Saint Lucia",
										"LI"	=>		"Liechtenstein",
										"LK"	=>		"Sri Lanka",
										"LR"	=>		"Liberia",
										"LS"	=>		"Lesotho",
										"LT"	=>		"Lithuania",
										"LU"	=>		"Luxembourg",
										"LV"	=>		"Latvia",
										"LY"	=>		"Libya",
										
										"MA"	=>		"Morocco",
										"MC"	=>		"Monaco",
										"MD"	=>		"Moldova",
										"ME"	=>		"Montenegro",
										"MF"	=>		"Saint Martin (French part)",
										"MG"	=>		"Madagascar",
										"MH"	=>		"Marshall Islands",
										"MK"	=>		"Macedonia, the former Yugoslav Republic of",
										"ML"	=>		"Mali",
										"MM"	=>		"Myanmar",
										"MN"	=>		"Mongolia",
										"MO"	=>		"Macao",
										"MP"	=>		"Northern Mariana Islands",
										"MQ"	=>		"Martinique",
										"MR"	=>		"Mauritania",
										"MS"	=>		"Montserrat",
										"MT"	=>		"Malta",
										"MU"	=>		"Mauritius",
										"MV"	=>		"Maldives",
										"MW"	=>		"Malawi",
										"MX"	=>		"Mexico",
										"MY"	=>		"Malaysia",
										"MZ"	=>		"Mozambique",
										
										"NA"	=>		"Namibia",
										"NC"	=>		"New Caledonia",
										"NE"	=>		"Niger",
										"NF"	=>		"Norfolk Island",
										"NG"	=>		"Nigeria",
										"NI"	=>		"Nicaragua",
										"NL"	=>		"Netherlands",
										"NO"	=>		"Norway",
										"NP"	=>		"Nepal",
										"NR"	=>		"Nauru",
										"NU"	=>		"Niue",
										"NZ"	=>		"New Zealand",
										
										"OM"	=>		"Oman",
										
										"PA"	=>		"Panama",
										"PE"	=>		"Peru",
										"PF"	=>		"French Polynesia",
										"PG"	=>		"Papua New Guinea",
										"PH"	=>		"Philippines",
										"PK"	=>		"Pakistan",
										"PL"	=>		"Poland",
										"PM"	=>		"Saint Pierre and Miquelon",
										"PN"	=>		"Pitcairn",
										"PR"	=>		"Puerto Rico",
										"PS"	=>		"Palestine, State of",
										"PT"	=>		"Portugal",
										"PW"	=>		"Palau",
										"PY"	=>		"Paraguay",
										
										"QA"	=>		"Qatar",
										
										"RE"	=>		"Reunion",
										"RO"	=>		"Romania",
										"RS"	=>		"Serbia",
										"RU"	=>		"Russian Federation",
										"RW"	=>		"Rwanda",
										
										"SA"	=>		"Saudi Arabia",
										"SB"	=>		"Solomon Islands",
										"SC"	=>		"Seychelles",
										"SD"	=>		"Sudan",
										"SE"	=>		"Sweden",
										"SG"	=>		"Singapore",
										"SH"	=>		"Saint Helena, Ascension and Tristan da Cunha",
										"SI"	=>		"Slovenia",
										"SJ"	=>		"Svalbard and Jan Mayen",
										"SK"	=>		"Slovakia",
										"SL"	=>		"Slovakia",
										"SM"	=>		"San Marino",
										"SN"	=>		"Senegal",
										"SO"	=>		"Somalia",
										"SR"	=>		"Suriname",
										"SS"	=>		"South Sudan",
										"ST"	=>		"Sao Tome and Principe",
										"SV"	=>		"El Salvador",
										"SX"	=>		"Sint Maarten (Dutch part)",
										"SY"	=>		"Syrian Arab Republic",
										"SZ"	=>		"Swaziland",
										
										"TC"	=>		"Turks and Caicos Islands",
										"TD"	=>		"Chad",
										"TF"	=>		"French Southern Territories",
										"TG"	=>		"Togo",
										"TH"	=>		"Thailand",
										"TJ"	=>		"Tajikistan",
										"TK"	=>		"Tokelau",
										"TL"	=>		"Timor-Leste",
										"TM"	=>		"Turkmenistan",
										"TN"	=>		"Tunisia",
										"TO"	=>		"Tonga",
										"TR"	=>		"Turkey",
										"TT"	=>		"Trinidad and Tobago",
										"TV"	=>		"Tuvalu",
										"TW"	=>		"Taiwan",
										"TZ"	=>		"Tanzania, United Republic of",
										
										"UA"	=>		"Ukraine",
										"UG"	=>		"Uganda",
										"UM"	=>		"United States Minor Outlying Islands",
										"US"	=>		"United States of America",
										"UY"	=>		"Uruguay",
										"UZ"	=>		"Uzbekistan",
										
										"VA"	=>		"Holy See (Vatican City State)",
										"VC"	=>		"Saint Vincent and the Grenadines",
										"VE"	=>		"Venezuela",
										"VG"	=>		"Virgin Islands, British",
										"VI"	=>		"Virgin Islands, U.S.",
										"VN"	=>		"Viet Nam",
										"VU"	=>		"Vanuatu",
										
										"WF"	=>		"Wallis and Futuna",
										"WS"	=>		"Samoa",
										
										"YE"	=>		"Yemen",
										"YT"	=>		"Mayotte",
										
										"ZA"	=>		"South Africa",
										"ZM"	=>		"Zambia",
										"ZW"	=>		"Zimbabwe"
										
									),
	"3-Digit"				=>		array(
										"AND"	=>		"Andorra",
										"ARE"	=>		"United Arab Emirates",
										"AFG"	=>		"Afghanistan",
										"ATG"	=>		"Antigua and Barbuda",
										"AIA"	=>		"Anguilla",
										"ALB"	=>		"Albania",
										"ARM"	=>		"Armenia",
										"AGO"	=>		"Angola",
										"ATA"	=>		"Antarctica",
										"ATF"	=>		"French Southern Territories",
										"ARG"	=>		"Argentina",
										"ASM"	=>		"American Samoa",
										"AUT"	=>		"Austria",
										"AUS"	=>		"Australia",
										"ABW"	=>		"Aruba",
										"ALA"	=>		"Aland Islands",
										"AZE"	=>		"Azerbaijan",
										
										"BIH"	=>		"Bosnia and Herzegovina",
										"BRB"	=>		"Barbados",
										"BGD"	=>		"Bangladesh",
										"BEL"	=>		"Belgium",
										"BFA"	=>		"Berkina Faso",
										"BGR"	=>		"Bulgaria",
										"BHR"	=>		"Bahrain",
										"BDI"	=>		"Berundi",
										"BEN"	=>		"Benin",
										"BLM"	=>		"Saint Barthelemy",
										"BMU"	=>		"Bermuda",
										"BRN"	=>		"Brunei Darussalam",
										"BOL"	=>		"Plurinational State of Bolivia",
										"BES"	=>		"Sint Eustatius and Saba Bonaire",
										"BRA"	=>		"Brazil",
										"BHS"	=>		"Bahamas",
										"BTN"	=>		"Bhutan",
										"BVT"	=>		"Bouvet Island",
										"BWA"	=>		"Botswana",
										"BLR"	=>		"Belarus",
										"BLZ"	=>		"Belize",
										
										"CAN"	=>		"Canada",
										"CCK"	=>		"Cocos (Keeling) Islands",
										"COD"	=>		"Democratic Republic of the Congo",
										"CAF"	=>		"Central African Republic",
										"COG"	=>		"Congo",
										"CHE"	=>		"Switzerland",
										"CIV"	=>		"Cote D'lvoire",
										"COK"	=>		"Cook Islands",
										"CHL"	=>		"Chile",
										"CMR"	=>		"Cameroon",
										"CHN"	=>		"China",
										"COL"	=>		"Columbia",
										"COM"	=>		"Comoros",
										"CRI"	=>		"Costa Rica",
										"CUB"	=>		"Cuba",
										"CPV"	=>		"Cabo Verde",
										"CUW"	=>		"Curacao",
										"CXR"	=>		"Christmas Island",
										"CYM"	=>		"Cayman Islands",
										"CYP"	=>		"Cyprus",
										"CZE"	=>		"Czech Republic",
										
										"DEU"	=>		"Germany",
										"DJI"	=>		"Djibouti",
										"DNK"	=>		"Denmark",
										"DMA"	=>		"Dominica",
										"DOM"	=>		"Dominican Republic",
										"DZA"	=>		"Algeria",
										
										"ECU"	=>		"Ecuador",
										"EST"	=>		"Estonia",
										"EGY"	=>		"Egypt",
										"ESH"	=>		"Western Sahara",
										"ERI"	=>		"Eritrea",
										"ESP"	=>		"Spain",
										"ETH"	=>		"Ethiopia",
										
										"FIN"	=>		"Finland",
										"FJI"	=>		"Fiji",
										"FLK"	=>		"Falkland Islands (Malvinas)",
										"FSM"	=>		"Federated States of Micronesia",
										"FRO"	=>		"Faroe Islands",
										"FRA"	=>		"France",
										
										"GAB"	=>		"Gabon",
										"GBR"	=>		"United Kingdom",
										"GRD"	=>		"Grenada",
										"GEO"	=>		"Georgia",
										"GUF"	=>		"French Guiana",
										"GGY"	=>		"Guernsey",
										"GHA"	=>		"Ghana",
										"GIB"	=>		"Gibralter",
										"GRL"	=>		"Greenland",
										"GMB"	=>		"Gambia",
										"GIN"	=>		"Guinea",
										"GLP"	=>		"Guadeloupe",
										"GNQ"	=>		"Equatorial Guinee",
										"GRC"	=>		"Greece",
										"GTM"	=>		"Guatemala",
										"GUM"	=>		"Guam",
										"GNB"	=>		"Guinea-Bissau",
										"GUY"	=>		"Guyana",
										
										"HKG"	=>		"Hong Kong",
										"HMD"	=>		"Heard Island and McDonald Island",
										"HND"	=>		"Honduras",
										"HRV"	=>		"Croatia",
										"HTI"	=>		"Haiti",
										"HUN"	=>		"Hungary",
										
										"IDN"	=>		"Indonesia",
										"IRL"	=>		"Ireland",
										"ISR"	=>		"Israel",
										"IMN"	=>		"Isle of Man",
										"IND"	=>		"India",
										"IOT"	=>		"British Indian Ocean Territory",
										"IRQ"	=>		"Iraq",
										"IRN"	=>		"Iran, Islamic Republic of",
										"ISL"	=>		"Iceland",
										"ITA"	=>		"Italy",
										
										"JEY"	=>		"Jersey",
										"JAM"	=>		"Jamaica",
										"JOR"	=>		"Jordan",
										"JPN"	=>		"Japan",
										
										"KEN"	=>		"Kenya",
										"KGZ"	=>		"Ktrgyzstan",
										"KHM"	=>		"Cambodia",
										"KIR"	=>		"Kirbati",
										"KNA"	=>		"Saint Kitts and Nevis",
										"KOR"	=>		"Korea, Republic of",
										"KWT"	=>		"Kuwait",
										"KAZ"	=>		"Kazakhstan",
										
										"LAO"	=>		"Lao People's Democratic republic",
										"LBN"	=>		"Lebanon",
										"LCA"	=>		"Saint Lucia",
										"LIE"	=>		"Liechtenstein",
										"LKA"	=>		"Sri Lanka",
										"LBR"	=>		"Liberia",
										"LSO"	=>		"Lesotho",
										"LTU"	=>		"Lithuania",
										"LUX"	=>		"Luxembourg",
										"LVA"	=>		"Latvia",
										"LBY"	=>		"Libya",
										
										"MAR"	=>		"Morocco",
										"MCO"	=>		"Monaco",
										"MDA"	=>		"Moldova, Republic of",
										"MNE"	=>		"Montenegro",
										"MAF"	=>		"Saint Martin (French part)",
										"MDG"	=>		"Madagascar",
										"MHL"	=>		"Marshall Islands",
										"MKD"	=>		"Macedonia, the former Yugoslav Republic of",
										"MLI"	=>		"Mali",
										"MMR"	=>		"Myanmar",
										"MNG"	=>		"Mongolia",
										"MAC"	=>		"Macao",
										"MNP"	=>		"Northern Mariana Islands",
										"MTQ"	=>		"Martinique",
										"MRT"	=>		"Mauritania",
										"MSR"	=>		"Montserrat",
										"MLT"	=>		"Malta",
										"MUS"	=>		"Mauritius",
										"MDV"	=>		"Maldives",
										"MWI"	=>		"Malawi",
										"MEX"	=>		"Mexico",
										"MYS"	=>		"Malaysia",
										"MOZ"	=>		"Mozambique",
										"MYT"	=>		"Mayotte",
										
										"NAM"	=>		"Namibia",
										"NCL"	=>		"New Caledonia",
										"NER"	=>		"Niger",
										"NFK"	=>		"Norfolk Island",
										"NGA"	=>		"Nigeria",
										"NIC"	=>		"Nicaragua",
										"NLD"	=>		"Netherlands",
										"NOR"	=>		"Norway",
										"NPL"	=>		"Nepal",
										"NRU"	=>		"Nauru",
										"NIU"	=>		"Niue",
										"NZL"	=>		"New Zealand",
										
										"OMN"	=>		"Oman",
										
										"PAN"	=>		"Panama",
										"PER"	=>		"Peru",
										"PYF"	=>		"French Polynesia",
										"PNG"	=>		"Papua New Guinea",
										"PHL"	=>		"Philippines",
										"PAK"	=>		"Pakistan",
										"POL"	=>		"Poland",
										"PCN"	=>		"Pitcairn",
										"PRI"	=>		"Puerto Rico",
										"PRK"	=>		"Korea, Democratic People's Republic of",
										"PSE"	=>		"Palestine, State of",
										"PRT"	=>		"Portugal",
										"PLW"	=>		"Palau",
										"PRY"	=>		"Paraguay",
										
										"QAT"	=>		"Qatar",
										
										"REU"	=>		"Reunion",
										"ROU"	=>		"Romania",
										"RUS"	=>		"Russian Federation",
										"RWA"	=>		"Rwanda",
										
										"SAU"	=>		"Saudi Arabia",
										"SLB"	=>		"Solomon Islands",
										"SLE"	=>		"Sierra Leone",
										"SYC"	=>		"Seychelles",
										"SDN"	=>		"Sudan",
										"SWE"	=>		"Sweden",
										"SGP"	=>		"Singapore",
										"SGS"	=>		"Southe Georgia and the South Sandwich Islands",
										"SHN"	=>		"Saint Helena, Ascension and Tristan da Cunha",
										"SVN"	=>		"Slovenia",
										"SJM"	=>		"Svalbard and Jan Mayen",
										"SVK"	=>		"Slovakia",
										"SMR"	=>		"San Marino",
										"SEN"	=>		"Senegal",
										"SOM"	=>		"Somalia",
										"SPM"	=>		"Saint Pierre and Miquelon",
										"SUR"	=>		"Suriname",
										"SRB"	=>		"Serbia",
										"SSD"	=>		"South Sudan",
										"STP"	=>		"Sao Tome and Principe",
										"SLV"	=>		"El Salvador",
										"SXM"	=>		"Sint Maarten (Dutch part)",
										"SYR"	=>		"Syrian Arab Republic",
										"SWZ"	=>		"Swaziland",
										
										"TCA"	=>		"Turks and Caicos Islands",
										"TCD"	=>		"Chad",
										"TGO"	=>		"Togo",
										"THA"	=>		"Thailand",
										"TJK"	=>		"Tajikistan",
										"TKL"	=>		"Tokelau",
										"TLS"	=>		"Timor-Leste",
										"TKM"	=>		"Turkmenistan",
										"TUN"	=>		"Tunisia",
										"TON"	=>		"Tonga",
										"TUR"	=>		"Turkey",
										"TTO"	=>		"Trinidad and Tobago",
										"TUV"	=>		"Tuvalu",
										"TWN"	=>		"Taiwan, Province of China",
										"TZA"	=>		"Tanzania, United Republic of",
										
										"UKR"	=>		"Ukraine",
										"UGA"	=>		"Uganda",
										"UMI"	=>		"United States Minor Outlying Islands",
										"USA"	=>		"United States",
										"URY"	=>		"Uruguay",
										"UZB"	=>		"Uzbekistan",
										
										"VAT"	=>		"Holy See (Vatican City State)",
										"VCT"	=>		"Saint Vincent and the Grenadines",
										"VEN"	=>		"Venezuela, Bolivarian Republic of",
										"VGB"	=>		"Virgin Islands, British",
										"VIR"	=>		"Virgin Islands, U.S.",
										"VNM"	=>		"Viet Nam",
										"VUT"	=>		"Vanuatu",
										
										"WLF"	=>		"Wallis and Futuna",
										"WSM"	=>		"Samoa",
										
										"YEM"	=>		"Yemen",
										
										"ZAF"	=>		"South Africa",
										"ZMB"	=>		"Zambia",
										"ZWE"	=>		"Zimbabwe"
										
									)
);
function validateArray($transaction){
	global $dataTypes,$approvedDataTypes,$countryCodes,$debug;
	
	$approvedDataTypes["COUNTRY"] = array_merge($approvedDataTypes["COUNTRY"],array_values($countryCodes['3-Digit']));
	
	$dataAnalysis = array();
	
	foreach($transaction as $key => $value){
		if(strlen($value)>0){
			$dataType = getDataType($value);
			if($dataType){
				$dataAnalysis[$key]=$dataType;
			}else{
				//$dataAnalysis[$key]='FAILED';
			}
		}
		
		switch(strtoupper($dataType)){
			case 'FAILED':
				if($debug){
					//echo $key.": ".$value." &#60".$dataType."&#62<BR />";
				}
				break;
			default:
				if($debug){
					//echo $key.": ".$value." &#60".$dataType."&#62<BR />";
				}
				switch($key){
					case 'FIRST_NAME':
						break;
					case 'LAST_NAME':
						break;
					case 'CITY':
						break;
					case 'STATE':
						break;
					case 'COUNTRY':
						if(strlen($transaction['COUNTRY'])==2 || strlen($transaction['COUNTRY'])==3){
							foreach($countryCodes[strlen($transaction['COUNTRY'])."-Digit"] as $countryCode => $countryName){
								if(strtoupper($value)==$countryCode){
									$dataAnalysis[$key]=$countryName;
								}
							}
						}
						switch(strlen($value)){
							case 0:
								break;
							case 1:
								break;
							default:
								$cities = getRows(
									"locations",
									"cities",
									"ID,NAME,ADMIN1,COUNTRYCODE",
									"NAME like '".$transaction['CITY']."' AND ADMIN1 like '".$transaction['STATE']."' ORDER BY POPULATION DESC"
								);
								if($cities){
									$dataAnalysis["CITY"]="CITY_NAME(".strtoupper($cities[0]['ADMIN1'])."-".strtoupper($cities[0]['COUNTRYCODE']).")";
								}else{
									//$dataAnalysis["CITY"]="GEOCHECK-FAILED";
								}
								
								//$debug = true;
								if($debug){
									//var_dump($cities);
								}
								break;
						}
						break;
					default:
						switch(strtoupper($dataType)){
							case 'WORD':
								if(strlen($value)>0){
									//$dictionary =  explode(chr(10),file_get_contents('/var/www/html/FraudLogic/Central/words.txt'));
									$dictionary =  explode(chr(10),file_get_contents('./FraudLogic/Central/words.txt'));
									if(in_array(strtolower($value),$dictionary)){
										$dataAnalysis[$key]="DICTIONARY_WORD";
									}
									$dictionary=NULL;
								}
								break;
							default:
								
								break;
						}
						break;
				}
				break;
		}
	}
	if($debug){
		//var_dump($dataAnalysis);
	}
	return $dataAnalysis;
}

function getDataType($string){
	$output=false;
	
	$analysis = analyzeString($string);
	
	if(is_array($analysis)){
		$analysis=$analysis[count($analysis)-1];
		return $analysis;
	}else{
		return false;
	}
	
}

function analyzeString($string){
	$output = false;
	global $dataTypes,$debug;
	//global $filters;
	
	foreach($dataTypes as $dataClass => $filters){
		foreach($filters as $filterName => $filter){
			//echo $string.": ".$filterName."<BR />";
			$runTest = validateString($string,$filter);
			//var_dump($runTest);
			if($runTest){
				if(is_array($output)){
					array_push($output,$filterName);
				}else{
					$output = array();
					array_push($output,$filterName);
				}
			}
		}
	}
	if($debug){
		//var_dump($output);
	}
	//die();
	
	return $output;
}

function validateString($string,$filter){
	$runTest = preg_match('~'.$filter.'~',$string);
	if($runTest){
		return true;
	}else{
		return false;
	}
}

?>