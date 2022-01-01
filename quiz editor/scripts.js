var add_form = document.getElementById("getForm");
var places = document.getElementsByClassName("places");
var loadButton = document.getElementById("load-file-button");
var fileInput = document.getElementById("file-load");
var fileName = document.getElementsByClassName("file-name").value;
var quizArr = [];
var quizTrealet =
{
  "question": "",
  "choice1": "",
  "choice2": "",
  "choice3": "",
  "choice4": "",
  "answer": ""
};

loadButton.onclick = function () {
  if (fileInput.files[0].name.split(".")[1] != "trealet") {
    alert("Yêu cầu upload file trealet!");
  } else {
    const reader = new FileReader();
    reader.onload = function (fileLoadedEvent) {
      var myData = JSON.parse(reader.result);
      initTrealet = myData;
      for (let i = 0; i < myData.length; i++) {
        places[0].insertAdjacentHTML("beforeend", `
        <form class="quiz_form">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Câu hỏi</label>
              <input type="text" class="form-control question" placeholder="Nhập câu hỏi" value="${myData[i].question}">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Đáp án</label>
              <input class="form-control answerA" type="text" placeholder="Đáp án A" value="${myData[i].choice1}">
              <input class="form-control answerB" type="text"  placeholder="Đáp án B" value="${myData[i].choice2}">
              <input class="form-control answerC" type="text" placeholder="Đáp án C" value="${myData[i].choice3}">
              <input class="form-control answerD" type="text" placeholder="Đáp án D" value="${myData[i].choice4}">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Đáp án đúng</label>
              <select class="form-control correct">
                <option value="none" selected disabled hidden> Chọn đáp án đúng</option>
                <option>A</option>
                <option>B</option>
                <option>C</option>
                <option>D</option>
              </select>
            </div>
            <button type="button" onclick=removeParent(this) class="btn btn-danger"><i class="bi bi-trash"></i></button>
            <hr/>
          </form>
          
      `);
      }
    };
    reader.readAsText(fileInput.files[0]);
  }
};

//-----THÊM FORM NHẬP-----------------------------------
var add_count = 0;
add_form.onclick = function () {
  places[0].insertAdjacentHTML("beforeend", `
    <form class="quiz_form">
    <div class="form-group">
      <label for="exampleFormControlSelect1">Câu hỏi</label>
      <input type="text" class="form-control question" placeholder="Nhập câu hỏi">
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Đáp án</label>
      <input class="form-control answerA" type="text" placeholder="Đáp án A">
      <input class="form-control answerB" type="text"  placeholder="Đáp án B" >
      <input class="form-control answerC" type="text" placeholder="Đáp án C" >
      <input class="form-control answerD" type="text" placeholder="Đáp án D">
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Đáp án đúng</label>
      <select class="form-control correct" id="exampleFormControlSelect1">
        <option value="none" selected disabled hidden> Chọn đáp án đúng</option>
        <option>A</option>
        <option>B</option>
        <option>C</option>
        <option>D</option>
      </select>
    </div>
    <button type="button" onclick=removeParent(this) class="btn btn-danger"><i class="bi bi-trash"></i></button>
    <hr/>
  </form>
 
  `);
}

// -------LẤY DỮ LIỆU TỪ FORM----------------------------
function getData() {
  var count = document.getElementsByClassName('question').length;
  for (let i = 0; i < count; i++) {
    quizTrealet.question = document.getElementsByClassName('question')[i].value;
    quizTrealet.choice1 = document.getElementsByClassName('answerA')[i].value;
    quizTrealet.choice2 = document.getElementsByClassName('answerB')[i].value;
    quizTrealet.choice3 = document.getElementsByClassName('answerC')[i].value;
    quizTrealet.choice4 = document.getElementsByClassName('answerD')[i].value;
    switch(document.getElementsByClassName('correct')[i].value){
      case 'A':
        quizTrealet.answer = 1;
        break;
      case 'B':
        quizTrealet.answer = 2;
        break;
      case 'C':
        quizTrealet.answer = 3;
        break;
      case 'D':
        quizTrealet.answer = 4;
        break;
    }
    const quiz_object = Object.assign({}, quizTrealet);
    quizArr.push(quiz_object);
  }
  var name = fileName + '.trealet';
  download(name, JSON.stringify(quizArr, null, 2));
  places = 0;
}

const removeParent = function (button) {
  button.parentNode.remove();
  console.log(countForm());
}

function download(filename, text) {
  var element = document.createElement('a');
  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
  element.setAttribute('download', filename);

  element.style.display = 'none';
  document.body.appendChild(element);

  element.click();

  document.body.removeChild(element);
}