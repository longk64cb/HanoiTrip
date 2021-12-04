var container = document.querySelector(".text");

var speeds = {
   pause: 500,
   slow: 120,
   normal: 70,
   fast: 40,
   superFast: 10
};

var textLines = [
   { speed: speeds.fast, string: "Chào mừng bạn đến với" },
   { speed: speeds.fast, string: "HanoiTrip", classes: ["green"] },
   { speed: speeds.pause, string: "!", pause: true },
   { speed: speeds.fast, string: "Điều khiển các nút mũi tên, WASD hoặc click chuột để di chuyển đến công trình kiến trúc lịch sử Hà Nội bạn muốn khám phá." }
];


var characters = [];
textLines.forEach((line, index) => {
   if (index < textLines.length - 1) {
      line.string += " ";
   }

   line.string.split("").forEach((character) => {
      var span = document.createElement("span");
      span.textContent = character;
      container.appendChild(span);
      characters.push({
         span: span,
         isSpace: character === " " && !line.pause,
         delayAfter: line.speed,
         classes: line.classes || []
      });
   });
});

function revealOneCharacter(list) {
   var next = list.splice(0, 1)[0];
   next.span.classList.add("revealed");
   next.classes.forEach((c) => {
      next.span.classList.add(c);
   });
   var delay = next.isSpace && !next.pause ? 0 : next.delayAfter;

   if (list.length > 0) {
      setTimeout(function () {
         revealOneCharacter(list);
      }, delay);
   }
}

setTimeout(() => {
   revealOneCharacter(characters);   
}, 600)

setTimeout(() => {
   container.style.visibility = "hidden";
}, 10000)


