<?php
	
	$quizFind = array("<quiz>" , "</quiz>" , "quizTitle" , "<questions>" , "</questions>" , "<question>" , "</question>" , "<theQuestion>" , "</theQuestion>" ,
					 "<answers>" , "</answers>" , "<answer" , "</answer>" , "questionNumber" , "isCorrect" , "'false'>" , "'true'>");

	$quizReplace = array("<section id='quizQuestions'>" , "</section>" , "h2" , "<form>" , "</form>" , "<fieldset>" , "</fieldset>" , "<h3>" , "</h3>" , "<div class='answers'>" , "</div>" , "<br><input type='radio'" , "</span>" , "name" , "value" , "'false'><span id='false'>" , "'true'><span id='true'>");

	$lessonFind = array("lessonTitle" , "<lesson>" , "</lesson>" , "entryTitle" , "<entry>" , "</entry>" , "<paragraph>" , "</paragraph>" , "<image source" , 				 			   "orderedList" , "unorderedList" , "<item>" , "</item>" , "<link source" , "</link>");

	$lessonReplace = array("h2" , "<section>" , "</section>" , "h3" , "<article>" , "</article>" , "<span>" , "</span>" , "<img src" , "ol" , "ul" , "<li>" , "</li>" , "<a href" , "</a>");

	function parseLessonEML($lessonFind, $lessonReplace, $eml) {
		return str_replace($lessonFind, $lessonReplace, $eml);
	}

	function parseQuizEML($quizFind, $quizReplace, $eml) {
		return str_replace($quizFind, $quizReplace, $eml);
	}
	
?>