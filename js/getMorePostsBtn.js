document.addEventListener('DOMContentLoaded', function() {
    const getMorePostsButtons = document.querySelectorAll('.get-more-posts');
  
    getMorePostsButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        const hiddenPosts = this.nextElementSibling;
        hiddenPosts.style.display = 'block';
        this.style.display = 'none';
      });
    });
  });