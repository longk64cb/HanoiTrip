var survey_options = document.getElementById('survey_options');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields = document.getElementById('remove_fields');
var add_item = document.getElementsByClassName('add_more_items');
var remove_item = document.getElementsByClassName('remove_items');
var items = document.getElementsByClassName('items');
var remove_place = document.getElementsByClassName('remove-place');

// DROP AND DRAG FILE
const initApp = () => {
    const droparea = document.querySelector('.droparea');

    const active = () => droparea.classList.add("green-border");

    const inactive = () => droparea.classList.remove("green-border");

    const prevents = (e) => e.preventDefault();

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evtName => {
        droparea.addEventListener(evtName, prevents);
    });

    ['dragenter', 'dragover'].forEach(evtName => {
        droparea.addEventListener(evtName, active);
    });

    ['dragleave', 'drop'].forEach(evtName => {
        droparea.addEventListener(evtName, inactive);
    });

    droparea.addEventListener("drop", handleDrop);

}

document.addEventListener("DOMContentLoaded", initApp);

const handleDrop = (e) => {
    const dt = e.dataTransfer;
    const files = dt.files;
    const fileArray = [...files];
    console.log(files); // FileList
    console.log(fileArray);
}

//MỞ FILE
function getFile(){
	var fileReader = new FileReader()
	
}

add_more_fields.onclick = function(){
    var i = document.getElementsByClassName('title').length;
	// var newField = document.createElement('input');
	// newField.setAttribute('type','text');
	// newField.setAttribute('name','survey_options[]');
	// newField.setAttribute('class','title');
	// newField.setAttribute('siz',50);
	// newField.setAttribute('placeholder','Tên địa điểm'); 
	// survey_options.appendChild(newField);

	// var newPlace = document.createElement("button");
	// newPlace.setAttribute('type', 'button');
	// newPlace.setAttribute('id', `btn${i}`);
  //   newPlace.setAttribute('class', "btn btn-primary");
  //   newPlace.setAttribute("data-bs-toggle", "modal");
  //   newPlace.setAttribute("data-bs-target", `#modal${i}`);
	// newPlace.innerHTML = "Click me";
	// survey_options.appendChild(newPlace)
	// var node = document.createElement("HR"); 
	// survey_options.appendChild(node);

  survey_options.insertAdjacentHTML("beforeend", `
    <div class="place-form">
      <input type="text" name="survey_options[]" class="title" siz="50" placeholder="Tên địa điểm" />
      <button onclick="modalTitle(${i})" type="button" id="btn${i}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal${i}">Chỉnh sửa</button>
      <button type="button" class="btn btn-danger remove-place">Xóa địa điểm</button>
      <hr/>
    </div>
  `);
  remove_place = document.getElementsByClassName(`remove-place`);
  var place_form = document.getElementsByClassName(`place-form`);
  for (let j = 0; j < remove_place.length; j++) {
    remove_place[j].onclick = function() {
      // console.log("hello")
      place_form[j].remove();
    }
  }

  console.log(document.getElementsByClassName('title')[i].value);
    var modal = document.createElement("div");
    modal.setAttribute('class', "modal fade")
    modal.setAttribute('id', `modal${i}`);
    modal.setAttribute('tabindex', "-1");
    modal.setAttribute("aria-hidden", "true");
    modal.innerHTML = `<div class="modal-dialog"><div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">${document.getElementsByClassName('title')[i].value}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text"  id="title"  size="50" placeholder="Tiêu đề">
        <input type="text"  id="desc"  size="50" placeholder="Mô tả">
        <div class="items">
        
        </div>
        <div class="controls">
          <button  type="button" class="btn btn-success add_more_items"><i class="fa fa-plus"></i>Thêm item</button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>`;
    document.body.appendChild(modal);
    items = document.getElementsByClassName('items');
    add_item = document.getElementsByClassName('add_more_items');
    // console.log(add_item)
    for (let i = 0; i < add_item.length; i++) {
      add_item[i].onclick = function() {
        items = document.getElementsByClassName('items');
        items[i].insertAdjacentHTML("beforeend", `
          <div class="item-form-${i}">
          <input type="text" class="typeOfItem" siz="50" placeholder="Tilte"/>
          <input type="text" class="ID" siz="50" placeholder="ID (Nếu item gồm nhiều ID, ngăn cách các ID giữa các dấu phẩy)"/>
          <button type="button" class="btn btn-danger remove_items${i}"><i class="fa fa-plus"></i>Xóa item</button>
          <hr/>
          </div>`);
        remove_item = document.getElementsByClassName(`remove_items${i}`);
        var item_form = document.getElementsByClassName(`item-form-${i}`);
        for (let j = 0; j < remove_item.length; j++) {
          remove_item[j].onclick = function() {
            item_form[j].remove();
          }
        }
      }
    }
}

function modalTitle(i) {
  var title = document.getElementsByClassName('title')[i].value;
  document.getElementsByClassName("modal-title")[i].innerHTML = title;
}

remove_fields.onclick = function(){
	var input_tags = survey_options.getElementsByTagName('input');
	var l = input_tags.length;
	if(l > 2) {
		survey_options.removeChild(input_tags[l-1])
	}
	
}

function getData() {
	var type = document.getElementsByClassName('typeOfItem');
	var id = document.getElementsByClassName("ID");
	var title = document.getElementById("title").value;
	var desc = document.getElementById("desc").value;	

	var item = [];
	
    alert("Xác nhận tải xuống?");
    var trealet = "";
        trealetFooter = "\t\t]\n"
                        + "\t}\n"
                        + "}";
        trealetHeader = '{\n'
                        + "\t\"trealet\":{\n"
                        + "\t\t\"exec\":\"streamline\",\n" 
                        + "\t\t\"title\":" + '\"' + "Hanoi Trip" + "\",\n"
                        + "\t\t\"imgFront: 18690\""
                        + "\t\t\"desc\":" + '\"' + "Tìm hiểu về công trình kiến trúc lịch sử Hà Nội" + "\",\n"
                        + "\t\t\"places\": [\n";
		trealetItem = "";
		for (let i = 0; i < type.length; i++) {
			if (i == type.length - 1)
				if (id[i].value.includes(','))
					trealetItem += `\t\t\t\{\"title\":\"${type[i].value}\", \"value\":[${id[i].value}]\}\n`;
				else
				trealetItem += `\t\t\t\{\"title\":\"${type[i].value}\", \"value\":${id[i].value}\}\n`;
			else
				if (id[i].value.includes(','))
					trealetItem += `\t\t\t\{\"title\":\"${type[i]}\", \"value\":[${id[i].value}]\},\n`;
				else
				trealetItem += `\t\t\t\{\"title\":\"${type[i].value}\", \"value\":${id[i].value}\},\n`;
		}
		trealet = trealetHeader + trealetItem + trealetFooter;
		console.log(trealet);
        
    download('newFile.trealet', trealet);
}

// DOWNLOAD FILE TREALET MOI
function download(filename, text) {
    var element = document.createElement('a');
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
    element.setAttribute('download', filename);
  
    element.style.display = 'none';
    document.body.appendChild(element);
  
    element.click();
  
    document.body.removeChild(element);
  }

