var parentDiv_genre = document.getElementById("div_genre");
var width_genre = parentDiv_genre.clientWidth;
var height_genre = 3/5*parentDiv_genre.clientWidth;
var radius = 150;
var color = d3.scale.linear()
  .domain([0, 1])
  .range(["#F4998D","#9C0000"]);

var tooltip_genre = d3.select("#chart_genre").append("div").attr("class", "toolTip");

d3.json("/get-favourite-genres", function(error, dataset){
    dataset.forEach(function(d){
        d.label = d.label;
        d.count = +d.count;
        d.percentage = +d.percentage;
    });
    var max = d3.max(dataset, function(d) { return d.percentage; });

    var svg = d3.select("#chart_genre").append("svg")
        .attr("width", width_genre)
        .attr("height", height_genre)
        .append("g")
        .attr("transform", "translate(" + width_genre / 2 + "," + height_genre / 2 + ")");

    var arc = d3.svg.arc()
            .outerRadius(radius)
            .innerRadius(0);

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
                    .style("left", event.layerX + "px")
                    .style("top", event.layerY + "px")
                    .style("display", "inline-block")
                    .html(d.data.label + "<br>" + d.data.count + " movies");
            })
            .on("mouseout", function () {
                tooltip_genre.style("display","none");
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