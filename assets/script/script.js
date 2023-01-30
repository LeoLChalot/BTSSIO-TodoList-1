function toggleClass(id){
    var entity = document.getElementById(id);
    entity.addEventListener("click", ()  =>{
        entity.classList.toggle("check");
    })
}
