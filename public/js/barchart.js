//define margin
var margin = {top:20, right:10, bottom:100, left:80},
	width = 1000 - margin.left - margin.right,
	height = 300 - margin.top - margin.bottom;
//==============

//define svg
var svg = d3.select('#chart')
	.append('svg')
	.attr({
		"width" : width + margin.left + margin.right,
		"height" : height + margin.top + margin.bottom
	})
	.append('g')
	.attr("transform","translate("+ margin.left + ',' + margin.right + ')');
//==============

//define tooltip and detail box
var tooltip = d3.select("#chart").append("div").attr("class", "toolTip");
var detail = d3.select("#chart").append("div").attr("class", "detail");
//==============

//define scales
var x_scale = d3.scale.ordinal()
	.rangeRoundBands([0, width], 0.2, 0.2);

var y_scale = d3.scale.linear()
	.range([height, 0]);

var x_axis = d3.svg.axis()
	.scale(x_scale)
	.orient("bottom");

var y_axis = d3.svg.axis()
	.scale(y_scale)
	.orient("left");
//==============

//define color
var color1 = d3.scale.linear()
  .domain([0, 1])
  .range(["#838383","#838383"]);
//==============

//generate chart
genChart();
//==============


//function to generate chart
function genChart(opt){
	console.log(window.screen.availWidth);
	// delete current graph	
	svg.selectAll('rect').remove();
	svg.selectAll('g').remove();
	detail.style("display","none")

	//read data
	d3.json("/get-activity", function(error, data){
		if(error) console.log("Error, file not found");

		//read each row
		data.forEach(function(d){
			d.date = d.date;
			d.total = +d.total;
		});
		//==============
		var opt_value = "total";
		var chosen = null;
		//==============

		// //sort data
		// data.sort(function(a,b){
		// 	return b.opt_value - a.opt_value;
		// });
		// //==============

		//specify domain of x and y scale
		x_scale.domain(data.map(function(d) { return d.date; }));
		y_scale.domain([0, d3.max(data, function(d) { return d[opt_value]; })]);
		var max = d3.max(data, function(d) { return d[opt_value]; });
		console.log(d3.max(data, function(d) { return d[opt_value]; }));
		//==============

		//draw the bar
		var colorScale = d3.scale.category10();
		var bar = svg.selectAll('rect')
					.data(data)
					.enter()
					.append('rect')
					.attr("height","0")
					.attr("y",height);

			//transition the bar
			bar.transition().duration(3000)
			.delay(function(d,i){ return i = 200;})
			.attr({
				"x" : function(d) { return x_scale(d.date); },
				"y" : function(d) { return y_scale(d[opt_value]); },
				"width" : x_scale.rangeBand(),
				"height" : function(d) { return height - y_scale(d[opt_value]); }
			})
	  		.attr("fill", function(d){ return color1(d[opt_value]/max);})
	        .attr("id", function(d, i) {
	            return i;
	        });
			//==============
			
			//effect on the bar
	        bar.on("click", function(d, i) {
			            d3.select(this).attr("fill", function() {
			                return '#cb0000';
			            });

			            //formatting the number
						format = d3.format("0,000");
						//==============
						
						// create tooltip when hovering
						var pixel = window.screen.availWidth > 1366 ? 120 : 20;
			            detail
			              .style("right", pixel + "px")
			              .style("top", 250 + "px")
			              .style("display", "inline-block")
			              .html(
			              	"<h1>"+d.date+"</h1><hr><p>Total total : "+format(d.total)+"<br>Growth total : "+format(d.dately_change)
			              	+"<br>Growth Percentage : "+format(d.dately_percentage)+"%<br>Median Age : "+format(d.age_median)+"<br></p>"
			              );
			            //==============
			        })

	        		.on("mouseover", function(d, i) {
			            d3.select(this).attr("fill", function() {
			                return '#cb0000';
			            });


			            //formatting the number
						format = d3.format("0,000");
						//==============
						
						// create tooltip when hovering
			            tooltip
			              .style("left", d3.event.pageX + x_scale.rangeBand()/2 + "px")
			              .style("top", d3.event.pageY + "px")
			              .style("display", "inline-block")
			              .html((d.date) + "<br>" + (format(d[opt_value])) + " movie")
			              .moveToFront();
			            //==============
			        })

			        .on("mouseout", function(d, i) {
			            d3.select(this).attr("fill", function() {
			    			return color1(d[opt_value]/max);
			            });
			            tooltip.style("display", "none");
			        })
			        ;
			//==============
		//==============


		//draw x axis
		svg.append("g")
			.attr({
				"class" : "x axis",
				"transform" : "translate(0, "+ height +")",
			})
			.call(x_axis)
			.selectAll("text")
			.attr({
				"transform" : "rotate(-60)",
				"dx" : "-1em",
				"dy" : "1em"
			})
			.style({
				"text-anchor" : "end",
				"font-size" : "14px"
			});

		//draw y axis
		svg.append("g")
			.attr({
				"class" : "y axis",
				"font-size" : "12px"
			})
			.call(y_axis);
	});
	//==============

	//change color of the tab
	d3.selectAll(".tab").style({
		"color" : "black",
		"background-color" : "transparent"
	});
	if(opt==undefined){
		opt="total";
	}
	console.log(opt);
	d3.selectAll("#"+opt).style({
		"color" : "white",
		"background-color" : "black"
	});
}
//==============
