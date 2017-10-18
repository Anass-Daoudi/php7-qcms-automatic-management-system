i=0;
function b(){
    test=true;
    if(test){
       i++;
    baliseDiv=document.createElement("div");
    baliseDiv.className="divG";
    baliseDiv.setAttribute("name","divG");    
    
    baliseDiv1=document.createElement("div");
    baliseDiv1.className="div1";
    baliseDiv1.setAttribute("name","div1"); 
    messageDiv1=document.createTextNode("Question "+i+" : ");
    messageDiv1.className="messageDiv1";
    inputDiv1=document.createElement("input");
    inputDiv1.setAttribute("type","text");
    inputDiv1.setAttribute("class","inputClass1");
    inputDiv1.setAttribute("name","question"+i);     
    
    baliseDiv2=document.createElement("div");
    baliseDiv2.className="div2";
    baliseDiv2.setAttribute("name","div2"); 
    messageDiv2=document.createTextNode("le nombre de choix : ");
    messageDiv2.className="messageDiv1";
    inputDiv2=document.createElement("input");
    inputOkDiv2=document.createElement("input");
    inputOkDiv2.setAttribute("type","button");
    inputOkDiv2.setAttribute("value","OK");
    inputOkDiv2.className="ok";
    inputOkDiv2.setAttribute("onClick","addResponse()");
    inputDiv2.setAttribute("type","text");
    inputDiv2.setAttribute("class","inputClass2");
    /*inputDiv2.setAttribute("id","inputDiv2");
    */
    
    
    
    
    baliseDiv1.appendChild(messageDiv1);
    baliseDiv1.appendChild(inputDiv1);
    baliseDiv2.appendChild(messageDiv2);
    baliseDiv2.appendChild(inputDiv2);
     baliseDiv2.appendChild(inputOkDiv2);
    baliseDiv.appendChild(baliseDiv1);
    baliseDiv.appendChild(baliseDiv2);
   
    document.getElementById("conteneur").appendChild(baliseDiv);
         }
   
    
}
/*function afficher(){
    divG=document.createElement("div"); 
    div1=document.createElement("div");
    nombre=document.createTextNode("1-");
    question=document.createElement("input");
    question.setAttribute("type","text");
    div1.appendChild(nombre);
    div1.appendChild(question);
    divG.appendChild("div1");
    document.getElementById("conteneur").appendChild(divG);
}*/

function addResponse(){
        baliseDiv3=document.createElement("div");
        baliseDiv3.className="div3";
        baliseDiv1.setAttribute("name","div3"+i); 
    
       for(j=0;j<inputDiv2.value;j++){
        inputcheckDiv3=document.createElement("input");
        inputcheckDiv3.setAttribute("type","checkbox");
        inputcheckDiv3.setAttribute("name","check"+i+""+j); 
        inputDiv3=document.createElement("input");
        inputDiv3.setAttribute("type","text");
        inputDiv3.setAttribute("class","inputClass3");
        inputDiv3.setAttribute("name","reponse"+i+""+j); 
        
        baliseDiv3.appendChild(inputcheckDiv3);
        baliseDiv3.appendChild(inputDiv3);
       }
    
        baliseDiv.appendChild(baliseDiv3);
    if(inputOkDiv2.clicked==false){
        test=false;
    }
        baliseDiv.removeChild(baliseDiv2);
    
        inputOkDiv2.disabled="true";
   
}

