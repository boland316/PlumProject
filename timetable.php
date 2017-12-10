<?php include_once('functions.php'); 
session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Plum Timetable</title>
            
        <link type="text/css" rel="stylesheet" href="css/timetable.css"/>
        <link type="text/css" rel="stylesheet" href="css/calendarstyle.css"/>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/drilldown.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/jquery.min.js"></script>
        
        <script>
        
        
            function createGraph(){
                
                
                var min = [];
                var activity = [];
                var newMyObj = [];
                
                
                $.ajax({
                	url: 'getTableData.php',
                	type: 'get',
                	data: {},
                    async: false,
                	success: function(data){
                	    
                	    console.log(data);
                	    
                	    if(data != "problems"){
                	        
                	        
                	          var results = JSON.parse(data);

                	          
                	          for(var j=0; j < results.length; j++){
                	            
                	            var seriesMin;
                	            var seriesActivity;
                	            
                	            var seriesMin = results[j];
                                var seriesActivity = results[j];
                                
                                var comma = ",";
                                
                                var myObj = {name: seriesActivity[1], y: parseInt(seriesMin[0])};
                                
                                //myObj.join(',');
                                
                                console.log(myObj);
                                newMyObj.push(myObj);
                                
                                min.push(seriesMin[0]);
                                activity.push(seriesActivity[1]);
                                
                	          }
                	          
                	          // when we are happy...
                	          makeGraph();
                	    }
                	    else{
                	          
                	          alert("We have encountered an error!");
                	          

                	       }//end else
                	},
                	cache: false
                });
            
            
        function makeGraph(){
                
                
              console.log(newMyObj);
              console.log(min);
              console.log(activity);
              
                        Highcharts.chart('container', {chart: {type: 'column'},title: {text: ''},xAxis:{ categories: activity},yAxis: {title: {text: 'minutes'}},plotOptions: {series: {borderWidth: 0,dataLabels: {enabled: true,}}},
                        
                        
                        
                        series: 
                        [{
                            data: [{
                                    name: activity,
                                    y: parseInt(min[0])
                                }, {
                                    name: activity,
                                    y: parseInt(min[1])
                                },{
                                    name: activity,
                                    y: parseInt(min[2])
                                },{
                                    name: activity,
                                    y: parseInt(min[3])
                                },{
                                    name: activity,
                                    y: parseInt(min[4])
                                
                              }]
                        }]
                        
                    });
                
                        
                    }//end makeGraph
                }//end function
            
        </script>
        
    </head>
<body onload="createGraph();">
    
    <div class="container-fluid" style="float:right;">
        <div class="row">
            <div class="content">
                  	<!-- notification message -->
                  	<?php if (isset($_SESSION['success'])) : ?>
                      <div class="error success" >
                      	<h3>
                          <?php 
                          	echo $_SESSION['success']; 
                          	unset($_SESSION['success']);
                          ?>
                      	</h3>
                      </div>
                  	<?php endif ?>
                
                    <!-- logged in user information -->
                    <?php  if (isset($_SESSION['username'])) : ?>
                    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
                    	<p> <a href="index.html?logout='1'" style="color: red;">logout</a> </p>
                    <?php endif ?>
                </div>
        </div>
    </div>
    
    
    <h1>Plum Timetable</h1>
    <div class="container-fluid">
        <div class="row">
            <div id="calendar_div">
            	<?php echo getCalender(); ?>
            </div>
        </div>
    </div>      
    
    
    
     <div id="createPara"></div>
        
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    
</div>




</body>
</html>
