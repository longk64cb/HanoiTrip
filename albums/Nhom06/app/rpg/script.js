var character = document.querySelector(".character");
var map = document.querySelector(".map");
var places = document.querySelectorAll(".place");
var text = document.querySelector(".text");
var popOver = document.querySelector(".popover-content")
var destinationInfo = document.getElementById("destinationInfo");
var infoButton = document.getElementById("infoButton");
// var shadow = document.querySelector(".shadow");

var x = 185;
var y = 56;
var held_directions = [];
var speed = 1;
var destination = {
   x: x,
   y: y
}

var pixelSize = parseInt(
   getComputedStyle(document.documentElement).getPropertyValue('--pixel-size')
);

var gridCell = pixelSize * 16;

map.onclick = function clickEvent(e) {
   var rect = e.currentTarget.getBoundingClientRect();
   var xDes = e.clientX - rect.left;
   destination.x = Math.round(xDes / pixelSize -16);
   var yDes = e.clientY - rect.top;
   destination.y = Math.round(yDes / pixelSize -28);
   console.log("Left? : " + destination.x + " ; Top? : " + destination.y + ".");
      console.log("Left? : " + x + " ; Top? : " + y + ".");
 }

const placeCharacter = () => {
   
   const held_direction = held_directions[0];
   if (held_direction) {
      if (held_direction === directions.right) {x += speed;}
      if (held_direction === directions.left) {x -= speed;}
      if (held_direction === directions.down) {y += speed;}
      if (held_direction === directions.up) {y -= speed;}
      character.setAttribute("facing", held_direction);
   }
   character.setAttribute("walking", held_direction ? "true" : "false");
   
   var leftLimit = -8;
   var rightLimit = (16 * 23)+8;
   var topLimit = -8 + 32;
   var bottomLimit = (16 * 25);
   if (x < leftLimit) { x = leftLimit; destination.x = x}
   if (x > rightLimit) { x = rightLimit; destination.x = x}
   if (y < topLimit) { y = topLimit; destination.y = y}
   if (y > bottomLimit) { y = bottomLimit; destination.y = y}
   
   
   var camera_left = pixelSize * 210;
   var camera_top = pixelSize * 65;
   
   map.style.transform = `translate3d( ${-x*pixelSize+camera_left}px, ${-y*pixelSize+camera_top}px, 0 )`;
   character.style.transform = `translate3d( ${x*pixelSize}px, ${y*pixelSize}px, 0 )`; 
   text.style.transform = `translate3d( ${(x-110)*pixelSize}px, ${(y-60)*pixelSize}px, 0 )`; 
   popOver.style.transform = `translate3d( ${(x-24)*pixelSize}px, ${(y-37)*pixelSize}px, 0 )`; 

   places.forEach((place) => {
      let title = place.getAttribute("title");
       let xCor = place.getAttribute("x");
       let yCor = place.getAttribute("y");
       place.style.transform = `translate3d( ${xCor*gridCell+1}px, ${yCor*gridCell+1}px, 0 )`;
       let rect1 = character.getBoundingClientRect();
       let rect2 = place.getBoundingClientRect();
       var overlap = !(rect1.right - 28 < rect2.left || 
        rect1.left + 28 > rect2.right || 
        rect1.bottom < rect2.top || 
        rect1.top + 80 > rect2.bottom)
       if (overlap) {
          if(!place.classList.contains("placeHover") && !character.classList.contains("characterHover")) {
            place.classList.add("placeHover");
            destinationInfo.innerHTML = title;
            character.setAttribute("position", title);
            infoButton.setAttribute("name", place.getAttribute("id"));
            character.classList.add("characterHover");
          }
       } else {
           place.classList.remove("placeHover");
           if (character.getAttribute("position") == title) {
            character.classList.remove("characterHover");
           }
       }
   })
}

const destinationMove = () => {
   if (destination.x == x && destination.y == y) {
         return 0;
   }
//    if (destination.x == null && destination.y == null) {
//          held_directions = [];
//          return 0;
//    }
   if (destination.y != null) {
      if (y > destination.y) {
         held_directions.unshift("up");
      } else if (y < destination.y) {
         held_directions.unshift("down");
      } else {
         held_directions = [];
         destination.y = null;
      }
   }
   if (destination.x != null) {
      if (x > destination.x) {
         held_directions.unshift("left");
      } else if (x < destination.x) {
         held_directions.unshift("right");
      } else {
         held_directions = [];
         destination.x = null;
      }
   }
}


const step = () => {
   destinationMove();
   placeCharacter();
   window.requestAnimationFrame(() => {
      step();
   })
}
step();

const directions = {
   up: "up",
   down: "down",
   left: "left",
   right: "right",
}
const keys = {
   38: directions.up,
   37: directions.left,
   39: directions.right,
   40: directions.down,
   65: directions.left,
   87: directions.up,
   68: directions.right,
   83: directions.down
}
document.addEventListener("keydown", (e) => {
   var dir = keys[e.which];
   if (dir && held_directions.indexOf(dir) === -1) {
      held_directions.unshift(dir)
   }
})

document.addEventListener("keyup", (e) => {
   var dir = keys[e.which];
   var index = held_directions.indexOf(dir);
   if (index > -1) {
      held_directions.splice(index, 1)
   }
});