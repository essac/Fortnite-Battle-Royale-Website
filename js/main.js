//Custom Map
var map = L.map('image-map', {
  minZoom: 1,
  maxZoom: 4,
  center: [-160, 142],
  zoom: 1.6,
  crs: L.CRS.Simple,
  attributionControl: false,
  doubleClickZoom: false,
  dragging: !L.Browser.mobile,
  touchZoom: true,
  scrollWheelZoom: false,
  bounceAtZoomLimits: true,
  keyboard: true,
});

var w = 2300,
  h = 2300,
  url = './img/fortnitemap.jpg';
// calculate the edges of the image, in coordinate space
var southWest = map.unproject([0, h], map.getMaxZoom() - 1);
var northEast = map.unproject([w, 0], map.getMaxZoom() - 1);
var bounds = new L.LatLngBounds(southWest, northEast);

//Add Map Fullscreen Mode
map.addControl(new L.Control.Fullscreen({
  title: {
    'false': 'View Fullscreen',
    'true': 'Exit Fullscreen'
  }
}));

// add the image overlay, 
// so that it covers the entire map
L.imageOverlay(url, bounds).addTo(map);
// tell leaflet that the map is exactly as big as the image
map.setMaxBounds(bounds);
//map.fitBounds(bounds);

//Markers With Custom Icons
var fortbyte_icon = L.icon({
  iconUrl: './img/fortbyte-icon.png',
  iconSize: [35, 35], // size of the icon
  iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
  popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});
var weekly_icon = L.icon({
  iconUrl: './img/weekly-icon.png',
  iconSize: [35, 35], // size of the icon
  iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
  popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
});

//Popups With Events
var popup = L.popup();
function onMapClick(e) {
  popup
    .setLatLng(e.latlng)
    .setContent("You clicked the map at " + e.latlng.toString())
    .openOn(map);
}
map.on('click', onMapClick);

//Fortbyte fetch from .json
fetch('js/fortbytes.json')
  .then(function (response) {
    return response.json();
  })
  .then(function (myJson) {
    handleFortbytesFetch(myJson);
  });

//Weekly fetch from .json
fetch('js/weekly.json')
  .then(function (response) {
    return response.json();
  })
  .then(function (myJson) {
    handleWeeklyFetch(myJson);
  });

const bytes = [];
//Array Handle Weekly
const handleFortbytesFetch = (bytesArr) => {
  bytesArr.map(byte => {
    //Fortbye Markers
    var currentBytes = L.marker([byte.cordinates.x, byte.cordinates.y], { icon: fortbyte_icon }).bindPopup(byte.name + byte.descriptionText + byte.descriptionImage + byte.descriptionYoutube);
    bytes.push(currentBytes);
  });
}

const weeklya = [];
//Array Handle Weekly
const handleWeeklyFetch = (weeklyArr) => {
  weeklyArr.map(weekly => {
    //Weekly Markers
    var currentWeekly = L.marker([weekly.cordinates.x, weekly.cordinates.y], { icon: weekly_icon }).bindPopup(weekly.name + weekly.descriptionText + weekly.descriptionImage + weekly.descriptionYoutube);
    weeklya.push(currentWeekly);
  });

  //Layer Groups
  var lg_fortbytes = L.layerGroup(bytes).addTo(map);
  var lg_weekly = L.layerGroup(weeklya).addTo(map);

  var groupedOverlays = {
    "Featured Challanges": {
      "Fortbytes": lg_fortbytes
    },

    "Weekly Challanges": {
      "COMING SOON!": lg_weekly
    },
  };

  //Add Layer Control
  L.control.groupedLayers(null, groupedOverlays).addTo(map);
}