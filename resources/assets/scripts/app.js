;(function(){
  $('.confirm-action').click(function(e){
    e.preventDefault();
    bootbox.confirm('Are you sure that you want to do this?', function(response){
      if(response)
        window.location.href = e.target.href;
    });
    return false;
  });
  $('.has-datetime').datetimepicker({
    format: 'YYYY-MM-DD HH:mm:ss'
  });
  $('.has-date').datetimepicker({
    format: 'YYYY-MM-DD'
  });
  $('.has-time').datetimepicker({
    format: 'HH:mm:ss'
  });
}).call(this);

(function(){
  $(window).scroll(function () {
      var top = $(document).scrollTop();
      $('.splash').css({
        'background-position': '0px -'+(top/3).toFixed(2)+'px'
      });
      if(top > 50)
        $('#home > .navbar').removeClass('navbar-transparent');
      else
        $('#home > .navbar').addClass('navbar-transparent');
  });

  $("a[href='#']").click(function(e) {
    e.preventDefault();
  });

  var $button = $("<div id='source-button' class='btn btn-primary btn-xs'>&lt; &gt;</div>").click(function(){
    var html = $(this).parent().html();
    html = cleanSource(html);
    $("#source-modal pre").text(html);
    $("#source-modal").modal();
  });

  $('.bs-component [data-toggle="popover"]').popover();
  $('.bs-component [data-toggle="tooltip"]').tooltip();

  $(".bs-component").hover(function(){
    $(this).append($button);
    $button.show();
  }, function(){
    $button.hide();
  });

  function cleanSource(html) {
    html = html.replace(/×/g, "&times;")
               .replace(/«/g, "&laquo;")
               .replace(/»/g, "&raquo;")
               .replace(/←/g, "&larr;")
               .replace(/→/g, "&rarr;");

    var lines = html.split(/\n/);

    lines.shift();
    lines.splice(-1, 1);

    var indentSize = lines[0].length - lines[0].trim().length,
        re = new RegExp(" {" + indentSize + "}");

    lines = lines.map(function(line){
      if (line.match(re)) {
        line = line.substring(indentSize);
      }

      return line;
    });

    lines = lines.join("\n");

    return lines;
  }

})();

    L.Icon.Default.imagePath = '/build/assets/images';



$.getJSON("http://localhost/polu.php", function( data ) {

  var map = L.map('map').setView([-40.8338289, -73.2470153], 7);

  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);




    function onEachFeature(feature, layer) {


    var lista = '<div style="width: 300px"><h5>Ultimos registros</h5>'
                 +'<ul class="list-group">'
                  +'<li class="list-group-item">MP menor a 10µm <span class="pull-right">1094 pcs/283ml</span></li>'
                  +'<li class="list-group-item">Temperatura <span class="pull-right">21 °C</span></li>'
                  +'<li class="list-group-item">Humedad relativa <span class="pull-right">34 %HR</span></li>'
                  +'<li class="list-group-item">Dioxido de carbono (CO2) <span class="pull-right">567 ppm</span></li>'
                  +'<li class="list-group-item">Monoxido de Carbono (CO) <span class="pull-right">678 ppm</span></li>'
                  +'<li class="list-group-item">Ozono (O3) <span class="pull-right">4567 ppb</span></li>'
                +'</ul>'
                  +'<a href="#" class="btn btn-info btn-sm btn-block" style="color:#fff">Más información</a>'
               +'</div>';

      var popupContent = "<p>I started out as a GeoJSON " +
          feature.geometry.type + ", but now I'm a Leaflet vector!</p>";

      if (feature.properties && feature.properties.popupContent) {
        popupContent += feature.properties.popupContent;
      }

      layer.bindPopup(lista);
    }

    L.geoJson([data], {
      style: function (feature) {
        return feature.properties && feature.properties.style;
      },
      onEachFeature: onEachFeature,
      pointToLayer: function (feature, latlng) {
        return L.circleMarker(latlng, {
          radius: 8,
          fillColor: "#ff7800",
          color: "#000",
          weight: 1,
          opacity: 1,
          fillOpacity: 0.8
        });
      }
    }).addTo(map);

});





