var data = d3.range(0, 2 * Math.PI, 0.01).map(function(t) {
  return [t, Math.sin(2 * t) * Math.cos(2 * t)];
});

var width = 700,
    height = 700,
    radius = Math.min(width, height) / 2 - 80;

var r = d3.scale.linear()
    .domain([0, 0.5])
    .range([0, radius]);

var line = d3.svg.line.radial()
    .radius(function(d) { return r(d[1]); })
    .angle(function(d) { return -d[0] + Math.PI / 2; });

var svg = d3.select("#graph1output").append("svg")
    .attr("width", width)
    .attr("height", height)
  .append("g")
    .attr("transform", "translate(" + (width) / 2 + "," + (height) / 2 + ")");

var gr = svg.append("g")
    .attr("class", "r axis")
  .selectAll("g")
    .data(r.ticks(5).slice(1)) //ticks(#): changes number of dotted rings circle has
  .enter().append("g");

//creates circle for graph
gr.append("circle")
    .attr("r", r);

//places text for data points
gr.append("text")
    .attr("y", function(d) { return -r(d) - 4; }) //positions text along radius
    .attr("transform", "rotate(15)") //rotates text # degrees from 0 (line pointing straight up)
    .style("text-anchor", "middle")
    .text(function(d) { return d; }); //returns the text values/data

//sets up group for radial lines and outter text labels to be appended to later
var ga = svg.append("g")
    .attr("class", "a axis")
  .selectAll("g")
    .data(d3.range(0, 360, 30))
  .enter().append("g")
    .attr("transform", function(d) { return "rotate(" + -d + ")"; });

//creates radial lines (lines along radius)
ga.append("line")
    .attr("x2", radius);

//places text on outside of circle
ga.append("text")
    .attr("x", radius + 20) //some padding for the labeled degrees on outside of circle
    .attr("dy", ".35em")
    .style("text-anchor", function(d) { return d < 270 && d > 90 ? "end" : null; })
    .attr("transform", function(d) { return d < 270 && d > 90 ? "rotate(180 " + (radius + 20) + ",0)" : null; })
    .text(function(d) {
      var months = {0:"January", 30:"February", 60:"March", 90:"April", 120:"May", 150:"June",
                    180:"July", 210:"August", 240:"September", 270:"October", 300:"November", 330:"Decemeber"};
      return months[d]
    });

//draws data (red lines)
// svg.append("path")
//     .datum(data)
//     .attr("class", "line")
//     .attr("d", line);
