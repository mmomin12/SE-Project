<!doctype html>

<html>


<head>
<title>Study Match</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="style.css">
<script src="./js/jquery.min.js"></script>
<script src="./js/popper.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</head>


<body>


	<?php
	
	include 'config.php';
	session_start();
	if (isset($_SESSION['userid'])){
		
	$sql = "select * from users where userid='".$_SESSION['userid']."'";
	
	$res=$conn->query($sql);
		while($row = $res->fetch_assoc()) {
			if($row["profile"]==1){
			
				$_SESSION['profile'] = 1;
				
				header("Location: http://www.gsustudymatch.com/discussion.php");
				exit();
			}
		}
	}
	else{
		header("Location: http://www.gsustudymatch.com/login.php");
		exit();
	}
	
	?>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="index.html">STUDY MATCH</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div id="navbar" class="collapse navbar-collapse">
      <div class="topnav-right">
			  <ul class="navbar-nav mr-auto">
				  <li class="nav-item active">
					  <a class="nav-link" href="logout.php">Logout</a>
				  </li >
			</ul>

		</div>
	</nav>

    <div class="container">
    <h2>CREATE PROFILE</h2>
    <form action="profilesave.php" method="post">

    <div class="form-row">
      <div class="form-group col-sm-6">
        <label>First Name</label>
          <input type="text" name="Fname" class="form-control" maxlength="20">
      </div>

      <div class="form-group col-sm-6">
        <label>Last Name</label>
          <input type="text" name="Lname" class="form-control" maxlength="20">
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-sm-4">
        <label>Sex</label>
        <select name="sex" class="form-control" style="height:35px">
          <option value="Female" selected>Female</option>
          <option value="Male">Male</option>
        </select>
      </div>

      <div class="form-group col-sm-4">
        <label>Type</label>
        <select name="type" class="form-control" style="height:35px">
          <option value="Associate">Associate</option>
          <option value="Bachelor">Bachelor</option>
          <option value="Master">Master</option>
        </select>
      </div>

      <div class="form-group col-sm-4">
        <label>College</label>
        <select name="College"class="form-control" style="height:35px">
          <option value="Andrew">Andrew Young School of Policy Studies</option>
          <option value="Nursing">Byrdine F. Lewis College of Nursing and Health Professions</option>
          <option value="Health">Health Professions</option>
          <option value="ArtScience">College of Arts and Science</option>
          <option value="Arts">College of the Arts</option>
          <option value="Education">College of Education & Human</option>
          <option value="Development">Development</option>
          <option value="Law">College of Law</option>
          <option value="Honors">Honors College</option>
          <option value="Biomedical">Institute for Biomedical Science</option>
          <option value="Robinson">J. Mack Robinson College of Business</option>
          <option value="PC">Perimeter College</option>
          <option value="Public">School of Public Health</option>
        </select>
      </div>
    </div>
      <br>
      <br>
      <div class="form-row">

      <label>Subject :</label>
      <table>
      <tbody>
      <tr>
      <td>

      </td>
      <td colspan="7" >
      <label><select name="sel_subj" size="7" multiple="" id="subj_id" ></label>
      <option value="ACCT">ACCOUNTING</option>
      <option value="AS">ACTUARIAL SCIENCE</option>
      <option value="AAS">AFRICAN-AMERICAN STUDIES</option>
      <option value="ASL">AMERICAN SIGN LANGUAGE</option>
      <option value="MSA">ANALYTICS</option>
      <option value="ANTH">ANTHROPOLOGY</option>
      <option value="APDB">APPLIED BASS</option>
      <option value="APBS">APPLIED BASSOON</option>
      <option value="APCE">APPLIED CELLO</option>
      <option value="APCL">APPLIED CLARINET</option>
      <option value="APCP">APPLIED COMPOSITION</option>
      <option value="APCD">APPLIED CONDUCTING</option>
      <option value="APEU">APPLIED EUPHONIUM</option>
      <option value="APFL">APPLIED FLUTE</option>
      <option value="APGT">APPLIED GUITAR</option>
      <option value="APHP">APPLIED HARP</option>
      <option value="APHN">APPLIED HORN</option>
      <option value="APJB">APPLIED JAZZ BASS</option>
      <option value="APJG">APPLIED JAZZ GUITAR</option>
      <option value="AL">APPLIED LINGUISTICS</option>
      <option value="APOB">APPLIED OBOE</option>
      <option value="APOR">APPLIED ORGAN</option>
      <option value="APPR">APPLIED PERCUSSION</option>
      <option value="APPF">APPLIED PIANO</option>
      <option value="APJP">APPLIED PIANO JAZZ PIANO</option>
      <option value="APSX">APPLIED SAXOPHONE</option>
      <option value="APTB">APPLIED TROMBONE</option>
      <option value="APTP">APPLIED TRUMPET</option>
      <option value="APTU">APPLIED TUBA</option>
      <option value="APVA">APPLIED VIOLA</option>
      <option value="APVL">APPLIED VIOLIN</option>
      <option value="APVC">APPLIED VOICE</option>
      <option value="ARBC">ARABIC</option>
      <option value="ART">ART</option>
      <option value="AE">ART EDUCATION</option>
      <option value="AH">ART HISTORY</option>
      <option value="ASTR">ASTRONOMY</option>
      <option value="BIOL">BIOLOGY</option>
      <option value="BMSC">BIOMEDICAL SCIENCE</option>
      <option value="BRFV">BIRTH THROUGH FIVE</option>
      <option value="BA">BUSINESS ADMINISTRATION--BA</option>
      <option value="BUSA">BUSINESS ADMINISTRATION--BUSA</option>
      <option value="BCOM">BUSINESS COMMUNICATION</option>
      <option value="CPI">CENTER PROCESS INNOVATION</option>
      <option value="CER">CERAMICS</option>
      <option value="CHEM">CHEMISTRY</option>
      <option value="CHIN">CHINESE</option>
      <option value="CNHP">CLG OF NURSING &amp; HEALTH PROF.</option>
      <option value="COMM">COMMUNICATION</option>
      <option value="CSD">COMMUNICATION SCI &amp; DISORDERS</option>
      <option value="CIS">COMPUTER INFORMATION SYSTEMS</option>
      <option value="CSC">COMPUTER SCIENCE</option>
      <option value="COOP">COOPERATIVE EDUCATION</option>
      <option value="CPS">COUNSELING &amp; PSYCH SERVICES</option>
      <option value="CMIS">CREATIVE MEDIA INDUSTRY STUDY</option>
      <option value="CRJU">CRIMINAL JUSTICE</option>
      <option value="EDCI">CURRICULUM &amp; INSTRUCTION</option>
      <option value="DHYG">DENTAL HYGIENE</option>
      <option value="DP">DRAWING AND PAINTING</option>
      <option value="DPP">DRAWING, PAINTING, PRINTMAKING</option>
      <option value="ECE">EARLY CHILDHOOD EDUCATION</option>
      <option value="ECON">ECONOMICS</option>
      <option value="EDBT">ED, BUSINESS, AND TECHNOLOGY</option>
      <option value="EDUC">EDUCATION</option>
      <option value="EPS">EDUCATIONAL POLICY STUDIES</option>
      <option value="EPY">EDUCATIONAL PSYCHOLOGY</option>
      <option value="ENGR">ENGINEERING</option>
      <option value="ENGL">ENGLISH</option>
      <option value="ENSL">ENGLISH AS A SECOND LANG (UG)</option>
      <option value="ESL">ENGLISH SECOND LANGUAGE (GRAD)</option>
      <option value="ENI">ENTREPRENEURSHIP</option>
      <option value="ENVS">ENVIRONMENTAL STUDIES</option>
      <option value="EPEL">EPS/EDUCATIONAL LEADERSHIP</option>
      <option value="EPRS">EPS/RESEARCH</option>
      <option value="EPSF">EPS/SOCIAL FOUNDATIONS</option>
      <option value="EURO">EUROPEAN UNION STUDIES</option>
      <option value="EXC">EXCEPTIONAL CHILDREN</option>
      <option value="EMBA">EXECUTIVE MBA</option>
      <option value="FLME">FILM AND MEDIA</option>
      <option value="FI">FINANCE</option>
      <option value="FOLK">FOLKLORE</option>
      <option value="FORL">FOREIGN LANGUAGE</option>
      <option value="FREN">FRENCH</option>
      <option value="GEOG">GEOGRAPHY</option>
      <option value="GEOL">GEOLOGY</option>
      <option value="GEOS">GEOSCIENCES</option>
      <option value="GRMN">GERMAN</option>
      <option value="GERO">GERONTOLOGY</option>
      <option value="GLOS">GLOBAL STUDIES</option>
      <option value="GRD">GRAPHIC DESIGN</option>
      <option value="GSU">GSU NEW STUDENT ORIENTATION</option>
      <option value="HA">HEALTH ADMINISTRATION</option>
      <option value="HBRM">HEBREW - MODERN</option>
      <option value="HIST">HISTORY</option>
      <option value="HSEM">HOMELAND SECURITY &amp; EMERG MGMT</option>
      <option value="HON">HONORS</option>
      <option value="HADM">HOSPITALITY ADMINISTRATION</option>
      <option value="HUMN">HUMANITIES</option>
      <option value="ISCI">INTEGRATED SCIENCES</option>
      <option value="IEP">INTENSIVE ENGLISH PROGRAM</option>
      <option value="ID">INTERIOR DESIGN</option>
      <option value="IB">INTERNATIONAL BUSINESS</option>
      <option value="INEX">INTERNATIONAL EXCHANGE</option>
      <option value="ITAL">ITALIAN</option>
      <option value="JAPN">JAPANESE</option>
      <option value="JST">JEWISH STUDIES</option>
      <option value="JOUR">JOURNALISM</option>
      <option value="KH">KINESIOLOGY &amp; HEALTH</option>
      <option value="KORE">KOREAN</option>
      <option value="EDLA">LANGUAGE ARTS EDUCATION</option>
      <option value="LATN">LATIN</option>
      <option value="LAW">LAW</option>
      <option value="LT">LEARNING TECHNOLOGIES</option>
      <option value="LGLS">LEGAL STUDIES</option>
      <option value="MGS">MANAGERIAL SCIENCES</option>
      <option value="MK">MARKETING</option>
      <option value="MBA">MASTER OF BUSINESS ADMIN</option>
      <option value="MRM">MATHEMATICAL RISK MANAGEMENT</option>
      <option value="MATH">MATHEMATICS</option>
      <option value="EDMT">MATHEMATICS EDUCATION</option>
      <option value="MES">MIDDLE EAST STUDIES</option>
      <option value="MSL">MILITARY SCIENCE LEADERSHIP</option>
      <option value="MUS">MUSIC</option>
      <option value="MUA">MUSIC APPRECIATION</option>
      <option value="MTM">MUSIC TECHNOLOGY MANAGEMENT</option>
      <option value="NSCI">NATURAL SCIENCES</option>
      <option value="NEUR">NEUROSCIENCE</option>
      <option value="NURS">NURSING</option>
      <option value="NUTR">NUTRITION</option>
      <option value="OT">OCCUPATIONAL THERAPY</option>
      <option value="PCO">PERIMETER COLLEGE ORIENTATION</option>
      <option value="PERS">PERSPECTIVES</option>
      <option value="PHIL">PHILOSOPHY</option>
      <option value="PHOT">PHOTOGRAPHY</option>
      <option value="PHED">PHYSICAL EDUCATION</option>
      <option value="PT">PHYSICAL THERAPY</option>
      <option value="PHYS">PHYSICS</option>
      <option value="POLS">POLITICAL SCIENCE</option>
      <option value="PORT">PORTUGUESE</option>
      <option value="PRT">PRINTMAKING</option>
      <option value="PMBA">PROFESSIONAL MASTER BUS ADMIN</option>
      <option value="PSYC">PSYCHOLOGY</option>
      <option value="PH">PUBLIC HEALTH</option>
      <option value="PMAP">PUBLIC MANAGEMENT &amp; POLICY</option>
      <option value="EDRD">READING EDUCATION</option>
      <option value="RE">REAL ESTATE</option>
      <option value="RELS">RELIGIOUS STUDIES</option>
      <option value="RSCH">RESEARCH STRATEGIES</option>
      <option value="RT">RESPIRATORY THERAPY</option>
      <option value="RMI">RISK MANAGEMENT AND INSURANCE</option>
      <option value="RUSS">RUSSIAN</option>
      <option value="EDSC">SCIENCE EDUCATION</option>
      <option value="SCUL">SCULPTURE</option>
      <option value="SLIP">SIGN LANGUAGE INTERPRETING</option>
      <option value="EDSS">SOCIAL STUDIES EDUCATION</option>
      <option value="SW">SOCIAL WORK</option>
      <option value="SOCI">SOCIOLOGY</option>
      <option value="SPAN">SPANISH</option>
      <option value="SCOM">SPEECH COMMUNICATION</option>
      <option value="STAT">STATISTICS</option>
      <option value="SWAH">SWAHILI</option>
      <option value="TX">TAXATION</option>
      <option value="TSLE">TEACHING ESL/COLLEGE OF ED</option>
      <option value="TEXT">TEXTILES</option>
      <option value="THEA">THEATRE</option>
      <option value="3DS">THREE-DIMENSIONAL STUDIES</option>
      <option value="URB">URBAN STUDIES INSTITUTE</option>
      <option value="WGSS">WOMEN'S GENDER &amp; SEXUALITY STU</option>
      </select>
      </td>
      </tr>
      </tbody></table>
    </div>

        <div class="">
          <button type="submit" class="btn btn-primary topnav-right">Submit</button>
        </div>


  </form>
  </div>
  
  <br>
  <br>

<footer class="bg-dark mt-4 p-5 text-center" style="color: #FFFFFF;">
  Copyright &copy; 404 NOT FOUND All Rights Reserved.
</footer>



</body>


</html>
