console.log("jebać js")
let btn=document.querySelector(".send_btn")
    // let wybrane=new array(0);
let query="select "    
// document.cookie='cathedBoxes='+';+path=/;'
// let a=document.querySelector('.fullData')
let i=0
btn.addEventListener("mouseover",
function whatSelected(){
    query="select "
    let tables=document.querySelectorAll(".main_form_section")
    let zmienna=document.querySelectorAll(".selcection");
    // console.log(tables)
    
     for(let el of zmienna){
        // console.log(el.value)

     if(el.checked){
        
        console.log("o chuj")
        // console.log(tables[i])

        query+=" "+el.value+" ,"
        }
        i++
    }
    query=query.substring(0,query.length - 1)
    console.log(query)
    document.cookie='cathed'+'='+query+';path=/'
    let output = document.cookie
    console.log(output)


})

