document.addEventListener('DOMContentLoaded', function() {
    const moreActivitiesButtons = document.querySelectorAll('.more');
  
    moreActivitiesButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        const hiddenPosts = this.nextElementSibling;
        parentTaxDisplay = hiddenPosts.parentElement.style.display;
        hiddenPosts.style.display = parentTaxDisplay;
        this.style.display = 'none';
      });
    });
  });