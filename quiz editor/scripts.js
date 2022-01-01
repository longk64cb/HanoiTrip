var add_form = document.getElementById("getForm")
var places = document.getElementsByClassName("places")
var quizArr = []

var quizTrealet = 
{
    "question":"",
    "choice1": "",
    "choice2": "",
    "choice3": "",
    "choice4": "",
    "answer" :1
}

function readTextFile(file, callback) {
    var rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function() {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}

// HÀM XÓA FORM---------------------------------------------------------
// function removeForm(id) {
//     var el = document.getElementById(id)
//     el.remove();
// }



readTextFile("langchutich.trealet", function(text){
    var myData = JSON.parse(text);
    console.log(myData.length);
    // var count_form_after_fetch = countForm();
    // console.log(count_form_after_fetch);
    for(let i = 0; i < myData.length; i++){
        places[0].insertAdjacentHTML("beforeend", `
        <form class="quiz_form">
            <div class="form-group">
              <input type="text" class="form-control" id="question${i}"  placeholder="Nhập câu hỏi" value="${myData[i].question}">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" class="answer" placeholder="Đáp án A" id="a${i}" value="${myData[i].choice1}">
              <input class="form-control" type="text" class="answer" placeholder="Đáp án B" id="b${i}" value="${myData[i].choice2}">
              <input class="form-control" type="text" class="answer" placeholder="Đáp án C" id="c${i}" value="${myData[i].choice3}">
              <input class="form-control" type="text" class="answer" placeholder="Đáp án D" id="d${i}" value="${myData[i].choice4}">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" class="correct" placeholder="Đáp án đúng" id="answer${i}" value="${myData[i].answer}">
            </div>
            <button type="button" class="btn btn-dark" onclick="removeParent(this)">Xóa câu hỏi</button>
          </form>
      `);
    }
});




//-----THÊM FORM NHẬP------------------------------------
var add_count = 0;
add_form.onclick =  function() {
  add_count = countForm();
  console.log(add_count);
    places[0].insertAdjacentHTML("beforeend", `
    <form class="quiz_form">
        <div class="form-group">
          <input type="text" class="form-control"  placeholder="Nhập câu hỏi" id="question${add_count}">
        </div>
        <div class="form-group">
          <input class="form-control" type="text" class="answer" placeholder="Đáp án A" id="a${add_count}">
          <input class="form-control" type="text" class="answer" placeholder="Đáp án B" id="b${add_count}">
          <input class="form-control" type="text" class="answer" placeholder="Đáp án C" id="c${add_count}">
          <input class="form-control" type="text" class="answer" placeholder="Đáp án D" id="d${add_count}">
        </div>
        <div class="form-group">
        <input class="form-control" type="text" class="correct" placeholder="Đáp án đúng" id="answer${add_count}">
        </div>
        <button type="button" class="btn btn-dark" onclick="removeParent(this)">Xóa câu hỏi</button>
      </form>
  `);
}

function countForm () {
  var number_of_form = document.querySelectorAll('form').length;
  return number_of_form;
}


// -------LẤY DỮ LIỆU TỪ FORM----------------------------
function getData (){
  var count = countForm();
  console.log(count);
  for (let i = 0; i < count; i++) {
    quizTrealet.question = document.getElementById(`question${i}`).value;
    quizTrealet.choice1 = document.getElementById(`a${i}`).value;
    quizTrealet.choice2 = document.getElementById(`b${i}`).value;
    quizTrealet.choice3 = document.getElementById(`c${i}`).value;
    quizTrealet.choice4 = document.getElementById(`d${i}`).value;
    quizTrealet.answer = document.getElementById(`answer${i}`).value;
    console.log(quizTrealet);
  }
}


const removeParent = function(button) {
  button.parentNode.remove();
  console.log(countForm());
  // console.log("h")
}
