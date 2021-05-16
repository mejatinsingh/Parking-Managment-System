function a (e)
{
  var coord = e.latlng;
  var lat = coord.lat;
  var lng = coord.lng;
  console.log("You clicked the map at latitude: " + lat + " and longitude: " + lng);
  var city=document.querySelector('#cityId');
  console.log("selected city= "+city.value);
  console.log("hii");
};

function addarea()
{
  console.log("dxg");
  var areas=["Phoenix market city","Lalbagh","Gopalan Arcade"];
  var text=document.getElementById("cityId").value;
  if(text.localeCompare("Bangalore")==0)
  {
    var ar =document.getElementById("areaId");
    for (var i = 0; i < areas.length; i++)
    {
      var optn = areas[i];
      var el = document.createElement("option");
      el.textContent = optn;
      el.value = optn;
      ar.appendChild(el);
    }
  }
  else {
    alert("No Service Available in This Area. Sorry for Inconvience!!");
  }
}

function navigate()
{
  var datalayer;
  var myStyle = { "color": "white"};
  var a =document.getElementById("areaId").value;
  if(a.localeCompare("Lalbagh")==0)
  {
    $.getJSON("../js/cord.geojson",function(data)
    {
    datalayer = L.geoJson(data ,{
      style:myStyle,
    onEachFeature: function(feature, featureLayer) {
    slot=featureLayer.bindPopup('<a href="reservation.html" target="_blank">Confirm Slot No </a>' + feature.properties.No);
    }
    }).addTo(mymap);
    mymap.fitBounds(datalayer.getBounds());

  });
  }
  else {
        mymap.removeLayer(datalayer);
        alert("No Slots Empty in this Area. Sorry for Inconvience!!");
      }
}
