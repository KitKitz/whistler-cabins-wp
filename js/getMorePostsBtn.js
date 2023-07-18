document.addEventListener('DOMContentLoaded', function() {
    const moreActivitiesButtons = document.querySelectorAll('.more');
  
    moreActivitiesButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        const hiddenPosts = this.nextElementSibling;
        hiddenPosts.style.display = 'block';
        this.style.display = 'none';
      });
    });
  });