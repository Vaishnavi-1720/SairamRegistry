const selected = document.querySelector(".selected");
const optionsContainer = document.querySelector(".options-container");

const optionsList = document.querySelectorAll(".option");
var n=1;
var endval="";
var bmar=650;
var arr=[]
const  nextBtn  =  document.getElementById('nextBtn');

selected.addEventListener("click", () => {
  optionsContainer.classList.toggle("active");
});

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    selected.innerHTML = o.querySelector("label").innerHTML;
    optionsContainer.classList.remove("active");
  });
});
function CheckColors(val){
 var element=document.getElementById('color');
   element.style.display='block';
endval=""


}
function closetext(val){
  var element=document.getElementById('color');
   element.style.display='none';
endval=val;

}
function l() {
bmar-=100
document.getElementById("c").style.marginLeft = bmar+"px";
var bullet  =  document.getElementById("b"+n);
bullet.classList.add("active");
if (endval!=""){


	bullet.innerHTML=endval;
arr[n-1]=endval;

 }
else{

 bullet.innerHTML=document.getElementById('color').value;
arr[n-1]=document.getElementById('color').value;}
  n+=1;
}

function ar(val){

  var doc=val;
  str_json = JSON.stringify(arr);
  var status=[];
for(var i=0;i<arr.length;i+=1)
{
  status[i]="no";
}
 str=JSON.stringify(status);
console.log(str);

  $.ajax({
    method: "POST",
     url: "readjson.php",
    data:  {data:str_json,
           docNo:doc,
            str:str },

    success: function(data){
    if(data)
    {
       swal.fire({
       icon : 'success',
       title : 'Notification sent',
        })
        setTimeout(function () {
        location.href='inward.php';
      }, 1000);
    }

    }
  });
}
