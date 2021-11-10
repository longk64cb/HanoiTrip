function getData() {
    var title = document.getElementById("title").value;
        desc = document.getElementById("desc").value;
        photo = document.getElementsByID("photo").value;
        gif = document.getElementById("gif").value;
        video = document.getElementById("video").value;
        _3d = document.getElementById("3d").value;

    alert(title + desc + photo + gif + video + _3d);
    return 0;
    // var trealet = "";

    // trealet = '{\n'
    //         + "\t\"trealet\":{\n"
    //         + "\t\t\"exec\":\"streamline\",/n" 
    //         + "\t\t\"title\":" + '\"' + title + "\","
    //         + "\t\t\"author\":\"Nhom06\","
    //         + "\t\t\"desc\":" + '\"' + desc + "\","
    //         + "\t\t\"items\": [\n"
    //         + "\t\t\t\{\"title\":\"Một số ảnh\", \"value\": " + photo + "},"
    //         + "\t\t\t\{\"title\":\"GIF\", \"value\": " + gif + "},"
    //         + "\t\t\t\{\"title\":\"Video giới thiệu\", \"value\": " + video + "},"
    //         + "\t\t\t\{\"title\":\"Tham quan trực tuyến\", \"value\": " + _3d + "}"
    //         + "\t\t]"
    //         + "\t}"
    //         + "}";
    
    // const fs = require('fs')
    // fs.writeFile('output.txt', trealet, (err) => {
    //     if(err) throw err;
    // })
}