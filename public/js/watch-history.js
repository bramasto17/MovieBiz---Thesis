//define margin
var margin = {top:20, right:10, bottom:100, left:80},
  width = 1000 - margin.left - margin.right,
  height = 300 - margin.top - margin.bottom;
//==============

//define svg
var svg = d3.select('#chart_month')
  .append('svg')
  .attr({
    "width" : width + margin.left + margin.right,
    "height" : height + margin.top + margin.bottom
  })
  .append('g')
  .attr("transform","translate("+ margin.left + ',' + margin.right + ')');
//==============

//define tooltip and detail box
var tooltip = d3.select("#chart_month").append("div").attr("class", "toolTip");
var detail = d3.select("#chart_month").append("div").attr("class", "detail");
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
d3.json("/get-activity", function(error, data){
  //read each row
  if(error) console.log("Error, file not found");
  data.forEach(function(d){
    d.actualdate = d.date;
    d.date = +d.date.substring(8, 12);
    d.total = +d.total;
  });
  //==============  

  //specify domain of x and y scale
  x_scale.domain(data.map(function(d) { return d.date; }));
  y_scale.domain([0, d3.max(data, function(d) { return d.total; })]);
  var max = d3.max(data, function(d) { return d.total; });
  //==============

  //draw the bar
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
            "y" : function(d) { return y_scale(d.total); },
            "width" : x_scale.rangeBand(),
            "height" : function(d) { return height - y_scale(d.total); }
          })
            .attr("fill", function(d){ return color1(d.total/max);})
              .attr("id", function(d, i) {
                  return i;
              });
          //==============

          bar.on("mouseover", function(d, i) {
            d3.select(this).attr("fill", function() {
                return '#cb0000';
            });
            // create tooltip when hovering
            tooltip
              .style("left", d3.event.pageX + "px")
              .style("top", d3.event.pageY + "px")
              .style("display", "inline-block")
              .html(d.actualdate + "<br>" +d.total + " movie")
            //==============
          })
          .on("mouseout", function(d, i) {
              d3.select(this).attr("fill", function() {
            return color1(d.total/max);
              });
              tooltip.style("display", "none");
          });

          //draw x axis
          svg.append("g")
            .attr({
              "class" : "x axis",
              "transform" : "translate(0, "+ height +")",
            })
            .call(x_axis)
            .selectAll("text")
            .attr({
              "dx" : "-1em",
              "dy" : "1em"
            })
            .style({
              "text-anchor" : "center",
            });
  //==============
});
//==============
