<!doctype html>
<html>
<head>
  <title>Network | Static smooth curves</title>
	<!-- THE MENU -->
		
  <script type="text/javascript" src="scripts/utility.js"></script>
  <script type="text/javascript" src="scripts/rawData.js"></script>
  <script type="text/javascript" src="libs/jquery-1.10.2.js" charset="utf-8"></script>
  <script type="text/javascript" src="libs/underscore-min.js" ></script>
  <script type="text/javascript" src="scripts/article-editor-global-data.js"></script>
  <script src="libs/JavaScript-Load-Image-master/js/load-image.all.min.js"></script>
   

  <script type="text/javascript" src="scripts/article-editor-php-requests.js"></script>
  
  <script src="libs/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
  <link href="libs/jquery-ui-1.11.4.custom/jquery-ui.css" rel="stylesheet">
  <!-- HTML5 rich editor -->
  <script src="libs/external/jquery.hotkeys.js"></script>
  <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
  <script src="libs/bootstrap-wysiwyg.js"></script>
	
  
  <script type="text/javascript" src="libs/vis/dist/vis.js"></script>
  <link href="libs/vis/dist/vis.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="libs/TextStatistics.js" charset="utf-8"> </script>
  <script type="text/javascript" src="scripts/retrieve-data.js"></script>
  <script type="text/javascript" src="scripts/article-editor-controller-data-manipulation.js"></script>
  <script type="text/javascript" src="scripts/article-editor-renderer-quality-manager.js"></script>
  <script type="text/javascript" src="scripts/article-editor-renderer-semantic-zooming.js"></script>
  <script type="text/javascript" src="scripts/article-editor-renderer.js"></script>
  <script type="text/javascript" src="scripts/article-editor-controller.js"></script>
  <link rel="stylesheet" type="text/css" href="menu/css/demo.css" />
  <link rel="stylesheet" type="text/css" href="menu/css/style8.css" />
  <link rel="stylesheet" type="text/css" href="css/progressBar.css" />
  <link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css' />
		
   <link rel="stylesheet" type="text/css" href="libs/wikitexteditorMarkItUp/markitup/skins/markitup/style.css" />
   <link rel="stylesheet" type="text/css" href="libs/wikitexteditorMarkItUp/markitup/sets/wiki/style.css" />
   <script type="text/javascript" src="libs/wikitexteditorMarkItUp/markitup/jquery.markitup.js"></script>
   <script type="text/javascript" src="libs/wikitexteditorMarkItUp/markitup/sets/wiki/set.js"></script>


  <style type="text/css">
  #mainContent{
  position: relative; width: 100%; left: 10px; overflow-x: scroll; overflow-y: hidden; height: 700px;
  }
    #mynetwork {
	position:absolute;
	  top: 0px;
      width: 700px;
      height: 680px;
      border: 1px solid lightgray;
	  float: left;
	  background-color:white;
    }
  .ui-resizable-helper { border: 2px dotted #00F; }
	#wikiText {
	position:absolute;
	left: 700px;
	 width: 700px;
      height: 700px;
      border: 1px solid lightgray;
	  background-color:white;
	  padding-right: 5px; 
	  padding-left: 5px; 
	  margin-right: 5px; 
	  margin-left: 5px; 
	  overflow-y: auto;
	}
	#optionPanel {
	position:absolute;
	left: 1420px;
	height: 680px;
	float: left; 
	background-color: white;
	 }
   #mynetworkDetailView {
	  top: 0px;
      width: 400px;
      height: 350px;
      border: 1px solid lightgray;
	  float: left;
	  background-color:white;
    }
	
	 #editor {
	  background-color:white; overflow:scroll; height:350px; width: 400px;}
	 
    table.legend_table {
      font-size: 11px;
      border-width:1px;
      border-color:#d3d3d3;
      border-style:solid;
    }
    table.legend_table,td {
      border-width:1px;
      border-color:#d3d3d3;
      border-style:solid;
      padding: 2px;
    }
    div.table_content {
      width:80px;
      text-align:center;
    }
    div.table_description {
      width:100px;
    }

    #operation {
      font-size:28px;
    }
    #network-popUp {
      display:none;
      position:absolute;
      top:350px;
      left:170px;
      z-index:299;
      width:250px;
      height:120px;
      background-color: #f9f9f9;
      border-style:solid;
      border-width:3px;
      border-color: #5394ed;
      padding:10px;
      text-align: center;
    }
  </style>
</head>

<body bgcolor="white">

<script>  var articleController = new ArticleController(); </script>
<!-- Smooth curve type:
<select id="dropdownID">
    <option value="continuous" selected="selected">continuous</option>
    <option value="discrete">discrete</option>
    <option value="diagonalCross">diagonalCross</option>
    <option value="straightCross">straightCross</option>
    <option value="horizontal">horizontal</option>
    <option value="vertical">vertical</option>
    <option value="curvedCW">curvedCW</option>
    <option value="curvedCCW">curvedCCW</option>
</select><br/>-->
<div > 
<table style="border: 0px"> <tr> <td>
Article name: <input id="articleName" type="text" value="User:Dst2015/sandbox"> <button onclick="articleController.retrieveData()"> retrieve data </button>
</td><td>
<p id="workingAnimation"></p>
</td>
</tr>
</table>
</div>
<br/>
<div id="menu" >
  <ul class="ca-menu">
                    <li>
                        <a onclick="articleController.showAllItems()">
                            <span class="ca-icon">p</span>
                            <div class="ca-content">
                                <h2 class="ca-main">show all items</h2>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="changeLayout()">
                            <span class="ca-icon">H</span>
                            <div class="ca-content">
                                <h2 class="ca-main">change layout</h2>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="articleController.showReferences()">
                            <span class="ca-icon" >,</span>
                            <div class="ca-content">
                                <h2 class="ca-main">show external references</h2>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="articleController.showImages()">
                            <span class="ca-icon">I</span>
                            <div class="ca-content">
                                <h2 class="ca-main">show images</h2>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="articleController.doRedraw()">
                            <span class="ca-icon">J</span>
                            <div class="ca-content">
                                <h2 class="ca-main">redraw</h2>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="articleController.semanticZooming()">
                            <span class="ca-icon">%</span>
                            <div class="ca-content">
                                <h2 class="ca-main">semantic zooming</h2>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="articleController.showOverview()">
                            <span class="ca-icon">L</span>
                            <div class="ca-content">
                                <h2 class="ca-main">show overview</h2>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="articleController.showQuality()">
                            <span class="ca-icon">.</span>
                            <div class="ca-content">
                                <h2 class="ca-main">show the quality of the article</h2>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="articleController.reset()">
                            <span class="ca-icon">J</span>
                            <div class="ca-content">
                                <h2 class="ca-main">reset</h2>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="articleController.showTheWholeArticle()">
                            <span class="ca-icon">a</span>
                            <div class="ca-content">
                                <h2 class="ca-main">show article as text</h2>
                            </div>
                        </a>
                    </li>
                    <li id="liLogin">
                        <a onclick="articleController.login()">
                            <span class="ca-icon">U</span>
                            <div class="ca-content">
                                <h2 class="ca-main">login</h2>
                                <h3 class="ca-sub" id="loginSUB">not logged in</h3>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a onclick="articleController.showSettings()">
                            <span class="ca-icon">S</span>
                            <div class="ca-content">
                                <h2 class="ca-main">settings</h2>
                            </div>
                        </a>
                    </li>
                </ul>
</div>
<br/>
<!-- <input type="file" id="file-input">	<div id="fileDisplayArea"></div> -->
				<!-- NOT USEFUL ANYMORE -->
				<!-- <button onclick="articleController.splitSectionsIntoParagraphs()"> split sections into paragraphs </button>
				 <button onclick="articleController.combineParagaphsToSections()"> combine paragraphs to sections </button> -->
				 <!--<button onclick="articleController.resizeSections()"> resize sections </button> -->
				 
				 
<!--
				 <button onclick="articleController.showAllItems()"> show all items </button> 
				 <button onclick="articleController.colorLevels(true)"> color levels </button>
				 <button onclick="articleController.colorLevels(false)"> no color </button>
				 <button onclick="articleController.showReferences()"> show external references</button>
				 <button onclick="articleController.hideReferences()"> hide external references</button>
				 <button onclick="articleController.showImages()"> show images</button>
				 <button onclick="articleController.hideImages()"> hide images</button>
				 <button onclick="articleController.posImages()"> reposition images</button>
				 <button onclick="articleController.copy()"> copy (just for performance testing)</button>
				 <button onclick="articleController.doRedraw()">redraw</button> <br />
				 <button onclick="articleController.semanticZooming(true)"> semantic zooming on </button> 
				 <button onclick="articleController.semanticZooming(false)"> semantic zooming off </button> 
				 <button onclick="articleController.showOverview()"> show Overview </button> 
				 <button onclick="articleController.showQuality()"> show the quality of the article </button> 
				 <button onclick="articleController.reset()"> reset </button> 
				 <br />
				 <button onclick="articleController.showTheWholeArticle()"> show the whole article </button> -->
				<!--Roundness (0..1): <input type="range" min="0" max="1" value="0.5" step="0.05" style="width:200px" id="roundnessSlider"> <input id="roundnessScreen" value="0.5"> (0.5 is max roundness for continuous, 1.0 for the others)-->
	


<!--<button onclick="articleController.fillDataNew()"> show the article </button>-->
<div id="dialog" title="Dialog Title">
	<textarea id="node-label" rows="30" cols="100" ></textarea>
</div>
<div id="dialogCreateNewNode" title="Create new node">
	<h1> What would you like to add? </h1>
	<hr />
	<div id="createNewNodeMasterName"> </div>
	<select id="uploadSelect" name="top5" > 
      <option>Section</option> 
      <option>Image</option> 
    </select> 
	<div id="uploadDiv"> 
	  		<textarea id="createSectionTextArea" rows="30" cols="100" ></textarea>
	</div>
</div>
<div id="articleViewer" title="Dialog Title">
	<div id="articleViewerQualityTableDiv" align="center"> </div> 
	<div id="articleViewerDiv" style="height:100%; width:100%; overflow-y: scroll;">
	</div>
	<!-- <table id="articleViewerQualityTable"> </table>
	<textarea id="articleViewerTextarea" rows="30" cols="100" ></textarea> -->
</div>

<div id="dialogLogin" title="Login">
	<table align="center">
	<tr>
	<td>
	Username: </td><td><input id="loginUsername" type="text" value="Dst2015"/></td></tr>
	<tr><td>Password: </td><td><input id="loginPassword" type="password"  value="kc2015"/></td></tr>
</table>
</div>
<div id="dialogEditInProgres" title="Edit in progress">
	<div id="editAnimationContainer" >Your changes are getting saved right now. This can take up to 20 sec.</div>
</div>
<div id="dialogSettings" title="Settings">
<table>
<tr><td>Strictness of the assessment (only changes the color)</td><td> <input id="sliderStrictness" type="range"  min="0" max="100" value="50"/></td></tr>
<tr><td align="center"><b>Names</b></td><td align="center"><b>Weights</b></td></tr>
<tr><td>Flesch score</td><td> <input id="sliderFlesch" type="range"  min="0" max="100" /></td></tr>
<tr><td>Kincaid score</td><td> <input id="sliderKincaid" type="range"  min="0" max="100" /></td></tr>
<tr><td>Image quality</td><td> <input id="sliderImageQuality" type="range"  min="0" max="100" /></td></tr>
<tr><td>Quality of external refs</td><td> <input id="sliderExternalRefs" type="range"  min="0" max="100" /></td></tr>
<tr><td>Quality of all links</td><td> <input id="sliderAllLinks" type="range"  min="0" max="100" /></td></tr>
<tr><td align="center"><b>Names</b></td><td align="center"><b>Influence</b></td></tr>
<tr><td>Flesch score</td><td> <input id="sliderFleschInfluence" type="range"  min="0" max="100" /></td></tr>
<tr><td>Kincaid score</td><td> <input id="sliderKincaidInfluence" type="range"  min="0" max="100" /></td></tr>
<tr><td>Image quality</td><td> <input id="sliderImageQualityInfluence" type="range"  min="0" max="100" /></td></tr>
<tr><td>Quality of external refs</td><td> <input id="sliderExternalRefsInfluence" type="range"  min="0" max="100" /></td></tr>
<tr><td>Quality of all links</td><td> <input id="sliderAllLinksInfluence" type="range"  min="0" max="100" /></td></tr>
<tr><td></td><td><input onclick="resetToDefaultSettings()" type="button" value="reset values" /></td></tr>
</table>
</div>

<div id="mainContent" style="">
<div id="mynetwork" ></div>
<div id="wikiText" >
	<!--<textarea id="wikiTextTextarea" rows="35" cols="50" ></textarea>-->
</div>

<td  rowspan="2">
<div  id="optionPanel" style="" >
<div style=" height: 340px; width:400px;  ">
<span> <b> Article information </b> </span>
<hr/>
<div > 
 <p id="overallScore" style="width:80%" data-value="80"><b>Quality score of the article: </b></p>
  <meter id="progressBarOverallScore" style="width:99%" min="0" max="100" low="50" high="80" optimum="100" value="0"></meter>
        <!-- <progress id="progressBarOverallScore" max="100" value="100" class="html5">
            <div class="progress-bar">
                <span style="width: 80%">80%</span>
            </div>
        </progress> -->
</div> 
<div id="qualityParameters"> 
</div>

<hr /> 


</div><div style="height: 340px; width:400px ">
<div id="mynetworkDetailView"></div>
</div>
</div>
</div>

<script>
			articleController.init();
</script>
<script>
  $(function () {
  	//$('#editor').wysiwyg();
	
	$('#wikiTextTextarea').markItUp(mySettings);
  	$('#node-label').markItUp(mySettings);
  		$('#createSectionTextArea').markItUp(mySettings);
  });

  $("#dialog").dialog({
  	autoOpen : false,
  	width : 1000,
  	modal : true
  });

  $("#articleViewer").dialog({
  	autoOpen : false,
  	width : 1000,
  	height : 800,
  	modal : true
  });

  $("#dialogLogin").dialog({
  	autoOpen : false,
  	width : 400,
  	height : 210,
  	modal : true
  });

  $("#dialogSettings").dialog({
  	autoOpen : false,
  	width : 400,
  	height : 650,
  	modal : false
  });

  $("#dialogCreateNewNode").dialog({
  	autoOpen : false,
  	width : 1000,
  	height : 800,
  	modal : false
  });
  
  $("#dialogEditInProgres").dialog({
  	autoOpen : false,
  	width : 400,
  	height : 150,
  	modal : true
  });
  
  $("#uploadSelect").change(function () {
  	console.log($(this).val());
  	if ($(this).val() == "Section") {
  		$("#uploadDiv").html("<textarea id=\"createSectionTextArea\" rows=\"30\" cols=\"100\" ></textarea>");
  		$('#createSectionTextArea').markItUp(mySettings);
  	} else if ($(this).val() == "Image") {
  		$("#uploadDiv").html("<input type=\"file\" id=\"file-input\"> <div id=\"fileDisplayArea\"></div>");
  		var fileInput = document.getElementById('file-input');
  		var fileDisplayArea = document.getElementById('fileDisplayArea');

  		fileInput.addEventListener('change', function (e) {
  			var file = fileInput.files[0];
  			var imageType = /image.*/;

  			if (file.type.match(imageType)) {
  				var reader = new FileReader();

  				reader.onload = function (e) {
  					fileDisplayArea.innerHTML = "";

  					var img = new Image();
  					//console.log("READER RESULT: " + reader.result);
  					img.src = reader.result;
  					currentImageSrc = reader.result;
  					img.id = "imageToUpload";
  					fileDisplayArea.appendChild(img);
  				}

  				reader.readAsDataURL(file);
  			} else {
  				fileDisplayArea.innerHTML = "File not supported!"
  			}
  		});
  	}
  });

  var isChangeLayout = false;
  var changeLayout = function () {
  	console.log("IN HERE changeLayout")
  	if (!isChangeLayout) {
  		$("#mynetwork").draggable({
  			axis : "x",
  			start : function () {},
  			drag : function () {
  				console.log("POSTITION1: " + $(this).offset().left + " " + $(this).width());
  			},
  			stop : function () {}
  		});
  		$("#wikiText").draggable({
  			axis : "x",
  			start : function () {},
  			drag : function () {
  				/*	console.log("POSTITION2: " + $(this).offset().left + " " +$(this).width());
  				console.log("POSTITION2: " + ($(this).offset().left + $(this).width() ) + " > " +$("#optionPanel").offset().left);
  				if($(this).offset().left + $(this).width() > $("#optionPanel").offset().left){
  				//console.log("POSTITION2: IN HERE " + $("#optionPanel").css("position"));
  				var help = 0;//$("#optionPanel").css("left");
  				width = $("#optionPanel").width()+20;
  				$("#optionPanel").css("left" , (help - $(this).width()-20));
  				return false;
  				//$("#wikiText").css("left",  (width));
  				}*/
  			},
  			stop : function () {

  				//$("#wikiText").css("left",  (width));
  			}

  		});
  		$("#optionPanel").draggable({
  			axis : "x",

  			start : function () {},
  			drag : function () {
  				console.log("POSTITION3: " + $(this).offset().left + " " + $(this).width());
  			},
  			stop : function () {}

  		});
  		isChangeLayout = true;
  	} else {
  		console.log("IN HERE changeLayout2")
  		$("#mynetwork").draggable("disable");
  		$("#wikiText").draggable("disable");
  		$("#optionPanel").draggable("disable");
  		isChangeLayout = false;
  	}
  }
  $(document).ready(function () {
  	(function () {
  		function scrollHorizontally(e) {
  			e = window.event || e;
  			var delta = Math.max(-1, Math.min(1, (e.wheelDelta || -e.detail)));
  			document.getElementById('mainContent').scrollLeft -= (delta * 40); // Multiplied by 40
  			e.preventDefault();
  		}
  		if (document.getElementById('mainContent').addEventListener) {
  			// IE9, Chrome, Safari, Opera
  			document.getElementById('mainContent').addEventListener("mousewheel", scrollHorizontally, false);
  			// Firefox
  			document.getElementById('mainContent').addEventListener("DOMMouseScroll", scrollHorizontally, false);
  		} else {
  			// IE 6/7/8
  			document.getElementById('mainContent').attachEvent("onmousewheel", scrollHorizontally);
  		}
  	})();
  	var width = 0;
  	$('#mynetwork').resizable({
      helper: "ui-resizable-helper",
      ghost: true});
  	$('#wikiText').resizable({
      helper: "ui-resizable-helper",
      ghost: true});

  	//$('#optionPanel').resizable();
  });
  /*document.getElementById('file-input').onchange = function (e) {


  loadImage(
  e.target.files[0],
  function (img) {
  //$("#uploadDiv").append(img);
  console.log("img: " + img.src);

  document.body.appendChild(img);
  }, {
  maxWidth : 600
  } // Options
  );
  }*/
</script>

  <script type="text/javascript" src="scripts/article-editor-settings.js"></script>
</body>
</html>
