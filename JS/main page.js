var toAdd = document.createDocumentFragment();
for(var i=0; i<10; i++){
	var newDiv = document.createElement('div');
	newDiv.id = 'r'+i;
	newDiv.className= 'store';
	toAdd.appendChild(toAdd);
}
document.appendChild(toAdd);
$('sel').append(toAdd);