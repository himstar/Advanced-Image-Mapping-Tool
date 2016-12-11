<?php

require_once('config.php');
session_start();

?><!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">

<!--
 * Quick ImageMap Generator Tool With CSS Editor
 * Coded in Jquery, Angular Js and PHP
 * Author: Himanshu Dhiraj Mishra
 * 			http://imagemap.in
 -->

	<title> Quick Image Map Generator Tool With CSS Editor - Online Image Mapping Tool </title>
	<meta name="description" content="Quick Image Map Generator Tool is a free online image mapping tool helps you to create image map area with links with CSS Editor">
	<meta name="keywords" content="image mapping tool, image map Generator, image map tool with css, image mag css Editor">
	<meta name="author" content="Himanshu Dhiraj Mishra">	
	
	<!-- Icon -->
	<link rel="shortcut icon" href="favicon.ico" />

	<!-- JS -->
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="screen">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.maphilight.min.js"></script>
	<script type="text/javascript" src="js/script2.js"></script>
	<script src="js/angular.min.js"></script>
	<!-- CSS -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/snippet.css" type="text/css" media="screen" />

	<!-- Added by Himanshu -->

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<?php

if(!is_dir($uploadDir))
{
	mkdir($uploadDir);
}

// delete old images from server -> 2 = 1 day
 //delete old files
if ($handle = opendir($uploadDir))
{
	while (false !== ($file = readdir($handle)))
	{

	/*** delete old file ***/

		if($file != '.' && $file != '..')
		{
			$dir = "uploads/";
			foreach (glob($dir.'/'."*") as $file) {

			/*** if file is 24 hours (86400 seconds) old then delete it ***/
			if (filemtime($file) < time() - 57600) {
			    	 unlink($file);
			    }
			}
		}

	}
	closedir($handle);
}

// Check Session set and Loading previous Image
$uploaded = false;

if(isset($_SESSION['image']) && $_SESSION['image'] != null && !empty($_SESSION['image'][0]) && substr_count($_SESSION['image'][0], '/') >= 1) {
	if(file_exists($_SESSION['image'][0]))
	{
		$uploaded = true;
	}
}

?>

<body ng-app="QuickMap">
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top" >
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                </button>
                <a class="navbar-brand page-scroll" href="index"><img src="img/logo.png"/></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="how">How it Works ?</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="behind">Behind This</a>
                    </li>
                      <li>
                       <a class="page-scroll" href="https://github.com/himstar">Made With <i class="fa fa-heart" style="color: red;"></i> In India</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header id="upload" <?php if(isset($_SESSION['image']) && $_SESSION['image'] != null && !empty($_SESSION['image'][0]) && substr_count($_SESSION['image'][0], '/') >= 1) {if(file_exists($_SESSION['image'][0])){ ?> style="display: none;" <?php } } ?> >
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading">Create Image Map Link With CSS in a Click</h1>
                <hr>
                <p>Quick ImageMap is an advance image mapping tool for web developer, it will helps in easy image mapping  with coordinates also create custom CSS. Upload your image and click on clickable areas, Image mapping tool will perform ton of your task for FREE !!</p>
            </div>
        
	<div class="effect infobox row">
		<article>
			<div class="uploadContainer infobox2">
				<div id="uploadUndo"<?php if(!$uploaded) echo ' class="hidden"'; ?>></div>
				<!-- HTML5 Drag End -->
				<form id="uploadForm" method="post" action="upload.php?v2" enctype="multipart/form-data">
						<div class="form-group">
							<div class="col-sm-3"></div>
							<div class="col-sm-2">
								<h3> Drop / Select file here > </h3> 
							</div>
	                        <div class="col-sm-2">
	                        	<div id="drop">
	                        		<label for="file">
	                        			<img src="./images/drag.png">
	                        		</label>
	                        		<input type="file" name="image" class="form-control" multiple />
								</div>
	                        </div>
	                        <div class="col-sm-4">
	                        	<div id="uploadProcess"></div>
							</div>
	                    </div>

				</form>
				<form action="#" id="linkform">
					<br>
					<div class="form-group">
				 		<div class="col-sm-6 col-sm-offset-2">

							<input type="text" name="fileurl" value="" placeholder="Or insert an image link" id="imageurl" class="insetEffect form-control"/>
							
						</div>
		                <div class="col-sm-2">
		                    <a href="#" class="btn btn-primary btn-xl page-scroll imageurl_submit"> Get Image </a>
		                </div>
		            </div>
				</form>
				<div class="col-sm-12">
					<br>
					<p><i>Once you select your image, click on image and this script will take auto coordinates and write perfect HTML for you.</i></p>
				</div>
			</div>
		</article>
	</div>
        </div>
    </header>
		<?php
			if($uploaded)
				echo '<div id="navi" currentValue="#imagemap4posis">';
			else
				echo '<div id="navi" currentValue="#upload">';
		?>
		<ul>
			<li><a href="#" rel="#upload"></a></li>>
		</ul>
	</div>

	<div id="imagemap4posis">
		<div id="newUpload"><span><i class="fa fa-times" aria-hidden="true"></i></span></div>
		<div id="urlMessage"><p>You can't see an image?<br /><a href="#"> Upload new > </a></p></div>
		<div id="mapContainer" class="effect">
			<?php
				$attr = '';
				if($uploaded && $_SESSION['image'][1] != 0 && $_SESSION['image'][2] != 0)
				{
					//$attr = ' width="'.$_SESSION['image'][1].'" height="'.$_SESSION['image'][2].'"';
				}
			?>
			<img src="<?php echo ($uploaded) ? $_SESSION['image'][0] : '#'; ?>"<?php echo $attr; ?> id="main" class="imgmapMainImage" alt="" usemap="#map" />
			<map name="map" id="map"></map>
		</div>
		<div class="form">
			<div class="alert alert-success">
			  <strong>Tip !</strong> Click in image area to set coordinate for mapping.
			</div>
			<div id="clearStyleButtons">
				<button class="btn btn-success btn-xl clearButton"><i class="fa fa-plus-circle" aria-hidden="true"></i> Next Area </button>
				<button class="btn btn-primary btn-xl clearCurrentButton"><i class="fa fa-plus-circle" aria-hidden="true"></i> Clear Last </button>
				<button class="btn btn-primary btn-xl clearAllButton"><i class="fa fa-retweet" aria-hidden="true"></i> Reset All </button>
				<button class="btn btn-primary btn-xl textareaButton3"><i class="fa fa-trash" aria-hidden="true"></i> Change Image </button>
				<button class="btn btn-info btn-xl" onclick="addCss()"><i class="fa fa-code" aria-hidden="true"></i> Add CSS </button>
			</div>

			<div class="form-group">
		 		<div class="col-sm-8">
					<input id="coordsText" name="" type="text" value="" placeholder="&laquo; Coordinates &raquo;"  class="insetEffect form-control"/>
				</div>
                <div class="col-sm-8">
                    <textarea name="" id="areaText" class="form-control" placeholder="&laquo; HTML-Code &raquo;"></textarea>
                </div>
            </div>
		</div>

	</div>

	<!-- Modal -->
	<div ng-controller="QuickMap" id="cssModal" class="modal fade" role="dialog">
	  <div class="modal-dialog" style="width: 80%">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	         Fill Color: <input type="color" ng-model="fillcolor" />
    		Shadow Color: <input type="color" ng-model="shadowcolor" />
    		Stroke Color: <input type="color" ng-model="strokecolor" />
    		Stroke Width: <input type="number" class="form-control" style="width: 60px; display: inline-block;" val="6" ng-model="strokewidth" />
    		Shadow Radius: <input type="number" class="form-control" style="width: 70px; display: inline-block;" val="6" ng-model="shadowradius" />
	      </div>
	      <div class="modal-body row">
		      <div class="col-sm-6">
		      <textarea class="valmap" style="height: 320px; width: 100%" class="form-control"></textarea>
		      </div>
		      <div class="col-sm-6">
				<textarea style="height: 320px" id="cssvalue" class="form-control"><?php include 'import.php'; ?>
				</textarea>
		      </div>
	      </div>
	      <div class="modal-footer">
	         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>

	<!-- jQuery File Upload -->
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.fileupload.js"></script>
	<script src="js/script_upload.js"></script>
	
	<script type="text/javascript">
		var imgvalue = "<?php echo ($uploaded) ? $_SESSION['image'][0] : '#'; ?>";

		var app = angular.module('QuickMap', []);
		app.filter('removehash', function () {
		    return function (text) {
		        var str = text.replace('#', '');
		        return str;
		    };
		});
		app.controller('QuickMap', function($scope) {
		    $scope.strokecolor = "#f0f0f0";
		    $scope.shadowcolor = "#f0f0f0";
		    $scope.fillcolor = "#f0f0f0";
		    $scope.strokewidth = 6;
		    $scope.shadowradius = 0.8;
		});

		$(function() {
			<?php if($uploaded) { ?>
				setTimeout(function() {
					$('#imagemap4posis').slideDown(400, function() {
						resizeHtml();
					});
					loadImagemapGenerator(0,0);
				}, 600);
			<?php } else { ?>
				$('#upload').delay(600).slideDown(400, function() {
					resizeHtml();
				});
				resizeHtml();
			<?php } ?>
		});
		
		function addCss(){
			var mapdata = $("#areaText").val();
		
			if (mapdata.indexOf("QuickMap") !== -1) {
				$("#cssModal").modal("show");
				$(".valmap").val(mapdata);
				}
			else {
				$('<div class="alert alert-danger"><strong>ERROR !</strong> Please Select Map Area First !!!</div>').insertAfter('.alert-success').delay(200 + 200).slideDown(200).delay(3000).slideUp(400, function(){ $(this).remove(); });;
			}
		}
	</script>
	
</body>
</html>