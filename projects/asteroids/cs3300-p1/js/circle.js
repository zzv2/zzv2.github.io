
d3.json("data.json", function(error, data) {
	if (error) {
    console.log(error);
  }

var width = 700,
  height = 700,
  radius = Math.min(width, height) / 2 - 80;

var r = d3.scale.linear()
  .domain([0, 1])
  .range([0, radius]);

var line = d3.svg.line.radial()
  .radius(function(d) {
    return r(d[1]);
  })
  .angle(function(d) {
    return -d[0] + Math.PI / 2;
  });

var svg = d3.select("#graph1output").append("svg")
  .attr("width", width)
  .attr("height", height)
  .append("g")
  .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

var gr = svg.append("g")
  .attr("class", "r axis")
  .selectAll("g")
  .data(r.ticks(3).slice(1))
  .enter().append("g");

gr.append("circle")
  .attr("r", r);

var ga = svg.append("g")
  .attr("class", "a axis")
  .selectAll("g")
  .data(d3.range(0, 360, 30))
  .enter().append("g")
  .attr("transform", function(d) {
    return "rotate(" + -d + ")";
  });

ga.append("line")
  .attr("x2", radius);

ga.append("text")
  .attr("x", radius + 20)
  .attr("dy", ".35em")
  .style("text-anchor", function(d) { return d < 270 && d > 90 ? "end" : null; })
  .attr("transform", function(d) { return d < 270 && d > 90 ? "rotate(180 " + (radius + 20) + ",0)" : null; })
  .text(function(d) {
    var months = {0:"January", 30:"February", 60:"March", 90:"April", 120:"May", 150:"June",
                  180:"July", 210:"August", 240:"September", 270:"October", 300:"November", 330:"Decemeber"};
    return months[d]
  });

var radiusScale = d3.scale.linear()
          .domain([100, 1500])
          .range([5, 15]);

var pointScale = d3.scale.linear()
          .domain([6000000, 35000000])
          .range([0, 1]);

var line = d3.svg.line.radial()
  .radius(function(d) {
    return r(d[1]);
  })
  .angle(function(d) {
    return -d[0] + Math.PI / 2;
  });

var circleData = [];
var distanceData = [];
for (var i=0; i<data.length; i++) {
  var month = data[i],
      monthName = Object.keys(data[i])[0];
  if (monthName=="january") {
    for (var k in month[monthName]) {
      var minDiameter = month[monthName][k]["diameter"]["estimated_diameter_min"],
          maxDiameter = month[monthName][k]["diameter"]["estimated_diameter_max"],
          diameter = (minDiameter+maxDiameter)/2,
          missDistance = month[monthName][k]["miss_distance"],
          velocity = month[monthName][k]["velocity"],
          radius,
          point = [0, pointScale(missDistance)];
      distanceData.push(missDistance);
          circleData.push({"r": radius, "point": point, "diameter": diameter, "velocity": velocity});
    }
  }
  if (monthName=="february") {
    for (var k in month[monthName]) {
      var minDiameter = month[monthName][k]["diameter"]["estimated_diameter_min"],
          maxDiameter = month[monthName][k]["diameter"]["estimated_diameter_max"],
          diameter = (minDiameter+maxDiameter)/2,
          missDistance = month[monthName][k]["miss_distance"],
          velocity = month[monthName][k]["velocity"],
          radius,
          point = [Math.PI/6, pointScale(missDistance)];
      distanceData.push(missDistance);
          circleData.push({"r": radius, "point": point, "diameter": diameter, "velocity": velocity});
    }
  }
}

var max_distance = Math.max.apply(Math, distanceData),
    min_distance = Math.min.apply(Math, distanceData);

console.log("max:" + max_distance);

  var colorScale = d3.scale.linear()
                .domain([1000, 22000])
                .range(["#FFCCCF", "#FF434E"]);

  svg.selectAll("point")
    .data(circleData)
    .enter()
    .append("circle")
    .attr("class", "point")
    .attr("transform", function(d) {
      console.log(d.point);
      var coors = line([d.point]).slice(1).slice(0, -1);
      return "translate(" + coors + ")"
    })
    .attr( 'r', function(d) { return radiusScale(d.diameter) })
    .attr("fill", function(d) { return d?colorScale(d.velocity):"lightgray"})
});
