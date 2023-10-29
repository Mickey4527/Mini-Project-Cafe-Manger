function setDateNow(){
    const date = new Date();
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    if(day < 10){
        day = "0" + day;
    }
    if(month < 10){
        month = "0" + month;
    }
    document.getElementById("flexCheckDefault").addEventListener("click", function(){
        document.getElementById("date").value = year + "-" + month + "-" + day;
    });

    document.getElementById("date").addEventListener("change", function(){
        document.getElementById("flexCheckDefault").checked = false;
    });
}
