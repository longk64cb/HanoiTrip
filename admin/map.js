var canvas = document.querySelector("canvas");
var tilesetContainer = document.querySelector(".tileset-container");
var tilesetSelection = document.querySelector(".tileset-container_selection");
var tilesetImage = document.querySelector("#tileset-source");

var pixelSize = parseInt(
   getComputedStyle(document.documentElement).getPropertyValue('--pixel-size')
);

var gridCell = pixelSize * 10;

const ctx = canvas.getContext('2d');

const image = new Image(32* 25, 32*27);
image.onload = drawImageActualSize;

image.src = 'map.png';

var selection = [0, 0];

var isMouseDown = false;
var currentLayer = 0;
var layers = {};

tilesetContainer.addEventListener("mousedown", (event) => {
   selection = getCoords(event);
   tilesetSelection.style.left = selection[0] * 32 + "px";
   tilesetSelection.style.top = selection[1] * 32 + "px";
});

function addTile(mouseEvent) {
   var clicked = getCoords(event);
   var key = clicked[0] + "-" + clicked[1];

   if (mouseEvent.shiftKey) {
      delete layers[key];
   } else {
      layers[key] = [selection[0], selection[1]];
   }
   draw();
   drawPlace();
}

canvas.addEventListener("mousedown", () => {
   isMouseDown = true;
});
canvas.addEventListener("mouseup", () => {
   isMouseDown = false;
});
canvas.addEventListener("mouseleave", () => {
   isMouseDown = false;
});
canvas.addEventListener("mousedown", addTile);
canvas.addEventListener("mousemove", (event) => {
   if (isMouseDown) {
      addTile(event);
   }
});

function getCoords(e) {
   const { x, y } = e.target.getBoundingClientRect();
   const mouseX = e.clientX - x;
   const mouseY = e.clientY - y;
   return [Math.floor(mouseX / 32), Math.floor(mouseY / 32)];
}

function exportImage() {
   draw();
   var data = canvas.toDataURL();
   var image = new Image();
   image.src = data;
   trealet.trealet.map = data;
   trealet.trealet.map_canvas = layers;
   var w = window.open("");
   w.document.write(image.outerHTML);
   download("streamline.trealet", JSON.stringify(trealet, null, 2));
}

function clearCanvas() {
   layers = {};
   ctx.drawImage(image, 0, 0, image.width, image.height);
   draw();
   drawPlace();
}

function draw() {
   var ctx = canvas.getContext("2d");
   ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.drawImage(image, 0, 0, image.width, image.height);

   var size_of_crop = 32;
   
   Object.keys(layers).forEach((key) => {
      var positionX = Number(key.split("-")[0]);
      var positionY = Number(key.split("-")[1]);
      var [tilesheetX, tilesheetY] = layers[key];

      ctx.drawImage(
         tilesetImage,
         tilesheetX * 32,
         tilesheetY * 32,
         size_of_crop,
         size_of_crop,
         positionX * 32,
         positionY * 32,
         size_of_crop,
         size_of_crop
      );
   });
}

function back() {
   document.getElementById("tab2").style.display = "none";
   document.getElementById("tab1").style.display = "flex";
}

function drawPlace() {
   imgRPG.forEach(img => {
      ctx.drawImage(img.img, img.x * 32, img.y * 32, img.img.width, img.img.height);
   })
}

function drawImageActualSize() {
   canvas.width = this.width;
   canvas.height = this.height;
   ctx.imageSmoothingEnabled = false;
   draw();
   drawPlace();
 }
tilesetImage.src = "https://assets.codepen.io/21542/TileEditorSpritesheet.2x_2.png";


