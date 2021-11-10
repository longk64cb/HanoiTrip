var survey_options = document.getElementById('survey_options');
var add_more_fields = document.getElementById('add_more_fields');
var remove_fields = document.getElementById('remove_fields');

add_more_fields.onclick = function(){
	var newField = document.createElement('input');
	newField.setAttribute('type','text');
	newField.setAttribute('name','survey_options[]');
	// newField.setAttribute('class','survey_options');
	newField.setAttribute('class','typeOfItem');
	newField.setAttribute('siz',50);
	newField.setAttribute('placeholder','Loại item');
	survey_options.appendChild(newField);

	var newField2 = document.createElement('input');
	newField2.setAttribute('type','text');
	newField2.setAttribute('name','survey_options[]');
	// newField2.setAttribute('class','survey_options');
	newField.setAttribute('class','ID');
	newField2.setAttribute('siz',50);
	newField2.setAttribute('placeholder','ID');
	survey_options.appendChild(newField2);
}

remove_fields.onclick = function(){
	var input_tags = survey_options.getElementsByTagName('input');
	if(input_tags.length > 2) {
		survey_options.removeChild(input_tags[(input_tags.length) - 1]);
	}
}

function getData() {
	var type = document.getElementsByClassName("typeOfItem").value;
	var id = document.getElementsByClassName("ID");
	var title = document.getElementById("title").value;
	var desc = document.getElementById("desc").value;	

	var item = [];

	
	alert(type);
	
    // alert("Xác nhận tải xuống?");
    // var trealet = "";
    //     trealetFooter = "\t\t]\n"
    //                     + "\t}\n"
    //                     + "}";
    //     trealetHeader = '{\n'
    //                     + "\t\"trealet\":{\n"
    //                     + "\t\t\"exec\":\"streamline\",\n" 
    //                     + "\t\t\"title\":" + '\"' + title + "\",\n"
    //                     + "\t\t\"author\":\"Nhom06\",\n"
    //                     + "\t\t\"desc\":" + '\"' + desc + "\",\n";
    //                     + "\t\t\"items\": [\n"
    //     // itemPhoto = "\t\t\t\{\"title\":\"Một số ảnh\", \"value\":" + photo + "},\n";
    //     // itemGif = "\t\t\t\{\"title\":\"GIF\", \"value\": " + gif + "},\n";
    //     // itemVideo =  "\t\t\t\{\"title\":\"Video giới thiệu\", \"value\": " + video + "},\n";
    //     // item3d = "\t\t\t\{\"title\":\"Tham quan trực tuyến\", \"value\": " + _3d + "}\n";
    // download('newFile.trealet', trealet);
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