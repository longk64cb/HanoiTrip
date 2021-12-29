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
function removeForm(id) {
    var el = document.getElementById(id)
    el.remove();
}

readTextFile("langchutich.trealet", function(text){
    var myData = JSON.parse(text);
    console.log(myData);

    for(let i = 0; i < myData.length; i++){
        var f = document.createElement("form");
        f.setAttribute('id', `${i}`);
        f.setAttribute('class', "quiz-form");

        // THÊM THẺ DIV 1 CHỨA TRƯỜNG CÂU HỎI
        var div1 = document.createElement("div");
        div1.setAttribute('class', "form-group");

        var input1 = document.createElement("input");
        input1.setAttribute('class', "form-control");
        input1.setAttribute('type', "text");
        input1.setAttribute('id', "exampleFormControlInput1");
        input1.setAttribute('placeholder', "Nhập câu hỏi");
        input1.setAttribute('value', myData[i].question)
        div1.append(input1);
        
        // THÊM THẺ DIV 2 CHỨA CÁC CÂU TRẢ LỜI

        var div2 = document.createElement("div");
        div2.setAttribute('class', "form-group");

        var a1 = document.createElement("input");
        a1.setAttribute('class', "form-control");
        a1.setAttribute('type', "text");
        a1.setAttribute('placeholder', "Đáp án A");
        a1.setAttribute('value', myData[i].choice1);

        var a2 = document.createElement("input");
        a2.setAttribute('class', "form-control");
        a2.setAttribute('type', "text");
        a2.setAttribute('placeholder', "Đáp án B");
        a2.setAttribute('value', myData[i].choice2);

        var a3 = document.createElement("input");
        a3.setAttribute('class', "form-control");
        a3.setAttribute('type', "text");
        a3.setAttribute('placeholder', "Đáp án B");
        a3.setAttribute('value', myData[i].choice3);

        var a4 = document.createElement("input");
        a4.setAttribute('class', "form-control");
        a4.setAttribute('type', "text");
        a4.setAttribute('placeholder', "Đáp án D");
        a4.setAttribute('value', myData[i].choice4);

        div2.append(a1);
        div2.append(a2);
        div2.append(a3);
        div2.append(a4);

        // THÊM THẺ DIV 3 CHỨA SELECTION ĐÁP ÁN ĐÚNG
        var div3 = document.createElement("div");
        div3.setAttribute('class', "form-group");

        var correct_answer = document.createElement("input");
        correct_answer.setAttribute('class', "form-control");
        correct_answer.setAttribute('type', "text");
        correct_answer.setAttribute('placeholder', "Đáp án D");
        correct_answer.setAttribute('value', myData[i].answer);
        div3.append(correct_answer);

        // THÊM NÚT XÓA
        var button = document.createElement("button");
        button.setAttribute('class', "btn btn-dark");
        button.setAttribute('type', "button");
        button.setAttribute('onclick', `removeForm(${i})`);
        button.append("Xóa câu hỏi")

        f.append(div1);
        f.append(div2);
        f.append(div3);
        f.append(button);

        document.getElementsByTagName('body')[0].appendChild(f);
    }

    
});


//-----THÊM FORM NHẬP------------------------------------
function generateForm() {

    var f = document.createElement("form");
    f.setAttribute('id', "quiz_form");
    f.setAttribute('class', "quiz-form");

    // THÊM THẺ DIV 1 CHỨA TRƯỜNG CÂU HỎI
    var div1 = document.createElement("div");
    div1.setAttribute('class', "form-group");
    var input1 = document.createElement("input");
    input1.setAttribute('class', "form-control");
    input1.setAttribute('type', "text");
    input1.setAttribute('id', "exampleFormControlInput1");
    input1.setAttribute('placeholder', "Nhập câu hỏi");
    div1.append(input1);

    // THÊM THẺ DIV 2 CHỨA CÁC CÂU TRẢ LỜI
    var div2 = document.createElement("div");
    div2.setAttribute('class', "form-group");

    var a1 = document.createElement("input");
    a1.setAttribute('class', "form-control");
    a1.setAttribute('type', "text");
    a1.setAttribute('placeholder', "Đáp án A");

    var a2 = document.createElement("input");
    a2.setAttribute('class', "form-control");
    a2.setAttribute('type', "text");
    a2.setAttribute('placeholder', "Đáp án B");

    var a3 = document.createElement("input");
    a3.setAttribute('class', "form-control");
    a3.setAttribute('type', "text");
    a3.setAttribute('placeholder', "Đáp án B");

    var a4 = document.createElement("input");
    a4.setAttribute('class', "form-control");
    a4.setAttribute('type', "text");
    a4.setAttribute('placeholder', "Đáp án D");


    div2.append(a1);
    div2.append(a2);
    div2.append(a3);
    div2.append(a4);

    // THÊM THẺ DIV 3 CHỨA SELECTION ĐÁP ÁN ĐÚNG
    var div3 = document.createElement("div");
    div3.setAttribute('class', "form-group");

    var correct_answer = document.createElement("select");
    correct_answer.setAttribute('class', "form-control");
    correct_answer.setAttribute('id', "exampleFormControlSelect1");

    var a = document.createElement("option");
    a.append("A");
    var b = document.createElement("option");
    b.append("B");
    var c = document.createElement("option");
    c.append("C");
    var d = document.createElement("option");
    d.append("D");

    // THÊM NÚT XÓA
    var button = document.createElement("button");
    button.setAttribute('class', "btn btn-dark");
    button.setAttribute('type', "button");
    button.setAttribute('onclick', `removeNewForm()`);
    button.append("Xóa câu hỏi")


    correct_answer.append(a);
    correct_answer.append(b);
    correct_answer.append(c);
    correct_answer.append(d);

    div3.append(correct_answer);

    f.append(div1);
    f.append(div2);
    f.append(div3);
    f.append(button);

    document.getElementsByTagName('body')[0].appendChild(f);

}

function removeNewForm() {
    var el = document.getElementById('quiz_form')
    el.remove();
}


