function markQuiz(unitCount) {  
	
	var correctCount = 0;        
	var answers = document.getElementById('quizQuestions').getElementsByTagName("INPUT");
  
	for(var j = 0; j < answers.length; j++) {
		if(answers[j].value === "true" && answers[j].checked) {
			correctCount++;
		}
	}
	
	var denom = answers.length / 4;
	var percentage = parseFloat(correctCount / denom * 100).toPrecision(4);
	document.getElementById("quizResults").innerHTML ="You scored "+ correctCount + "/" + denom + " = " + percentage + "%";
	document.getElementById("mark").disabled = true;
	
	var my_tag = document.getElementById('quizQuestions').getElementsByTagName("SPAN");
	//Get the number of span tags and subtract the number of units
	//because unit also uses span tags
	var count = my_tag.length;
	for(var i = 0; i < count; i++){
		if(my_tag[i].id === "true"){
		 my_tag[i].style.background = "green";
	 }
		if(answers[i].value === "false" && answers[i].checked) {
			my_tag[i].style.background = "red";
		}
	}
	
}                   
    
  