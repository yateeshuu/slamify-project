$(document).ready(function() {
	// Counter for question IDs
	var questionCounter = 2;

	// Add question button click event
	$('#add-question').click(function() {
		// Create new question HTML
		var newQuestionHtml = '<div class="question">' +
							  '<label for="question' + questionCounter + '">Question ' + questionCounter + ':</label>' +
							  '<input type="text" id="question' + questionCounter + '" name="questions[]" required>' +
							  '<label for="type' + questionCounter + '">Type:</label>' +
							  '<select id="type' + questionCounter + '" name="types[]">' +
							  '<option value="text">Text</option>' +
							  '<option value="number">Number</option>' +
							  '<option value="email">Email</option>' +
							  '<option value="date">Date</option>' +
							  '</select>' +
							  '<button type="button" class="remove-question">Remove</button>' +
							  '</div>';

		// Append new question to questions container
		$('#questions-container').append(newQuestionHtml);

		// Increment question counter
		questionCounter++;
	});

	// Remove question button click event
	$(document).on('click', '.remove-question', function() {
		// Remove question element
		$(this).parent('.question').remove();
	});
});