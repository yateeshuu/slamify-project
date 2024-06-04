const toggleBtns = document.querySelectorAll(".toggle-btn");
const questionItems = document.querySelectorAll(".question-list li");

// Show the questions for the default active category (Personal)
questionItems.forEach((item) => {
  if (item.classList.contains("friends")) {
    item.style.display = "block";
  } else {
    item.style.display = "none";
  }
});

toggleBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    const category = btn.dataset.category;
console.log(category);
    toggleBtns.forEach((btn) => {
      btn.classList.remove("active");
    });
    btn.classList.add("active");

    questionItems.forEach((item) => {
      item.style.display = "none";
      if (item.classList.contains(category)) {
        item.style.display = "block";
      } 
    });
  });
});
var shareBtn = document.querySelector('.share-btn');
		var shareDialog = document.querySelector('#share-dialog');
		
		// Show the dialog box when the share button is clicked
		shareBtn.addEventListener('click', function() {
			shareDialog.style.display = 'block';
			document.body.style.overflow = 'hidden'; // Disable scrolling
		});
		
		// Hide the dialog box when the close button is clicked
		var closeBtn = document.querySelector('.close');
		closeBtn.addEventListener('click', function() {
			shareDialog.style.display = 'none';
			document.body.style.overflow = 'auto'; // Enable scrolling
		});
		
		// Share the content with the specified username
		// Share the content with the specified username

var shareConfirmBtn = document.querySelector('.share-confirm-btn');
var shareButton = document.querySelector('.share-confirm-btn');
shareButton.addEventListener('click', () => {
  const bookName = document.getElementById('username-input').value;
  const shareText = `Check out this book: ${bookName}`;
  const encodedShareText = encodeURIComponent(shareText);
  window.location.href = `whatsapp://send?text=${encodedShareText}`;
});
shareConfirmBtn.addEventListener('click', function() {
    var usernameInput = document.querySelector('#username-input');
    var bookname = usernameInput.value;
    var category = document.querySelector('.toggle-btn.active').dataset.category;
    var url = `static.php?category=${encodeURIComponent(category)}&bookname=${encodeURIComponent(bookname)}`;
    window.location.href = url;
});
// const shareButton = document.querySelector('.share-confirm-btn');
// shareButton.addEventListener('click', () => {
//   const bookName = document.getElementById('username-input').value;
//   const shareText = `Check out this book: ${bookName}`;
//   const encodedShareText = encodeURIComponent(shareText);
//   window.location.href = `whatsapp://send?text=${encodedShareText}`;
// });