@extends('Profile/index')
@section('data')
<section class="section-padding info">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center wow fadeInUp">
                    <h3 class="title">Stats</h3>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp stats">
            <div class="col-xs-12 col-sm-3">
                <div class="price-box">
                    <div class="price-header">
                        <div class="price-icon">
                            <span>{{$user_data->total}}</span>
                        </div>
                        <h4>times watched</h4>
                    </div>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="price-box">
                    <div class="price-header">
                        <div class="price-icon">
                            <span>{{$user_data->movies}}</span>
                        </div>
                        <h4>movies watched</h4>
                    </div>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="price-box">
                    <div class="price-header">
                        <div class="price-icon">
                            <span>{{$user_data->average}}</span>
                        </div>
                        <h4>average rating</h4>
                    </div>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="price-box">
                    <div class="price-header">
                        <div class="price-icon">
                            <span>{{$user_data->reviews}}</span>
                        </div>
                        <h4>reviews given</h4>
                    </div>
                </div>
                <div class="space-30 hidden visible-xs"></div>
            </div>
        </div>
    </div>
</section>
<section class="section-padding info">
    <div class="container">
        <div class="row">
            <div class="col-xs-12" id="div_history">
                <div class="page-title text-center">
                    <h4 class="title">activity for the past 30 days</h4>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="wow fadeInUp" id="chart_month"></div>
        </div>
    </div>
</section>
<section class="section-padding info">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title text-center">
                    <h4 class="title">Most Watched Movies</h4>
                    <!-- <div class="space-60"></div> -->
                </div>
            </div>
        </div>
        @if(isset($mosts[0]))
        <div class="row">
            <div class="col-xs-6">
                <figure class="mobile-image wow fadeInUp" data-wow-delay="0.2s">
                    <img id="backdrop" src="https://image.tmdb.org/t/p/original{{$mosts[0]->movie()->backdrop_path}}" alt="">
                </figure>
            </div>
            <div class="col-xs-6">
                <table class="table allcp-form theme-warning tc-checkbox-1 fs13 wow fadeInUp">
                    <tbody>
                        @foreach($mosts as $data)
                        <tr class="most_watched" id="{{$data->movie()->backdrop_path}}">
                            <td><a href="/movie/{{$data->movieId}}">{{$data->movie()->title}}</a></td>
                            <td>{{$data->total}} times</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @else
        <div class="row">
            <center>
                <h4 class="wow fadeInUp" data-wow-delay="0.4s">Haven't watched anything</h4>
            </center>
        </div>
        @endif
    </div>
</section>
<section class="section-padding info">
    <div class="container">
        <div class="col-xs-6" id="div_genre">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title text-center">
                        <h4 class="title">favourite genres</h4>
                        <!-- <div class="space-60"></div> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <center>
                    <div class="wow fadeInUp" id="chart_genre"></div>
                </center>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title text-center">
                        <h4 class="title">best movies</h4>
                    </div>
                </div>
                <div class="row">
                    @foreach($rating_top as $data)
                    <div class="col-xs-6 col-sm-4 poster-list">
                        <div class="item wow fadeInUp" id="top_rated">
                            <a href="/movie/{{$data->movieId}}">
                                <img src="@if(@file_get_contents('https://image.tmdb.org/t/p/w185_and_h278_bestv2'.$data->movie()->poster_path) === false) {{ URL::to('/') }}/images/poster.jpg @else https://image.tmdb.org/t/p/w185_and_h278_bestv2{{$data->movie()->poster_path}} @endif" alt="">
                                <div class="overlay">
                                    <div class="text">
                                        {{$data->movie()->title}}<br>
                                        <span class="review-rating"> {{$data->rating}}
                                            <span class="icon">★</span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    var parentDiv = document.getElementById("div_history");
    //define margin
    var margin = {top:20, right:80, bottom:100, left:80},
      width = parentDiv.clientWidth - margin.left - margin.right,
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
    d3.json("/get-activity/{!! json_encode($user->id) !!}", function(error, data){
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
                  "dy" : "1em",
                  "x" : "15px"
                })
                .style({
                  "text-anchor" : "center",
                });
      //==============
    });
    //==============
</script>
<script type="text/javascript">
    var parentDiv_genre = document.getElementById("div_genre");
    var width_genre = parentDiv_genre.clientWidth;
    var height_genre = 3/5*parentDiv_genre.clientWidth;
    var radius = 150;
    var color = d3.scale.linear()
      .domain([0, 1])
      .range(["#F4998D","#9C0000"]);

    var tooltip_genre = d3.select("#chart_genre").append("div").attr("class", "toolTip");

    d3.json("/get-favourite-genres/{!! json_encode($user->id) !!}", function(error, dataset){
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
</script>
@endsection
@push('scripts')
<script type="text/javascript">
    $(function() {
        $("#user_name").addClass("active");
    });
    $('.most_watched').mouseover(function() {
        // alert( this.id );
        document.getElementById("backdrop").src="https://image.tmdb.org/t/p/original"+this.id;
    });
</script>
@endpush