console.log("jebać js")
let btn=document.querySelector("#last_section")
    // let wybrane=new array(0);
let query="select "    
// let a=document.querySelector('.fullData')
btn.addEventListener("mouseover",
function whatSelected(){
    query="select "
    let zmienna=document.querySelectorAll(".selcection");

     for(let el of zmienna){
        // console.log(el.value)

     if(el.checked){
        
        console.log("o chuj")
        query+=" "+el.value+" ,"
        }

    }
    query=query.substring(0,query.length - 1)
    console.log(query)
})

