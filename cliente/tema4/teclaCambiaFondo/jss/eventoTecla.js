var combi = [];
function combinacionTeclas(e) {
    var key = e.key;
    //combi.push(key);
    //console.log(key);
    if(combi.length != 0){
        if(combi[0]!="Shift") {
            combi = [];
        } else {
            if(key=="Shift") {
                combi = [];
                combi.push(key);
            }else{
                if(key=="F2") {
                    combi.push(key);
                    document.body.style.backgroundImage = "url('http://source.unsplash.com/random')";
                    combi= [];
                }
            }
            
        }
    } else {
        if(key=="Shift") {
            combi.push(key);
        }
    }

    
    
}
document.body.addEventListener("keydown",combinacionTeclas);