<!doctype html>
<html>
<head>
  <title>Network | Static smooth curves</title>
	<!-- THE MENU -->
		
  <script type="text/javascript" src="scripts/utility.js"></script>
  <script type="text/javascript" src="scripts/rawData.js"></script>
  <script type="text/javascript" src="libs/jquery-1.10.2.js" charset="utf-8"></script>

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
        <link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css' />


  <style type="text/css">
    #mynetwork {
	  top: 0px;
      width: 1450px;
      height: 700px;
      border: 1px solid lightgray;
	  float: left;
	  background-color:white;
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
Article name: <input id="articleName" type="text" value="Nikola Tesla"> <button onclick="articleController.retrieveData()"> retrieve data </button>
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
                        <a onclick="articleController.colorLevels()">
                            <span class="ca-icon">H</span>
                            <div class="ca-content">
                                <h2 class="ca-main">color levels</h2>
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
                    <li>
                        <a onclick="articleController.login()">
                            <span class="ca-icon">U</span>
                            <div class="ca-content">
                                <h2 class="ca-main">login</h2>
                            </div>
                        </a>
                    </li>
                </ul>
</div>
<br/>

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
	Username: </td><td><input id="loginUsername" type="text" /></td></tr>
	<tr><td>Password: </td><td><input id="loginPassword" type="password" /></td></tr>
</table>
</div>


<table style="background-color: white"> 
<tr>
<td rowspan="2">
<div id="mynetwork" ></div>
</td>
<td>

<div style="height: 340px; width:400px;    overflow:scroll;">
<span> <b> Article information </b> </span>
<hr/>
<div id="overallScore"> 
</div> 
<hr /> 
<div id="qualityParameters"> 
</div>
</div>
</td>
</tr>
</tr>
<td>
<div style="height: 340px; width:400px ">
<div id="mynetworkDetailView"></div>
</div>
</td>
</tr>
</table>
<script>
			articleController.init();
</script>
<script>

  $(function(){
$('#editor').wysiwyg();
  });
  
	$("#dialog").dialog({
		autoOpen : false,
		width : 1000,
		modal : true
	});
  
	$("#articleViewer").dialog({
		autoOpen : false,
		width : 1000,
		height: 800,
		modal : true
	});
  
	$("#dialogLogin").dialog({
		autoOpen : false,
		width : 400,
		height: 210,
		modal : true
	});
</script>
</body>
</html>
