document.getElementById("flexCheckDefault").addEventListener("click", function(){
    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();
    if(day < 10){
        day = "0" + day;
    }
    if(month < 10){
        month = "0" + month;
    }
    var today = year + "-" + month + "-" + day;
    document.getElementById("date").value = today;
});
// ถ้าเปลี่ยนวันที่ให้เคลียร์ checkbox
document.getElementById("date").addEventListener("change", function(){
    document.getElementById("flexCheckDefault").checked = false;
});