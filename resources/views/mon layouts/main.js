//add hovered class to select list item
let list =document.querySelectorAll(".navigation li");

function activeLink(){
	list.forEach((items)=>{
		items.classList.remove("hovered");
	});
	this.classList.add("hovered");
}
list.forEach((items)=> item.addEventListener("mouseover",activeLink));

//Menu toggle

let toggle =document.querySelector(".toggle");
let navigation=document.querySelector(".navigation");
let main=document.querySelector(".main");

toggle.onClick = function(){
	navigation.classList.toggle("acive");
	main.classList.toggle("active");
}