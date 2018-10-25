var width = 500;
var height = 300;
var radius = 150;
var color = d3.scale.linear()
  .domain([0, 1])
  .range(["#d14040","#620000"]);

var tooltip_genre = d3.select("#chart_genre").append("div").attr("class", "toolTip");

d3.json("/get-favourite-genres", function(error, dataset){
    dataset.forEach(function(d){
        d.label = d.label;
        d.count = +d.count;
        d.percentage = +d.percentage;
    });
    var max = d3.max(dataset, function(d) { return d.percentage; });

    var svg = d3.select("#chart_genre").append("svg")
        .attr("width", width)
        .attr("height", height)
        .append("g")
        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    var arc = d3.svg.arc()
            .outerRadius(radius)
            .innerRadius(50);

    var pie = d3.layout.pie()
            .sort(null)
            .value(function(d){ return d.count; });

    var g = svg.selectAll(".fan")
            .data(pie(dataset))
            .enter()
            .append("g")
            .attr("class", "fan")
            .on("mouseover", function (d) {
                tooltip_genre
                    .style("left", d3.event.pageX/1.5 + "px")
                    .style("top", d3.event.pageY/10 + "px")
                    .style("display", "inline-block")
                    .html(d.data.label + "<br>" + d.data.count + " movies");
            });
            

    g.append("path")
        .attr("d", arc)
        .attr("fill", function(d,i){ return color(d.data.percentage/max);})
        .on("mouseover", function (d) {
            d3.select(this).attr("fill", function() {
                return '#d85050';
            });
        })
        .on("mouseout", function () {
            d3.select(this).attr("fill", function(d) {
                return color(d.data.percentage/max);
            });
        });

    g.append("text")
        .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
        .style("text-anchor", "middle")
        .style("fill", "#fff")
        .text(function(d) { return d.data.percentage + "%"; });
});