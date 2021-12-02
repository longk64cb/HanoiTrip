var survey_options = document.getElementById('survey_options');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields = document.getElementById('remove_fields');
var add_item = document.getElementsByClassName('add_more_items');
var remove_item = document.getElementsByClassName('remove_items');
var items = document.getElementsByClassName('items');
var remove_place = document.getElementsByClassName('remove-place');
var places = document.getElementsByClassName("place")[0];
var loadButton = document.getElementById("load-file-button");
var fileInput = document.getElementById("file-load");

var initTrealet = {};
var imgRPG = [];
var place_map = [];

var trealet = {
  "trealet": {
    "exec": "streamline",
    "title": "",
    "imgFront": null,
    "desc": "",
    "places": [],
    "map": "",
    "map_canvas": {}
  }
}

var place = {
  "title": "",
  "x" : null,
  "y" : null,
  "imgRPG": null,
  "desc": "",
  "items": []
}

var item = {
  "title": "",
  "value": null
}

loadButton.onclick = function() {
  if (fileInput.files[0].name.split(".")[1] != "trealet") {
    alert("Yêu cầu upload file trealet!");
  } else {
    const reader = new FileReader();
    reader.onload = function(fileLoadedEvent){
      var fileContent = JSON.parse(reader.result);
      console.log(fileContent);
      initTrealet = fileContent;
      buildFromFile();
    };
    reader.readAsText(fileInput.files[0]);
  }
}

function buildFromFile() {
  removeAllChildNodes(places);
  $('.modal').remove();

  layers = initTrealet.trealet.map_canvas;
  document.getElementById("title").value = initTrealet.trealet.title;
  document.getElementById("desc").value = initTrealet.trealet.desc;
  document.getElementById("imgFront").value = initTrealet.trealet.imgFront;
  var initPlaces = initTrealet.trealet.places;
  for (let i = 0; i < initPlaces.length; i++) {
    places.insertAdjacentHTML("beforeend", `
      <div class="place-form">
        <input type="text" name="survey_options[]" class="title" siz="50" placeholder="Tên địa điểm" value="${initPlaces[i].title}"/>
        <button onclick="modalTitle(${i})" type="button" id="btn${i}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal${i}"><i class="bi bi-pen"></i>Chỉnh sửa</button>
        <button type="button" onclick="removeParent(this); removeModal(${i});" class="btn btn-danger remove-place"><i class="bi bi-trash"></i>Xóa địa điểm</button>
        <hr/>
      </div>
    `);
    var modal = document.createElement("div");
    modal.setAttribute('class', "modal fade")
    modal.setAttribute('id', `modal${i}`);
    modal.setAttribute('tabindex', "-1");
    modal.setAttribute("aria-hidden", "true");
    modal.innerHTML = `<div class="modal-dialog"><div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input class="imgRPG form-control" placeholder="imgRPG" value="${initPlaces[i].imgRPG}">
              <textarea class="desc-place form-control" rows="4" placeholder="Mô tả">${initPlaces[i].desc}</textarea>
              <hr>
              <div class="items items${i}">
              
              </div>
            </div>
            <div class="modal-footer">
              <button  type="button" class="btn btn-success add_more_items${i}"><i class="fa fa-plus"></i>Thêm item</button>  
              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Lưu</button>
            </div>
          </div>
        </div>`;
    document.body.appendChild(modal);
    add_item = document.getElementsByClassName(`add_more_items${i}`)[0];
    add_item.onclick = function() {
      items = document.getElementsByClassName(`items${i}`)[0];
      items.insertAdjacentHTML("beforeend", `
        <div class="item-form-${i}">
        <input type="text" class="typeOfItem${i} form-control" placeholder="Tilte"/>
        <input type="text" class="ID${i} form-control" placeholder="ID (ngăn cách các ID giữa các dấu phẩy)"/>
        <button type="button" class="btn btn-danger remove_items${i}" onclick="removeParent(this)"><i class="bi bi-trash"></i></i>Xóa item</button>
        <hr/>
        </div>`);
    }
    for (let j = 0; j < initPlaces[i].items.length; j++) {
      items = document.getElementsByClassName(`items${i}`)[0];
      items.insertAdjacentHTML("beforeend", `
        <div class="item-form-${i}">
        <input type="text" class="typeOfItem${i} form-control" placeholder="Tilte" value="${initPlaces[i].items[j].title}"/>
        <input type="text" class="ID${i} form-control" placeholder="ID (ngăn cách các ID giữa các dấu phẩy)" value="${initPlaces[i].items[j].value}"/>
        <button type="button" class="btn btn-danger remove_items${i}" onclick="removeParent(this)"><i class="bi bi-trash"></i></i>Xóa item</button>
        <hr/>
        </div>`);
    }
  }
}

function removeAllChildNodes(parent) {
  while (parent.firstChild) {
      parent.removeChild(parent.firstChild);
  }
}

add_more_fields.onclick = function(){
  var i = document.getElementsByClassName('title').length;
  places.insertAdjacentHTML("beforeend", `
    <div class="place-form">
      <input type="text" name="survey_options[]" class="title" siz="50" placeholder="Tên địa điểm" />
      <button onclick="modalTitle(${i})" type="button" id="btn${i}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal${i}"><i class="bi bi-pen"></i>Chỉnh sửa</button>
      <button type="button" onclick="removeParent(this); removeModal(${i});" class="btn btn-danger remove-place"><i class="bi bi-trash"></i>Xóa địa điểm</button>
      <hr/>
    </div>
  `);
  // remove_place = document.getElementsByClassName(`remove-place`);
  // var place_form = document.getElementsByClassName(`place-form`);
  // var length = remove_place.length;
  // for (let j = 0; j < length; j++) {
  //   remove_place[j].onclick = function() {
  //     removeParent(this);
  //   }
  // }
  var modal = document.createElement("div");
  modal.setAttribute('class', "modal fade")
  modal.setAttribute('id', `modal${i}`);
  modal.setAttribute('tabindex', "-1");
  modal.setAttribute("aria-hidden", "true");
  modal.innerHTML = `<div class="modal-dialog"><div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input class="imgRPG form-control" placeholder="imgRPG">
            <textarea class="desc-place form-control" rows="4" placeholder="Mô tả"></textarea>
            <hr>
            <div class="items${i} items">
            
            </div>
          </div>
          <div class="modal-footer">
            <button  type="button" class="btn btn-success add_more_items${i}"><i class="fa fa-plus"></i>Thêm item</button>  
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Lưu</button>
          </div>
        </div>
      </div>`;
  document.body.appendChild(modal);
  add_item = document.getElementsByClassName(`add_more_items${i}`)[0];
  add_item.onclick = function() {
    items = document.getElementsByClassName(`items${i}`)[0];
    items.insertAdjacentHTML("beforeend", `
      <div class="item-form-${i}">
      <input type="text" class="typeOfItem${i} form-control" placeholder="Tilte"/>
      <input type="text" class="ID${i} form-control" placeholder="ID (ngăn cách các ID giữa các dấu phẩy)"/>
      <button type="button" class="btn btn-danger remove_items${i}" onclick="removeParent(this)"><i class="bi bi-trash"></i></i>Xóa item</button>
      <hr/>
      </div>`);
  }
}

const removeParent = function(button) {
  button.parentNode.remove();
  // console.log("h")
}

const removeModal = function(i) {
  document.getElementById(`modal${i}`).remove();
}

function modalTitle(i) {
  var title = document.getElementsByClassName('title')[i].value;
  document.getElementsByClassName("modal-title")[i].innerHTML = title;
}

function getData() {
  trealet.trealet.title = document.getElementById("title").value;
  trealet.trealet.desc = document.getElementById("desc").value;
  trealet.trealet.imgFront = document.getElementById("imgFront").value;
  trealet.trealet.places = [];

  var place_titles = document.getElementsByClassName("title");
  var place_desc = document.getElementsByClassName("desc-place");
  var imgRPG = document.getElementsByClassName("imgRPG");
  for (let i = 0; i < place_titles.length; i++) {
    var modX = i % 4;
    var modY = Math.floor(i / 4);
    place.y = 4 + 6 * modY;
    if (modX == 0) {
      place.x = 1;
    } else if (modX == 1) {
      place.x = 6;
    } else if (modX == 2) {
      place.x = 15;
    } else {
      place.x = 20;
    }
    place.title = place_titles[i].value;
    // console.log(place.title)
    place.desc = place_desc[i].value;
    place.imgRPG = imgRPG[i].value;
    var typeOfItem = document.getElementsByClassName(`typeOfItem${i}`);
    var id = document.getElementsByClassName(`ID${i}`);
    place.items = [];
    for (let j = 0; j < typeOfItem.length; j++) {
      item.title = typeOfItem[j].value;
      if (id[j].value.includes(',')) {
        var arrayItem = id[j].value.split(",");
        item.value = arrayItem;
      } else {
        item.value = id[j].value;
      }
      const trealet_item = Object.assign({}, item);
      place.items.push(trealet_item);
    }
    // console.log(place)
    const trealet_place = Object.assign({}, place);
    trealet.trealet.places.push(trealet_place);
  }
  document.getElementById("tab1").style.display = "none";
  document.getElementById("tab2").style.display = "inline";
  console.log(JSON.stringify(trealet));
  place_map = trealet.trealet.places;
  loadImgUrl();
  drawPlace();
}

function loadImgUrl() {
  place_map.forEach(place => {
    $.getJSON(`https://hcloud.trealet.com/tiny${place.imgRPG}/?json`, function(data) {
      var img = new Image(32 * 4, 32 * 3);
      img.src = data.image.url_full;
      var obj = {
        "img": img,
        "x": place.x,
        "y": place.y
      }
      imgRPG.push(obj);
    })
  })
  drawPlace();
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

