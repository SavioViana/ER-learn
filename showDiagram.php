<?php 
require_once "class/user.php";
require_once "class/diagram.php";

User::autentication();

$activity_id = $_GET['activity_id'];

$diagramObj = new Diagram();

$diagram = $diagramObj->getDiagram($activity_id);

$entities = $diagram[0]->diagram_json;

$entities = json_decode($entities, true);

$relationship = $diagram[0]->relatioship_json;

$relationship = json_decode($relationship, true);

//print_r($relationship);


?>

	<!DOCTYPE html>
	<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Diagrama ER</title>
		<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css">
		<link rel="stylesheet" href="./css/stylesheet.css">
	</head>
	<body onload="init()">

		<!--navbar-->
		<?php include("./inc/navbarTeacher.php"); ?>

		<div class="content container mt-5">
			<h1>Diegrama ER</h1>

			<div id="sample">

				<div id="myDiagramDiv" style="background-color: white; border: solid 1px black; width: 100%; height: 500px"></div>
				<p>Diagrama entidade relacionamento referente a esta atividade!
				</p>
	
			</div>

			<div>
				<a class="btn btn-secondary btn-lg" href="./activity.php?activity_id=<?php echo($activity_id) ?>">Voltar</a>
			</div>


		</div><!--/container-->

		<!-- Footer -->
		<?php include("./inc/footer.php"); ?>


		<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
		<script src="./node_modules/popper.js/dist/popper.min.js"></script>
		<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
		<script src="./node_modules/jquery/dist/jquery.js"></script>
		<script src="./node_modules/gojs/go-debug.js"></script>

		<script type="text/javascript">

			function init1(){

				var json = <?php echo(json_encode($entities)) ?>;

			//console.log(json);

			$.each(json, function (key, value) {
				
				//console.log(value);
				$.each(value, function (key, value1) {
					//console.log(key.name);

				});

				console.log("#########################");

			});
		}

		function init() {

			var $ = go.GraphObject.make;  // for conciseness in defining templates

			myDiagram =
		      $(go.Diagram, "myDiagramDiv",  // must name or refer to the DIV HTML element
		      {
		      	initialContentAlignment: go.Spot.Center,
		      	allowDelete: false,
		      	allowCopy: false,
		      	layout: $(go.ForceDirectedLayout),
		      	"undoManager.isEnabled": true
		      });

		    // define several shared Brushes
		    var bluegrad = $(go.Brush, "Linear", { 0: "rgb(150, 150, 250)", 0.5: "rgb(86, 86, 186)", 1: "rgb(86, 86, 186)" });
		    var greengrad = $(go.Brush, "Linear", { 0: "rgb(158, 209, 159)", 1: "rgb(67, 101, 56)" });
		    var redgrad = $(go.Brush, "Linear", { 0: "rgb(206, 106, 100)", 1: "rgb(180, 56, 50)" });
		    var yellowgrad = $(go.Brush, "Linear", { 0: "rgb(254, 221, 50)", 1: "rgb(254, 182, 50)" });
		    var lightgrad = $(go.Brush, "Linear", { 1: "#E6E6FA", 0: "#FFFAF0" });

		     // the template for each attribute in a node's array of item data
		     var itemTempl =
		     $(go.Panel, "Horizontal",
		     	$(go.Shape,
		     		{ desiredSize: new go.Size(10, 10) },
		     		new go.Binding("figure", "figure"),
		     		new go.Binding("fill", "color")),
		     	$(go.TextBlock,
		     		{ stroke: "#333333",
		     		font: "bold 14px sans-serif" },
		     		new go.Binding("text", "name"))
		     	);


		     // define the Node template, representing an entity
		     myDiagram.nodeTemplate =
		      $(go.Node, "Auto",  // the whole node panel
		      	{ selectionAdorned: true,
		      		resizable: true,
		      		layoutConditions: go.Part.LayoutStandard & ~go.Part.LayoutNodeSized,
		      		fromSpot: go.Spot.AllSides,
		      		toSpot: go.Spot.AllSides,
		      		isShadowed: true,
		      		shadowColor: "#C5C1AA" },
		      		new go.Binding("location", "location").makeTwoWay(),
		        // whenever the PanelExpanderButton changes the visible property of the "LIST" panel,
		        // clear out any desiredSize set by the ResizingTool.
		        new go.Binding("desiredSize", "visible", function(v) { return new go.Size(NaN, NaN); }).ofObject("LIST"),
		        // define the node's outer shape, which will surround the Table
		        $(go.Shape, "Rectangle",
		        	{ fill: lightgrad, stroke: "#756875", strokeWidth: 3 }),
		        $(go.Panel, "Table",
		        	{ margin: 8, stretch: go.GraphObject.Fill },
		        	$(go.RowColumnDefinition, { row: 0, sizing: go.RowColumnDefinition.None }),
		          // the table header
		          $(go.TextBlock,
		          {
		          	row: 0, alignment: go.Spot.Center,
		              margin: new go.Margin(0, 14, 0, 2),  // leave room for Button
		              font: "bold 16px sans-serif"
		          },
		          new go.Binding("text", "key")),
		          // the collapse/expand button
		          $("PanelExpanderButton", "LIST",  // the name of the element whose visibility this button toggles
		          	{ row: 0, alignment: go.Spot.TopRight }),
		          // the list of Panels, each showing an attribute
		          $(go.Panel, "Vertical",
		          {
		          	name: "LIST",
		          	row: 1,
		          	padding: 3,
		          	alignment: go.Spot.TopLeft,
		          	defaultAlignment: go.Spot.Left,
		          	stretch: go.GraphObject.Horizontal,
		          	itemTemplate: itemTempl
		          },
		          new go.Binding("itemArray", "items"))
		        )  // end Table Panel
		      );  // end Node


		      // define the Link template, representing a relationship
		      myDiagram.linkTemplate =
		      $(go.Link,  // the whole link panel
		      {
		      	selectionAdorned: true,
		      	layerName: "	",
		      	reshapable: true,
		      	routing: go.Link.AvoidsNodes,
		      	corner: 5,
		      	curve: go.Link.JumpOver
		      },
		        $(go.Shape,  // the link shape
		        	{ stroke: "#303B45", strokeWidth: 2.5 }),
		        $(go.TextBlock,  // the "from" label
		        {
		        	textAlign: "center",
		        	font: "bold 14px sans-serif",
		        	stroke: "#1967B3",
		        	segmentIndex: 0,
		        	segmentOffset: new go.Point(NaN, NaN),
		        	segmentOrientation: go.Link.OrientUpright
		        },
		        new go.Binding("text", "text")),
		        $(go.TextBlock,  // the "to" label
		        {
		        	textAlign: "center",
		        	font: "bold 14px sans-serif",
		        	stroke: "#1967B3",
		        	segmentIndex: -1,
		        	segmentOffset: new go.Point(NaN, NaN),
		        	segmentOrientation: go.Link.OrientUpright
		        },
		        new go.Binding("text", "toText"))
		        );


		      var nodeDataArray = [];



		    var json = '<?php echo(json_encode($entities)) ?>';

		      let jsonObj = JSON.parse(json);
		      
		    jsonObj.forEach((value, index)=>{

		      	let valueObj = Object.values(value);

		      	let array = [];

		      	for (let i=0; i < valueObj.length; i++) {
		      		
		      		//console.log(valueObj[i])
		      		if(i == 1 ){
		      			//console.log('continua');
		      			continue;
		      		}

		      		if(i == 0){
		      			//se for chave
		      			if(valueObj[1] == 'on'){

		      				//console.log('chave');
		      				array.push({ name: valueObj[i], iskey: true, figure: "Decision", color: yellowgrad });

		      			}else{

		      				//console.log('nao chave');
		      				array.push({ name: valueObj[i], iskey: false, figure: "Cube1", color: bluegrad });

		      			}

		      			//console.log('index ' + index + '  - value: ' + valueObj[i]);
		      			//array.push({ name: value1, iskey: true, figure: "Decision", color: yellowgrad });

		      		}else{

		      			array.push({ name: valueObj[i], iskey: false, figure: "Cube1", color: bluegrad });

		      		}

		      	}
		      	
		      	
		      	let obj = { key: value.name,
		        			items: array }

		        nodeDataArray.push(obj);
				
		    });

		    

	         
	       


			/*
		    // create the model for the E-R diagram
		    var nodeDataArray = [
		      { key: "Products",
		        items: [ { name: "ProductID", iskey: true, figure: "Decision", color: yellowgrad },
		                 { name: "ProductName", iskey: false, figure: "Cube1", color: bluegrad },
		                 { name: "ProductValue", iskey: false, figure: "Cube1", color: bluegrad },
		                 { name: "SupplierID", iskey: false, figure: "Decision", color: "purple" },
		                 { name: "CategoryID", iskey: false, figure: "Decision", color: "purple" } ] },
		      { key: "Suppliers",
		        items: [ { name: "SupplierID", iskey: true, figure: "Decision", color: yellowgrad },
		                 { name: "CompanyName", iskey: false, figure: "Cube1", color: bluegrad },
		                 { name: "ContactName", iskey: false, figure: "Cube1", color: bluegrad },
		                 { name: "Address", iskey: false, figure: "Cube1", color: bluegrad } ] },
		      { key: "Categories",
		        items: [ { name: "CategoryID", iskey: true, figure: "Decision", color: yellowgrad },
		                 { name: "CategoryName", iskey: false, figure: "Cube1", color: bluegrad },
		                 { name: "Description", iskey: false, figure: "Cube1", color: bluegrad },
		                 { name: "Picture", iskey: false, figure: "TriangleUp", color: redgrad } ] },
		      { key: "Order Details",
		        items: [ { name: "OrderID", iskey: true, figure: "Decision", color: yellowgrad },
		                 { name: "ProductID", iskey: true, figure: "Decision", color: yellowgrad },
		                 { name: "UnitPrice", iskey: false, figure: "MagneticData", color: greengrad },
		                 { name: "Quantity", iskey: false, figure: "MagneticData", color: greengrad },
		                 { name: "Discount", iskey: false, figure: "MagneticData", color: greengrad } ] },
		    ];  
		    */
		    
		    /*
		    var linkDataArray = [
		    
		      { from: "Products", to: "Suppliers", text: "0..N", toText: "1" },
		      { from: "Products", to: "Categories", text: "0..N", toText: "1" },
		      { from: "Order Details", to: "Products", text: "0..N", toText: "1" }
		      
		      ];

		      */

		    	//criando relacionamento
		    	var linkDataArray = [];

		    	var relationshipJson = '<?php echo(json_encode($relationship)) ?>';
		    	
		    	let relationshipJsonObj = JSON.parse(relationshipJson);
		    	
		    	//console.log(relationshipJsonObj);
		      	
		      	relationshipJsonObj.forEach((value) =>{
		    		console.log(value.cardinalityS);

		    		linkDataArray.push({ from: value.pe, to: value.se, text: value.cardinalityP, toText: value.cardinalityS });

		      	});


		    	myDiagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);
			}

		</script>

	</body>
	</html>